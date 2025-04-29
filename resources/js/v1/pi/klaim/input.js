import { decryptData, encryptData } from "../../encrypt.js";

// Ambil token dari cookie dengan aman
const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
const token = cookie ? cookie.split('=')[1] : null;

$(document).ready(async function() {
    const today = new Date();

    // Format tanggal ke dd-mm-yyyy
    function formatDate(date) {
        const d = date.getDate().toString().padStart(2, '0');
        const m = (date.getMonth() + 1).toString().padStart(2, '0');
        const y = date.getFullYear();
        return `${d}-${m}-${y}`;
    }

    // Set default tanggal-lapor ke hari ini
    $('#tanggal-lapor').val(formatDate(today));

    // Inisialisasi datepicker dengan maxDate dan minDate dinamis
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

    // Fungsi untuk parse tanggal dari format dd-mm-yyyy ke Date object
    function parseDate(str) {
        const [d, m, y] = str.split('-').map(Number);
        return new Date(y, m - 1, d);
    }

    // Update batas min/max tanggal berdasarkan input lawan
    function updateDateConstraints() {
        const tanggalLaporVal = $('#tanggal-lapor').val();
        const tanggalKejadianVal = $('#tanggal-kejadian').val();

        if (tanggalLaporVal) {
            const tanggalLaporDate = parseDate(tanggalLaporVal);
            // tanggal-kejadian maxDate tidak boleh lebih dari tanggal-lapor
            tanggalKejadianPicker.setOptions({ maxDate: tanggalLaporDate < today ? tanggalLaporDate : today });
            // Jika tanggal-kejadian lebih dari tanggal-lapor, reset tanggal-kejadian
            if (tanggalKejadianVal) {
                const tanggalKejadianDate = parseDate(tanggalKejadianVal);
                if (tanggalKejadianDate > tanggalLaporDate) {
                    $('#tanggal-kejadian').val('');
                }
            }
        } else {
            // Jika tanggal-lapor kosong, tanggal-kejadian maxDate default ke today
            tanggalKejadianPicker.setOptions({ maxDate: today });
        }

        if (tanggalKejadianVal) {
            const tanggalKejadianDate = parseDate(tanggalKejadianVal);
            // tanggal-lapor minDate tidak boleh kurang dari tanggal-kejadian
            tanggalLaporPicker.setOptions({ minDate: tanggalKejadianDate });
            // Jika tanggal-lapor kurang dari tanggal-kejadian, reset tanggal-lapor ke tanggal-kejadian
            if (tanggalLaporVal) {
                const tanggalLaporDate = parseDate(tanggalLaporVal);
                if (tanggalLaporDate < tanggalKejadianDate) {
                    $('#tanggal-lapor').val(formatDate(tanggalKejadianDate));
                }
            }
        } else {
            // Jika tanggal-kejadian kosong, tanggal-lapor minDate default ke null (no min)
            tanggalLaporPicker.setOptions({ minDate: null });
        }
    }

    // Pasang event listener untuk update constraints saat tanggal berubah
    $('#tanggal-lapor').on('change', updateDateConstraints);
    $('#tanggal-kejadian').on('change', updateDateConstraints);

    // Jalankan sekali saat load untuk set constraints awal
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

async function submitKlaim() {
    try {
        // Ambil data dari form
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

        // Validasi sederhana
        if (!reportDate || !incidentDate || !incidentDescription || !picName || !picNo) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Semua kolom wajib diisi'
            });
            return;
        }

        // Validasi tanggal: tanggal-lapor >= tanggal-kejadian
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

        // Ambil file upload untuk tiap file_type (1-4)
        // Asumsikan input file upload punya name="dokumen_upload_1", "dokumen_upload_2", dst
        const uploads = [];
        for (let fileType = 1; fileType <= 4; fileType++) {
            const inputFile = $(`input[name="dokumen_upload_${fileType}"]`)[0];
            if (inputFile && inputFile.files.length > 0) {
                for (const file of inputFile.files) {
                    const base64 = await fileToBase64(file);
                    uploads.push({
                        file_type: fileType,
                        file_name: file.name,
                        file_path: '', // kosongkan atau isi sesuai kebutuhan
                        file_base64: base64.split(',')[1] // hilangkan prefix data:...base64,
                    });
                }
            }
        }

        // Siapkan payload
        const payload = {
            sipId: sipId.toString(),
            report_date: reportDate,
            incident_date: incidentDate,
            incident_description: incidentDescription,
            pic_name: picName,
            pic_no: picNo,
            upload: uploads
        };

        // Kirim POST request
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
                // Redirect ke detail klaim dengan data hasil decrypt
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

// Fungsi helper untuk konversi file ke base64
function fileToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
    });
}
