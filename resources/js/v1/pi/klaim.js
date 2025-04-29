import { decryptData, encryptData } from "../encrypt.js";

// Ambil token dari cookie dengan aman
const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
const token = cookie ? cookie.split('=')[1] : null;

$(document).ready(async function() {
    const today = new Date();

    // Inisialisasi datepicker
    new Datepicker(document.querySelector('#tanggal-lapor'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        maxDate: today
    });

    new Datepicker(document.querySelector('#tanggal-kejadian'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        maxDate: today
    });

    try {
        const sipDatas = await fetchSIPData();
        populateSIP(sipDatas);
        attachSIPClickHandler(); // Pasang event handler setelah populate
    } catch (error) {
        $('#sip-container').empty();
        Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat Data SIP',
            text: error.message || 'Terjadi kesalahan saat memuat data SIP.',
        });
    }
});

// Fungsi untuk memanggil API dan mengembalikan data yang sudah didecrypt
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

// Fungsi untuk populate data SIP ke radio button
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

// Pasang event handler klik/checked pada radio SIP
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

// Fungsi untuk fetch dokumen berdasarkan SIP ID dan tampilkan di bawah keterangan
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
    const documents = decrypted.datas || [];

    $dokumenContainer.empty();

    // Daftar file_type yang harus dicek
    const requiredFileTypes = [
        { type: 1, label: 'Dokumen Polis' },
        { type: 2, label: 'KTP' },
        { type: 3, label: 'Dokumen STR' },
        { type: 4, label: 'Dokumen SIP' }
    ];

    // Buat container row bootstrap
    const $row = $('<div class="row g-3"></div>');

    requiredFileTypes.forEach(({ type, label }) => {
        // Cari dokumen dengan file_type ini
        const doc = documents.find(d => d.file_type === type);

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
            // Jika dokumen tidak ada, tampilkan input file upload
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
