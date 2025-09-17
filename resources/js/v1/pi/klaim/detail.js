import {
    decryptData,
    encryptData,
} from "../../encrypt.js";

let searchParams = new URLSearchParams(window.location.search);
let pathSegments = window.location.pathname.split('/').filter(segment => segment);
let id = pathSegments[pathSegments.length - 1]; // Ambil segment terakhir
const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
const token = cookie ? cookie.split('=')[1] : null;

let detail, url, doc;

$(document).ready(async function () {
    url = 'client'; // default ke admin, sesuaikan jika perlu

    getDataDetail();
});

function getDataDetail() {
    Swal.fire({
        icon: "info",
        text: "Loading...",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        url: `${apiUrl}/api/${url}/klaim/detail`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": "Bearer " + token
        },
        data: {
            klaimId: id
        },
    }).done(async function (responses) {
        let response = await decryptData(responses['data']);
        console.log(response);
        detail = response;

        let klaim = response.klaim[0];
        let statusId = klaim.klaim_status_id;

        $('#accept-date').html(klaim.accept_date || '-');
        $('#register-no').html(klaim.klaim_no);
        $('#sum-insured').html(klaim.sum_insured);
        $('#nama').html(klaim.nama);
        $('#no-hp').html(klaim.no_hp);
        $('#email').html(klaim.email);
        $('#polis-no').html(`${klaim.polis_no} <i>(${klaim.insurance})</i>`);
        $('#sip-no').html(klaim.sip_no);
        $('#str-no').html(klaim.str_no);
        $('#profesi').html(klaim.profesi);
        $('#kategori').html(klaim.kategori);
        $('#sip-periode').html(`${klaim.sip_date_start} <b>s/d</b> ${klaim.sip_date_end}`);
        $('#periode-polis').html(`${klaim.polis_start_date} <b>s/d</b> ${klaim.polis_end_date}`);
        $('#tempat-praktik').html(klaim.tempat_praktik);
        $('#report-date').html(klaim.report_date);
        $('#cause-of-action').html(klaim.cause_of_action);
        $('#incident-location').html(klaim.incident_location);
        $('#incident-date').html(klaim.incident_date);
        $('#pic-name').html(klaim.pic_name);
        $('#pic-no').html(klaim.pic_no);
        $('#patient-name').html(klaim.patient_name);
        $('#patient-age').html(`${klaim.patient_age} tahun`);
        $('#patient-gender').html(klaim.patient_gender == "1" ? 'Laki - Laki' : 'Perempuan');
        $('#incident-description').html(klaim.incident_description);

        if (klaim.str_stat == "1") {
            $('#str-stat').html('Status : Seumur Hidup');
            $('#label-str').html('Periode Awal STR : ' + klaim.str_period);
        } else {
            $('#str-stat').html('Status : Belum Seumur Hidup');
            $('#label-str').html('Masa Berakhir STR : ' + klaim.str_period);
        }

        $('#div-btn').empty();

        const getStatusesByStatusId = (statusId) => {
            const statuses = [];

            // Default semua status jadi 'Belum Mulai'
            statuses.push(
                { id: '#status-poin-satu', class: 'bg-light-danger border border-danger', text: 'Belum Mulai' },
                { id: '#status-poin-dua', class: 'bg-light-danger border border-danger', text: 'Belum Mulai' },
                { id: '#status-poin-tiga', class: 'bg-light-danger border border-danger', text: 'Belum Mulai' },
                { id: '#status-poin-empat', class: 'bg-light-danger border border-danger', text: 'Belum Mulai' },
                { id: '#status-poin-lima', class: 'bg-light-danger border border-danger', text: 'Belum Mulai' },
                { id: '#status-poin-enam', class: 'bg-light-danger border border-danger', text: 'Belum Mulai' }
            );

            const poinStatus = [];

            if (statusId > 0 && statusId <= 3) {
                statuses[0] = { id: '#status-poin-satu', class: 'bg-light-warning border border-warning', text: 'Dalam Proses' };
                poinStatus.push({ id: '#poin-satu', class: 'js-proses' });
            }
            if (statusId > 4 && statusId <= 6) {
                statuses[0] = { id: '#status-poin-satu', class: 'bg-light-success border border-success', text: 'Selesai' };
                statuses[1] = { id: '#status-poin-dua', class: 'bg-light-warning border border-warning', text: 'Dalam Proses' };
                poinStatus.push({ id: '#poin-satu', class: 'js-active' });
                poinStatus.push({ id: '#poin-dua', class: 'js-proses' });
            }

            if (statusId >= 7 && statusId <= 11) {
                statuses[0] = { id: '#status-poin-satu', class: 'bg-light-success border border-success', text: 'Selesai' };
                statuses[1] = { id: '#status-poin-dua', class: 'bg-light-warning border border-warning', text: 'Dalam Proses' };
                poinStatus.push(
                    { id: '#poin-satu', class: 'js-active' },
                    { id: '#poin-dua', class: 'js-proses' },
                );
            }
            if (statusId == 12) {
                statuses[0] = { id: '#status-poin-satu', class: 'bg-light-success border border-success', text: 'Selesai' };
                statuses[1] = { id: '#status-poin-dua', class: 'bg-light-success border border-success', text: 'Selesai' };
                statuses[2] = { id: '#status-poin-empat', class: 'bg-light-warning border border-warning', text: 'Dalam Proses' };

                poinStatus.push(
                    { id: '#poin-satu', class: 'js-active' },
                    { id: '#poin-dua', class: 'js-active' },
                    { id: '#poin-empat', class: 'js-proses' },

                );
            }
            if (statusId == 13) {
                statuses[0] = { id: '#status-poin-satu', class: 'bg-light-success border border-success', text: 'Selesai' };
                statuses[1] = { id: '#status-poin-dua', class: 'bg-light-success border border-success', text: 'Selesai' };
                statuses[2] = { id: '#status-poin-empat', class: 'bg-light-success border border-success', text: 'Selesai' };
                statuses[3] = { id: '#status-poin-lima', class: 'bg-light-success border border-success', text: 'Selesai' };

                poinStatus.push(
                    { id: '#poin-satu', class: 'js-active' },
                    { id: '#poin-dua', class: 'js-active' },
                    { id: '#poin-empat', class: 'js-active' },
                    { id: '#poin-lima', class: 'js-active' },

                );
            }

            return [...statuses, ...poinStatus];
        };

        const statuses = getStatusesByStatusId(statusId);

        statuses.forEach(status => {
            $(status.id).addClass(status.class).text(status.text);
        });

        $('#list-log').empty();
        $.each(response.log, function (j, item) {
            $('#list-log').append(`
                <li>
                    <i class="feather icon-check f-w-600 task-icon bg-success"></i>
                    <p class="m-b-5">${item.created_at}</p>
                    <h5 class="text-muted">${item.status_description}</h5>
                    <h6 style="color: darkgrey">${item.description}</h6>
                </li>
            `);
        });

        $('#table-doc').empty();

        if (!response.document || response.document.length === 0) {
            $('#table-doc').append(`
                <tr>
                    <td colspan="3" style="text-align:center; font-style: italic;">Belum ada Dokumen</td>
                </tr>
            `);
        } else {
            $.each(response.document, function (j, item) {
                $('#table-doc').append(`
                    <tr>
                        <td>${j + 1}</td>
                        <td>${item.document_name}</td>
                        <td><a href="/${item.file_path}" target="_blank">${item.file_name}</a></td>
                    </tr>
                `);
            });
        }

        Swal.close();
    }).fail(function () {
        Swal.fire({
            icon: 'error',
            title: 'Gagal memuat data',
            showConfirmButton: true
        });
    });
}

$(document).on('click', '.btnVal, #btn-rev', function () {
    const stat = $(this).data('stat');
    validasi(stat, $(this).text());
});

$(document).on('click', '#btn-val-med, #btn-close', function () {
    const stat = $(this).data('stat');
    validasiMedicolegal(stat);
});

function validasiMedicolegal(stat) {
    let html = `
        <div class="form-group">
            <label for="desc" style="display:block; text-align:left; margin-bottom: 5px;">Keterangan</label>
            <textarea name="desc" id="desc" class="form-control" placeholder="Tulis keterangan di sini..."></textarea>
        </div>
    `;

    doc = detail.document || [];
    $.each(doc, function (j, item) {
        html += `
            <div class="form-group">
                <label for="upload-file-${j}" style="display:block; text-align:left; margin-bottom: 5px;">Unggah ${item.document_name}</label>
                <input type="file" name="upload-file" data-type="${item.file_type}" class="form-control upload-file" accept="*/*">
            </div>
        `;
    });

    Swal.fire({
        title: "Apakah anda yakin?",
        html: html,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Oke",
        preConfirm: async () => {
            const popup = Swal.getPopup();
            const fileInputs = popup.querySelectorAll('.upload-file');
            const textInput = popup.querySelector('#desc');
            const descValue = textInput ? textInput.value.trim() : '';

            if (!descValue) {
                Swal.showValidationMessage("Keterangan wajib diisi");
                return false;
            }

            let allFiles = [];
            let hasRequiredFile = false;

            for (const input of fileInputs) {
                const files = input.files;
                const dataType = input.dataset.type;

                if (!files.length) {
                    if (dataType == '6') {
                        Swal.showValidationMessage("File hasil investigasi wajib diunggah");
                        return false;
                    } else if (dataType != '10') {
                        Swal.showValidationMessage("File wajib diunggah");
                        return false;
                    }
                    continue;
                }

                if (dataType == '6') {
                    hasRequiredFile = true;
                }

                for (const file of files) {
                    const base64 = await convertFileToBase64(file);
                    allFiles.push({
                        file_base64: base64,
                        file_type: parseInt(dataType)
                    });
                }
            }

            if (stat == 10 && !hasRequiredFile) {
                Swal.showValidationMessage("File hasil investigasi wajib diunggah");
                return false;
            }

            return {
                files: allFiles,
                desc: descValue
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const { files, desc } = result.value;
            sendValidation(stat, desc, files);
        }
    });
}

function validasi(stat, title) {
    Swal.fire({
        title: title,
        html: `
            <div class="form-group">
                <label for="desc" style="display:block; text-align:left; margin-bottom: 5px;">Keterangan</label>
                <textarea name="desc" id="desc" class="form-control" placeholder="Tulis keterangan di sini..."></textarea>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: "Oke",
        focusConfirm: false,
        preConfirm: () => {
            const textarea = Swal.getPopup().querySelector('#desc');
            return textarea.value;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            sendValidation(stat, result.value);
        }
    });
}

async function sendValidation(stat, desc = '', uploadData = []) {
    Swal.fire({
        icon: 'info',
        text: "Loading!",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    if (!desc) desc = '-';

    let data = JSON.stringify({
        klaimId: id,
        statusId: stat,
        description: desc,
        upload: uploadData
    });

    $.ajax({
        url: `${apiUrl}/api/${url}/klaim/update-status`,
        method: "POST",
        timeout: 0,
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + token
        },
        data: data,
        success: function (response) {
            Swal.fire({
                icon: 'success',
                text: "Berhasil!",
                showConfirmButton: false,
                timer: 1500
            });

            setTimeout(function () {
                location.reload();
            }, 1600);
        },
        error: function (xhr) {
            try {
                let err = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: err.message || 'Terjadi kesalahan',
                    showConfirmButton: false,
                    timer: 2000
                });
            } catch (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan tak terduga',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }
    });
}

function convertFileToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
    });
}
