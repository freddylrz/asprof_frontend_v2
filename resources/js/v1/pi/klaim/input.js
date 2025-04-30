import { decryptData, encryptData } from "../../encrypt.js";

let documentsList = []; // Array global untuk menyimpan data dokumen

// Ambil token dari cookie dengan aman
const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
const token = cookie ? cookie.split('=')[1] : null;

$(document).ready(async function() {
    const today = new Date();

    function formatDate(date) {
        const d = date.getDate().toString().padStart(2, '0');
        const m = (date.getMonth() + 1).toString().padStart(2, '0');
        const y = date.getFullYear();
        return `${d}-${m}-${y}`;
    }

    $('#tanggal-lapor').val(formatDate(today));

    const tanggalLaporPicker = new Datepicker(document.querySelector('#tanggal-lapor'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        maxDate: today,
        autohide: true
    });

    const tanggalKejadianPicker = new Datepicker(document.querySelector('#tanggal-kejadian'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        maxDate: today,
        autohide: true
    });

    function parseDate(str) {
        const [d, m, y] = str.split('-').map(Number);
        return new Date(y, m - 1, d);
    }

    function updateDateConstraints() {
        const tanggalLaporVal = $('#tanggal-lapor').val();
        const tanggalKejadianVal = $('#tanggal-kejadian').val();

        if (tanggalLaporVal) {
            const tanggalLaporDate = parseDate(tanggalLaporVal);
            tanggalKejadianPicker.setOptions({ maxDate: tanggalLaporDate < today ? tanggalLaporDate : today });
            if (tanggalKejadianVal) {
                const tanggalKejadianDate = parseDate(tanggalKejadianVal);
                if (tanggalKejadianDate > tanggalLaporDate) {
                    $('#tanggal-kejadian').val('');
                }
            }
        } else {
            tanggalKejadianPicker.setOptions({ maxDate: today });
        }

        if (tanggalKejadianVal) {
            const tanggalKejadianDate = parseDate(tanggalKejadianVal);
            tanggalLaporPicker.setOptions({ minDate: tanggalKejadianDate });
            if (tanggalLaporVal) {
                const tanggalLaporDate = parseDate(tanggalLaporVal);
                if (tanggalLaporDate < tanggalKejadianDate) {
                    $('#tanggal-lapor').val(formatDate(tanggalKejadianDate));
                }
            }
        } else {
            tanggalLaporPicker.setOptions({ minDate: null });
        }
    }

    $('#tanggal-lapor').on('change', updateDateConstraints);
    $('#tanggal-kejadian').on('change', updateDateConstraints);

    updateDateConstraints();

    $(".mobilenumber").inputmask({
        mask: "9999-9999-999999",
        placeholder: ""
    });

    $('button[type="submit"]').on('click', function(e) {
        e.preventDefault();
        submitKlaim();
    });

    try {
        const sipDatas = await fetchSIPData();
        populateSIP(sipDatas);
        attachSIPClickHandler();
    } catch (error) {
        $('#sip-container').empty();
        Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat Data SIP',
            text: error.message || 'Terjadi kesalahan saat memuat data SIP.',
        });
    }
});

async function fetchSIPData() {
    const response = await fetch(`${apiUrl}/api/client/klaim/register-asset?type=2`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    });
    const result = await response.json();
    if (result.status === 200) {
        const decrypted = await decryptData(result.data);
        return decrypted.datas || [];
    } else {
        throw new Error('Gagal mendapatkan data SIP dari server.');
    }
}

function populateSIP(sipDatas) {
    const $container = $('#sip-container');
    $container.empty();

    if (sipDatas.length === 0) {
        $container.append('<div class="text-muted text-center py-3">Data SIP tidak tersedia.</div>');
        return;
    }

    sipDatas.forEach(sip => {
        const radioId = `sip-radio-${sip.id}`;
        const radioHtml = `
        <div class="offer-check border border-dark rounded p-3">
            <div class="form-check">
                <input type="radio" name="radio1" class="form-check-input input-primary" id="${radioId}" data-sipid="${sip.id}" />
                <label class="form-check-label d-block" for="${radioId}">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-12 m-b-10">
                            <span class="mb-2 d-block">Nomor SIP:</span>
                            <span class="h5 mb-1 d-block">${sip.sip_no}</span>
                            <h6 class="text-muted offer-details">
                                <i><i class="ti ti-calendar-time"></i> ${sip.sip_date_start} s/d ${sip.sip_date_end}</i>
                            </h6>
                        </div>
                        <div class="col-12 col-md-6 col-lg-12 m-b-10">
                            <span class="mb-2 d-block">Tempat Praktik:</span>
                            <span class="h5 mb-1 d-block">${sip.tempat_praktik}</span>
                        </div>
                    </div>
                </label>
            </div>
        </div>`;
        $container.append(radioHtml);
    });
}

function attachSIPClickHandler() {
    $('#sip-container').on('change', 'input[name="radio1"]', async function() {
        const selectedSIPId = $(this).data('sipid');
        if (!selectedSIPId) return;

        try {
            await fetchAndDisplayDocuments(selectedSIPId);
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Dokumen',
                text: error.message || 'Terjadi kesalahan saat memuat dokumen.',
            });
        }
    });
}

async function fetchAndDisplayDocuments(sipId) {
    const $dokumenContainer = $('#dokumen-container');
    $dokumenContainer.html(`
        <div class="text-center py-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div>Memuat dokumen...</div>
        </div>
    `);

    const response = await fetch(`${apiUrl}/api/client/klaim/register-asset?type=3&sipId=${sipId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    });
    const result = await response.json();

    if (result.status !== 200) {
        $dokumenContainer.empty();
        throw new Error('Gagal mendapatkan data dokumen dari server.');
    }

    const decrypted = await decryptData(result.data);
    documentsList = decrypted.datas || [];

    $dokumenContainer.empty();

    const requiredFileTypes = [
        { type: 1, label: 'Dokumen Polis' },
        { type: 2, label: 'KTP' },
        { type: 3, label: 'Dokumen STR' },
        { type: 4, label: 'Dokumen SIP' }
    ];

    const $row = $('<div class="row g-3"></div>');

    requiredFileTypes.forEach(({ type, label }) => {
        const doc = documentsList.find(d => d.file_type === type);

        const $col = $('<div class="col-12 col-md-6"></div>');

        if (doc) {
            const fileUrl = `${apiUrl}/${doc.file_path}`;
            const $card = $(`
                <div class="border rounded p-3 h-100 d-flex flex-column justify-content-center">
                    <strong class="mb-2">${label}</strong>
                    <a href="${fileUrl}" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-primary">
                        <i class="ti ti-file-text me-1"></i> ${doc.file_name}
                    </a>
                </div>
            `);
            $col.append($card);
        } else {
            const $uploadGroup = $(`
                <div class="border rounded p-3 h-100 d-flex flex-column">
                    <label class="form-label mb-2">${label} <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="dokumen_upload_${type}" />
                </div>
            `);
            $col.append($uploadGroup);
        }

        $row.append($col);
    });

    $dokumenContainer.append($row);
}

async function submitKlaim() {
    try {
        const sipId = $('input[name="radio1"]:checked').data('sipid');
        if (!sipId) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih SIP terlebih dahulu'
            });
            return;
        }

        const reportDate = $('#tanggal-lapor').val();
        const incidentDate = $('#tanggal-kejadian').val();
        const incidentDescription = $('#keterangan-kejadian').val();
        const picName = $('#nama-pic').val();
        const picNo = $('#nomor-telpon-pic').val();

        if (!reportDate || !incidentDate || !incidentDescription || !picName || !picNo) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Semua kolom wajib diisi'
            });
            return;
        }

        function parseDate(str) {
            const [d, m, y] = str.split('-').map(Number);
            return new Date(y, m - 1, d);
        }
        const reportDateObj = parseDate(reportDate);
        const incidentDateObj = parseDate(incidentDate);
        if (reportDateObj < incidentDateObj) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tanggal Lapor tidak boleh kurang dari Tanggal Kejadian'
            });
            return;
        }
        if (incidentDateObj > reportDateObj) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tanggal Kejadian tidak boleh lebih dari Tanggal Lapor'
            });
            return;
        }

        const requiredFileTypes = [
            { type: 1, label: 'Dokumen Polis' },
            { type: 2, label: 'KTP' },
            { type: 3, label: 'Dokumen STR' },
            { type: 4, label: 'Dokumen SIP' }
        ];

        // Validasi file upload wajib berdasarkan keberadaan file_type di documentsList
        for (const { type, label } of requiredFileTypes) {
            const docExists = documentsList.some(doc => doc.file_type === type);
            if (!docExists) {
                const inputFile = $(`input[name="dokumen_upload_${type}"]`)[0];
                if (!inputFile || inputFile.files.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: `File upload untuk "${label}" wajib diisi.`
                    });
                    return;
                }
            }
        }

        const upload = await Promise.all(requiredFileTypes.map(async ({ type }) => {
            const inputFile = $(`input[name="dokumen_upload_${type}"]`)[0];
            if (inputFile && inputFile.files.length > 0) {
                const base64 = await fileToBase64(inputFile.files[0]);
                return {
                    file_type: type,
                    file_name: '',
                    file_path: '',
                    file_base64: base64.split(',')[1]
                };
            } else {
                const doc = documentsList.find(d => d.file_type === type);
                return {
                    file_type: type,
                    file_name: doc ? doc.file_name : '',
                    file_path: doc ? doc.file_path : '',
                    file_base64: ''
                };
            }
        }));

        const payload = {
            sipId: sipId.toString(),
            report_date: reportDate,
            incident_date: incidentDate,
            incident_description: incidentDescription,
            pic_name: picName,
            pic_no: picNo,
            upload
        };

        const response = await fetch(`${apiUrl}/api/client/klaim/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (response.ok && result.status === 200) {
            const decryptedData = await decryptData(result.data);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: result.message || 'Klaim berhasil dikirim',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = `/klaim/detail/${decryptedData.klaimId}`;
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: result.message || 'Terjadi kesalahan saat mengirim klaim',
            });
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Terjadi kesalahan',
        });
    }
}

function fileToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
    });
}
