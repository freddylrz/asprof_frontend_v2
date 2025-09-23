import { decryptData } from "../encrypt.js";

const tempatPraktikDetails = {}; // Initialize tempatPraktikDetails object
var requestId;
var table;

$(document).ready(function () {
    const expiresIn = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
    const expirationTime = new Date(Date.now() + expiresIn).toUTCString();

    const piat = getCookie('piat');
    if (piat) {
        document.cookie = `piat=${piat}; expires=${expirationTime}; path=/; SameSite=Lax`;
    }

    getDataDetail();
    getListPolis();

    // Event listener for "View Detail" button (SIP)
    $('#list-sip').on('click', '.view-detail', function() {
        const id = $(this).data('id');
        const detail = tempatPraktikDetails[id];

        $('#detailNomorSIP').text(detail.nomorSIP);
        $('#detailPeriodeAwalSIP').text(detail.periodeAwalSIP);
        $('#detailPeriodeAkhirSIP').text(detail.periodeAkhirSIP);
        $('#detailDaerahPenerbitSIP').text(detail.daerahPenerbitSIP);
        if(detail.daerahPenerbitSIP_id === "0"){
            $('#div-nama-penerbit').show();
            $('#namaPenerbitSIP').text(detail.namaPenerbitSIP);
        } else {
            $('#div-nama-penerbit').hide();
            $('#namaPenerbitSIP').text(detail.namaPenerbitSIP);
        }
        $('#detailTempatPraktik').text(detail.tempat);
        $('#file_sip').attr('href', detail.unggahSIP ? detail.unggahSIP : '#'); // Set the SIP link

        $('#viewDetailModal').modal('show');
    });

    // Event listener untuk tombol Nota & Kwitansi (ditambahkan setelah tombol dirender)
    $(document).on('click', '#btn-download-nota', function() {
        downloadNota();
    });

    $(document).on('click', '#btn-download-kwitansi', function() {
        downloadKwitansi();
    });
});

function getListPolis(){
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    $.ajax({
        url: `${apiUrl}/api/client/history`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${token}`
        },
    }).done(async function(responses) {
        table = $('#policy-history-table').DataTable({
            responsive: true,
            "processing": false,
            "pageLength": 25,
            "autoWidth": false,
            "order": [],
            "scrollX": true,
            "bDestroy": true,
            "searching": true,
            data: responses.data || [],
            columns: [
                { data: 'insurance' },
                { data: 'polis_no' },
                { data: 'polis_start_date', className : 'text-center'  },
                { data: 'polis_end_date', className : 'text-center'  },
                { data: 'plan_desc', className : 'text-center'  },
                { data: 'sum_insured', className : 'text-end' },
                { data: 'premi', className : 'text-end' },
                { data: 'polis_stat', className : 'text-center' }
            ],
            language: {
                emptyTable: "Tidak ada data riwayat polis."
            }
        });
    });
}

$('#collapseOne').on('shown.bs.collapse', function () {
    setTimeout(function () {
        table.columns.adjust().draw();
    }, 200); // kasih jeda 200ms
});

// Function to get the value of a specific cookie by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

async function getDataDetail() {
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
    }).done(async function(responses) {
        var response = await decryptData(responses.data);

        console.log(response);

        var statusId;
        var sipDocuments = {}; // Untuk menyimpan dokumen SIP berdasarkan tempat_praktik_id

        // Map dokumen SIP berdasarkan tempat_praktik_id
        $.each(response['document'], function(j, doc) {
            if (doc.file_type == 3) { // SIP document
                sipDocuments[doc.tempat_praktik_id] = doc.link;
            }
        });

        $.each(response['policy'], function(j, item) {
            $('#periode-polis').html(item.polis_start_date + ' s.d. ' + item.polis_end_date);
            statusId = item.polis_exp;
            $('#nomor-polis').html(item.polis_no);
            $('#asuransi').html(item.ins_nama);
            $('#expire-count').html(`(${item.expireCount})`);
            $('#jaminan-pertanggungan').html(item.sum_insured);
            $('#nilai-premi').html(item.premi);
        });

        $.each(response['data'], function(j, item) {
            requestId = item.id;
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
            } else {
                $('#div-kontak-darurat').show();
                $('#kontak-darurat').html(item.kontak_darurat ? item.kontak_darurat : '-');
                $('#nomor-darurat').html(item.nomor_darurat ? item.nomor_darurat : '-');
            }
            if (item.profesi_id === 1) {
                $('#div-tenaga-medis').removeClass('d-none');
            } else {
                $('#div-tenaga-kesehatan').removeClass('d-none');
            }
            $('#ketegori-profesi').html(item.profesi_kategori_desc);
            $('#profesi').html(item.profesi_desc);
            $('#nomor-str').html(item.str_no);

            // Populate STR status and period
            if (item.str_stat == "1") {
                $('#status-str').html('Status: Seumur Hidup');
                $('#periode-str').html(`Periode Awal: ${item.str_date_start || '-'}`);
            } else {
                $('#status-str').html('Status: Belum Seumur Hidup');
                $('#periode-str').html(`Masa Berlaku: ${item.str_date_end || '-'}`);
            }

            // Plan information
            $('#plan').html(item.plan_desc);
            $('#premi-tahunan').html(item.premi);
            $('#biaya-polis').html(item.biaya_polis);
            $('#biaya-materai').html(item.biaya_materai);
            $('#total-tagihan').html(item.total_premi);
            $('#jaminan-pertanggungan-pembayaran').html(item.sum_insured);

            // E-Sertifikat & Master Polis tetap pakai file_path dari policyPath
            const polisFilePath = response.policyPath && response.policyPath.length > 0 ? response.policyPath[0].file_path : '#';

            $('#div-e-sertifikat').html(`
                <a href="${polisFilePath}" target="_blank" class="btn btn-primary w-100" id="btn-download-polis">
                    <i class="ti ti-download me-2"></i> E-Sertifikat
                </a>
            `);

            $('#div-e-polis').html(`
                <a href="${polisFilePath}" target="_blank" class="btn btn-primary w-100" id="btn-download-polis">
                    <i class="ti ti-download me-2"></i> Master Polis
                </a>
            `);

            // Ganti Nota & Kwitansi jadi tombol trigger fungsi
            $('#div-e-nota').html(`
                <button type="button" class="btn btn-primary w-100" id="btn-download-nota">
                    <i class="ti ti-download me-2"></i> Nota
                </button>
            `);

            $('#div-e-kwitansi').html(`
                <button type="button" class="btn btn-primary w-100" id="btn-download-kwitansi">
                    <i class="ti ti-download me-2"></i> Kwitansi
                </button>
            `);

            // Handle SIP display - bisa lebih dari satu
            $('#list-sip-container').empty(); // Clear existing content

            if (response.sip && response.sip.length > 0) {
                $.each(response.sip, function(index, sipItem) {
                    $('#list-sip-container').append(`
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-0 h5">${sipItem.sip_no || '-'}</p>
                            <button type="button" class="btn btn-sm btn-primary view-sip-btn" data-sip-index="${index}">
                                Lihat SIP
                            </button>
                        </div>
                    `);
                });

                // Store SIP data globally for modal access
                window.currentSIPData = response.sip;
                window.sipDocuments = sipDocuments; // Store document mapping
            } else {
                $('#list-sip-container').append(`
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0">Tidak ada data SIP</p>
                    </div>
                `);
            }
        });

        // Handle documents
        $.each(response['document'], function(j, item) {
            if (item.file_type == 1) {
                $('#file_ktp').attr('href', item.link)
                $('#file_ktp').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> KTP</span> ')
            } else if (item.file_type == 2) {
                // STR Document
                $('#file_str').attr('href', item.link)
                $('#downloadSTR').attr('href', item.link)
                // Set image source for STR modal
                $('#strImage').attr('src', item.link)
            }
            // SIP documents handled dynamically above
        });

        // Populate modal data for STR
        if (response.data && response.data.length > 0) {
            const data = response.data[0];
            $('#modalNomorSTR').empty().append(data.str_no || '-')
            $('#modalStatusSTR').empty().append(data.str_stat == "1" ? 'Seumur Hidup' : 'Belum Seumur Hidup')
            $('#modalPenerbitSTR').empty().append(data.str_penerbit || '-')

            // Kondisi: jika str_stat == 1 maka tampilkan str_date_start, selain itu str_date_end
            if (data.str_stat == "1") {
                $('#modalPeriodeAwalSTR').empty().append(data.str_date_start || '-')
                // Sembunyikan periode akhir untuk status seumur hidup
                $('#modalPeriodeAkhirSTR').closest('.mb-3').hide();
            } else {
                $('#modalPeriodeAwalSTR').empty().append(data.str_date_start || '-')
                $('#modalPeriodeAkhirSTR').empty().append(data.str_date_end || '-')
                // Tampilkan periode akhir untuk status tidak seumur hidup
                $('#modalPeriodeAkhirSTR').closest('.mb-3').show();
            }
        }

        // Event listener untuk tombol Lihat SIP
        $(document).off('click', '.view-sip-btn').on('click', '.view-sip-btn', function() {
            const sipIndex = $(this).data('sip-index');
            const sipData = window.currentSIPData[sipIndex];

            // Populate modal SIP dengan data yang sesuai
            populateSIPModal(sipData);
        });

        // Function untuk populate data ke modal SIP
        function populateSIPModal(sipData) {
            $('#detailNomorSIP').empty().append(sipData.sip_no || '-');
            $('#detailPeriodeAwalSIP').empty().append(sipData.sip_date_start || '-');
            $('#detailPeriodeAkhirSIP').empty().append(sipData.sip_date_end || '-');
            $('#detailDaerahPenerbitSIP').empty().append(sipData.sip_penerbit || '-');
            $('#detailTempatPraktik').empty().append(sipData.tempat_praktik || '-');

            // Set image for SIP
            const sipDocumentLink = window.sipDocuments[sipData.id];
            if (sipDocumentLink) {
                $('#sipImage').attr('src', sipDocumentLink);
                $('#downloadSIP').attr('href', sipDocumentLink);
            } else {
                $('#sipImage').attr('src', '');
                $('#downloadSIP').attr('href', '#');
            }

            // Hide nama penerbit section since it's not in the API response
            $('#div-nama-penerbit').hide();

            // Show modal
            $('#sipModal').modal('show');
        }

        populateTempatPraktikDetails(response);
        managePolisAlert(response);

        Swal.close();
    }).fail(function(response) {
        Swal.close();
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

// Template alert (tanpa container col-12)
var polisAlertInnerTemplate = `
    <div class="alert alert-danger d-flex align-items-center" style="display: flex" role="alert" id="div-polis-alert">
        <i class="ti ti-info-circle mx-2 my-auto" style="font-size: 1.5rem; font-weight: 900; flex-shrink: 0; color: #050505"></i>
        <span id="polis-alert" class="text-wrap h4 my-auto" style="flex: 1;"></span>
        <div class="ms-auto">
            <a href="/renewal" class="btn btn-primary">
                <i class="ti ti-edit"></i> <span class="d-none d-lg-inline-block my-1">Renewal</span>
            </a>
        </div>
    </div>
`;

// Fungsi untuk mengelola alert polis
function managePolisAlert(response) {
    // Hapus alert yang sudah ada
    $('#div-polis-alert').remove();

    // Cek apakah ada data info
    if (!response['info'] || response['info'].length === 0) {
        return;
    }

    // Proses item terakhir
    var item = response['info'][response['info'].length - 1];

    // Hanya proses jika request_status_id = 6
    if (item.request_status_id == 6) {
        // Jika expireCount = 0, tidak perlu menampilkan alert
        if (item.expireCount == 0) {
            return;
        }

        // Tentukan class dan text berdasarkan expireCount
        let alertClass = 'alert-danger';
        let alertText = '';

        if (item.expireCount == 1) {
            alertClass = 'alert-warning';
            alertText = "Polis anda akan segera berakhir";
        } else if (item.expireCount == 2) {
            alertClass = 'alert-danger';
            alertText = "Polis anda telah berakhir";
        }

        // Append alert baru ke container (gunakan parent .col-12)
        $('.polis-alert-container').html(polisAlertInnerTemplate);

        // Update class dan text
        $('#div-polis-alert').removeClass('alert-danger alert-warning').addClass(alertClass);
        $('#polis-alert').text(alertText);
    }
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

function downloadNota() {
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];
    if (!token) {
        Swal.fire('Error', 'Token tidak ditemukan. Silakan login ulang.', 'error');
        return;
    }

    if (!requestId) {
        Swal.fire('Error', 'Request ID tidak tersedia.', 'error');
        return;
    }

    Swal.fire({
        title: 'Mengunduh Nota...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: `${apiUrl}/api/client/document/nota`,
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`,
            "Content-Type": "application/json"
        },
        data: {
            type: 2,
            reqId: requestId
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(blob, status, xhr) {
            Swal.close();

            let filename = "nota.pdf";

            // Ambil Content-Disposition
            const disposition = xhr.getResponseHeader('Content-Disposition');
            if (disposition && disposition.indexOf('filename=') !== -1) {
                // Gunakan regex untuk ekstrak filename (termasuk versi dengan kutipan)
                const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                const matches = filenameRegex.exec(disposition);
                if (matches && matches[1]) {
                    filename = matches[1].replace(/['"]/g, '');
                }
            }

            // Sanitasi nama file
            filename = sanitizeFilename(filename);

            // Buat URL blob dan unduh
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        },
        error: function(xhr, status, error) {
            Swal.close();
            Swal.fire('Gagal', 'Gagal mengunduh nota. Silakan coba lagi.', 'error');
            console.error("Download Nota Error:", error);
        }
    });
}

function downloadKwitansi() {
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];
    if (!token) {
        Swal.fire('Error', 'Token tidak ditemukan. Silakan login ulang.', 'error');
        return;
    }

    if (!requestId) {
        Swal.fire('Error', 'Request ID tidak tersedia.', 'error');
        return;
    }

    Swal.fire({
        title: 'Mengunduh Kwitansi...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: `${apiUrl}/api/client/document/kwitansi`,
        method: "GET",
        headers: {
            "Authorization": `Bearer ${token}`,
            "Content-Type": "application/json"
        },
        data: {
            type: 2,
            reqId: requestId
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: function(blob, status, xhr) {
            Swal.close();

            let filename = "kwitansi.pdf";

            const disposition = xhr.getResponseHeader('Content-Disposition');
            if (disposition && disposition.indexOf('filename=') !== -1) {
                const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                const matches = filenameRegex.exec(disposition);
                if (matches && matches[1]) {
                    filename = matches[1].replace(/['"]/g, '');
                }
            }

            filename = sanitizeFilename(filename);

            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        },
        error: function(xhr, status, error) {
            Swal.close();
            Swal.fire('Gagal', 'Gagal mengunduh kwitansi. Silakan coba lagi.', 'error');
            console.error("Download Kwitansi Error:", error);
        }
    });
}

// ✅ Fungsi sanitasi nama file (digunakan oleh kedua fungsi)
function sanitizeFilename(filename) {
    // Ganti karakter ilegal dengan underscore
    const invalidChars = /[\/\\:*?"<>|]/g;
    filename = filename.replace(invalidChars, '_');

    // Ganti spasi dengan underscore
    filename = filename.replace(/\s+/g, '_');

    // Pastikan ekstensi .pdf ada
    if (!filename.endsWith('.pdf')) {
        filename += '.pdf';
    }

    // Batasi panjang nama file (opsional, tapi aman)
    if (filename.length > 255) {
        filename = filename.substring(0, 255);
    }

    return filename;
}
