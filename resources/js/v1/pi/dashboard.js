import { decryptData, encryptData } from "../encrypt.js";

const tempatPraktikDetails = {}; // Initialize tempatPraktikDetails object
var registerId;

$(document).ready(function () {
    const expiresIn = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
    const expirationTime = new Date(Date.now() + expiresIn).toUTCString();

    const piat = getCookie('piat');
    if (piat) {
        document.cookie = `piat=${piat}; expires=${expirationTime}; path=/; SameSite=Lax`;
    }

    getDataDetail()

    // Event listener for "View Detail" button
    $('#list-sip').on('click', '.view-detail', function() {
        const id = $(this).data('id');
        const detail = tempatPraktikDetails[id];

        $('#detailNomorSIP').text(detail.nomorSIP);
        $('#detailPeriodeAwalSIP').text(detail.periodeAwalSIP);
        $('#detailPeriodeAkhirSIP').text(detail.periodeAkhirSIP);
        $('#detailDaerahPenerbitSIP').text(detail.daerahPenerbitSIP);
        if(detail.daerahPenerbitSIP_id === "0"){
            $('#div-nama-penerbit').show()
            $('#namaPenerbitSIP').text(detail.namaPenerbitSIP);
        } else {
            $('#div-nama-penerbit').hide()
            $('#namaPenerbitSIP').text(detail.namaPenerbitSIP);
        }
        $('#detailTempatPraktik').text(detail.tempat);
        $('#file_sip').attr('href', detail.unggahSIP ? detail.unggahSIP : '#'); // Set the SIP link

        $('#viewDetailModal').modal('show');
    });
});

// Function to get the value of a specific cookie by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function getDataDetail() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    // Get the token from the 'piat' cookie
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    $.ajax({
        url: `${apiUrl}/api/client/dashboard`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${token}`
        },
    }).done(function(response) {
        var statusId;
        $.each(response['data'], function(j, item) {
            registerId = item.register_no;
            statusId = item.polis_exp; // Adjusted to match response structure
            $('#nomor-polis').html(item.polis_no + ` <span class="badge bg-light-${item.polis_exp == 1 ? 'success' : ( item.polis_exp == 2 ? 'danger' : 'primary' ) }">${item.polis_exp_desc}</span>`);
            $('#asuransi').html(item.ins_nama);
            $('#periode-polis').html(item.polis_start_date + ' - ' + item.polis_end_date);
            $('#expire-count').html(`(${item.expireCount})`);
            $('#jaminan-pertanggungan').html(item.sum_insured);
            $('#nilai-premi').html(item.premi);
            $('#nomor-register').html(item.register_no);
            $('#nama').html(item.nama);
            $('#nik').html(item.nik);
            $('#ttl').html(item.tempat_lahir + ', ' + item.tanggal_lahir);
            $('#email').html(item.email);
            $('#jenis-kelamin').html(item.jenis_kelamin_desc);
            $('#nomor-handphone').html(item.no_hp);
            $('#npwp').html(item.npwp);
            $('#alamat').html(item.alamat);
            if(item.kontak_darurat === null || item.kontak_darurat === '-') {
                $('#div-kontak-darurat').hide();
            }
            $('#kontak-darurat').html(item.kontak_darurat ? item.kontak_darurat : '-');
            $('#nomor-darurat').html(item.nomor_darurat ? item.nomor_darurat : '-');
            if (item.profesi_id === 1) {
                $('#div-tenaga-medis').removeClass('d-none');
            } else {
                $('#div-tenaga-kesehatan').removeClass('d-none');
            }
            $('#ketegori-profesi').html(item.profesi_kategori_desc);
            $('#nomor-str').html(item.str_no);
            if (item.str_stat === "Seumur hidup") {
                $('#status-str').html('Seumur Hidup');
                $('#label-str').html('Periode Awal STR');
                $('#periode-str').html(item.str_date_start);
            } else {
                $('#status-str').html('Belum Seumur Hidup');
                $('#label-str').html('Masa Berakhir STR');
                $('#periode-str').html(item.str_date_end);
            }
            $('#plan').html(item.ins_nama);
            $('#jaminan-pertanggungan-pembayaran').html(item.sum_insured);
            $('#total-tagihan').html(item.premi);
            $('#div-e-sertifikat').html(`
                <a href="${item.polis_file_path}" target="blank_" class="btn btn-primary" id="btn-download-polis">
                    E-Sertifikat
                </a>
            `);
            $('#file_ktp').attr('href', item.ktp_file_path)
            $('#file_ktp').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> KTP</span> ')
            $('#file_str').attr('href', item.str_file_path)
            $('#file_str').html('<i class="ti ti-file"></i> <span class=""> STR</span> ')
        });

        populateTempatPraktikDetails(response)

        $.each(response['info'], function(j, item) {
            // Determine the alert text and class based on the status and expire count
            if (item.request_status_id == 6) {
                if (item.expireCount == 0) {
                    $('#div-polis-alert').hide();
                } else {
                    $('#div-polis-alert').show();
                    if (item.expireCount == 1) {
                        alertClass = 'bg-warning';
                        alertText = "Polis anda akan segera berakhir";
                    } else if (item.expireCount == 2) {
                        alertClass = 'bg-danger';
                        alertText = "Polis anda telah berakhir";
                    }
                    $('#div-polis-alert').removeClass('bg-danger bg-warning').addClass(alertClass);
                    $('#polis-alert span').text(alertText);
                }
            } else {
                $('#div-polis-alert').hide();
            }
        });

        Swal.close()
    }).fail(function(response) {
        if (response.status === 404) {
            Swal.fire({
                title: 'Error!',
                text: 'Request tidak ditemukan.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        } else if (response.status === 401) {
            Swal.fire({
                title: 'Error!',
                text: 'Sesi Anda telah habis. Silakan login kembali.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            }).then(function() {
                window.location.href = loginUrl;
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan. Silakan coba lagi.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        }
    });
}

// Function to dynamically populate tempatPraktikDetails from response
function populateTempatPraktikDetails(response) {
    response.sip.forEach((item) => {
        const id = item.id; // Use the item id as the key

        tempatPraktikDetails[id] = {
            nomorSIP: item.sip_no,
            periodeAwalSIP: item.sip_date_start,
            periodeAkhirSIP: item.sip_date_end,
            daerahPenerbitSIP: item.sip_penerbit,
            namaPenerbitSIP: item.sip_penerbit_desc,
            tempat: item.tempat_praktik,
            unggahSIP: item.file_path
        };
    });
    renderList();
}

// Function to render list based on tempatPraktikDetails
function renderList() {
    const listSIP = $('#list-sip');
    listSIP.empty();
    let counter = 1;
    for (const id in tempatPraktikDetails) {
        if (tempatPraktikDetails.hasOwnProperty(id)) {
            const detail = tempatPraktikDetails[id];
            const row = `
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0" data-id="${id}">
                    <b>No SIP: ${detail.nomorSIP}</b>
                    <button type="button" class="btn btn-info btn-sm view-detail" data-id="${id}"><i class="fa fa-eye"></i></button>
                </li>
            `;
            listSIP.append(row);
            counter++;
        }
    }
}
