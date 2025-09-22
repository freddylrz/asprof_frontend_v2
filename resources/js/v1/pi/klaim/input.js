import { decryptData, encryptData } from "../../encrypt.js";

let documentsList = [];
let selectedSIPData = null;
const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
const token = cookie ? cookie.split('=')[1] : null;

// Fungsi untuk menampilkan loading global dengan SweetAlert2
function showGlobalLoading(message = 'Memuat data...') {
    Swal.fire({
        title: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

// Fungsi untuk menyembunyikan loading global
function hideGlobalLoading() {
    Swal.close();
}

$(document).ready(async function () {
    showGlobalLoading('Memuat data');

    const today = new Date();

    function formatDate(date) {
        const d = date.getDate().toString().padStart(2, '0');
        const m = (date.getMonth() + 1).toString().padStart(2, '0');
        const y = date.getFullYear();
        return `${d}-${m}-${y}`;
    }

    $('#tanggal-pengaduan').val(formatDate(today));
    $('#tanggal-pengaduan').prop('disabled', true);

    const tanggalPengaduanPicker = new Datepicker(document.querySelector('#tanggal-pengaduan'), {
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

    function updateDateConstraints() {
        const tanggalKejadianVal = $('#tanggal-kejadian').val();
        if (tanggalKejadianVal) {
            const kejadianDate = parseDate(tanggalKejadianVal);
            tanggalPengaduanPicker.setOptions({ maxDate: kejadianDate });
        }
    }

    $('#tanggal-kejadian').on('change', updateDateConstraints);

    $(".mobilenumber").inputmask({
        mask: "9999-9999-999999",
        placeholder: ""
    });

    // 👇 Gunakan event submit dari form, bukan tombol
    $('#form-pengajuan-klaim').on('submit', function (e) {
        e.preventDefault();
        submitKlaim();
    });

    try {
        await checkSTRStatus();
        await checkSIPStatus();
        await checkPolicyStatus();
        await populateDashboardData();
        loadSIPList();
        hideGlobalLoading();
    } catch (error) {
        hideGlobalLoading();
        Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat Data',
            text: error.message || 'Terjadi kesalahan saat memuat data awal.',
        });
    }
});

// Fungsi parsing tanggal dari format dd-mm-yyyy ke Date object
function parseDate(str) {
    const [d, m, y] = str.split('-').map(Number);
    return new Date(y, m - 1, d);
}

// Fungsi format tanggal ke YYYY-MM-DD untuk API
function formatDateYmd(dateObj) {
    const y = dateObj.getFullYear();
    const m = String(dateObj.getMonth() + 1).padStart(2, '0');
    const d = String(dateObj.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}

async function checkSTRStatus() {
    try {
        const response = await fetch(`${apiUrl}/api/client/dashboard`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const result = await response.json();
        if (result.status !== 200) {
            throw new Error('Gagal memuat data dashboard');
        }

        const decrypted = await decryptData(result.data);
        const userData = decrypted.data?.[0];

        if (!userData) {
            throw new Error('Data pengguna tidak ditemukan');
        }

        const strStat = userData.str_stat;
        const strEndDateStr = userData.str_date_end;

        if (strStat !== "1") {
            const [d, m, y] = strEndDateStr.split('-').map(Number);
            const strEndDate = new Date(y, m - 1, d);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            strEndDate.setHours(0, 0, 0, 0);

            if (strEndDate < today) {
                Swal.fire({
                    icon: 'error',
                    title: 'STR Kadaluarsa',
                    text: 'Masa berlaku STR Anda telah berakhir. Silakan perbarui STR terlebih dahulu.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'Ke Dashboard',
                }).then(() => {
                    window.location.href = '/dashboard';
                });
            }
        }
    } catch (error) {
        console.error('Error checking STR status:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal Validasi STR',
            text: error.message || 'Terjadi kesalahan saat memvalidasi status STR.',
        });
    }
}

async function checkSIPStatus() {
    try {
        const response = await fetch(`${apiUrl}/api/client/dashboard`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const result = await response.json();
        if (result.status !== 200) {
            throw new Error('Gagal memuat data dashboard');
        }

        const decrypted = await decryptData(result.data);
        const sipData = decrypted.sip || [];

        if (!sipData || sipData.length === 0) {
            throw new Error('Data SIP tidak ditemukan');
        }

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        let validSIPCount = 0;

        sipData.forEach(sip => {
            const sipEndDateStr = sip.sip_date_end;
            if (sipEndDateStr) {
                const [d, m, y] = sipEndDateStr.split('-').map(Number);
                const sipEndDate = new Date(y, m - 1, d);
                sipEndDate.setHours(0, 0, 0, 0);

                if (sipEndDate >= today) {
                    validSIPCount++;
                }
            }
        });

        if (validSIPCount === 0) {
            Swal.fire({
                icon: 'error',
                title: 'SIP Kadaluarsa',
                text: 'Semua Surat Izin Praktik (SIP) Anda telah berakhir. Silakan perbarui SIP terlebih dahulu.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'Ke Dashboard',
            }).then(() => {
                window.location.href = '/dashboard';
            });
        }
    } catch (error) {
        console.error('Error checking SIP status:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal Validasi SIP',
            text: error.message || 'Terjadi kesalahan saat memvalidasi status SIP.',
        });
    }
}

async function checkPolicyStatus() {
    try {
        const response = await fetch(`${apiUrl}/api/client/dashboard`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const result = await response.json();
        if (result.status !== 200) {
            throw new Error('Gagal memuat data dashboard');
        }

        const decrypted = await decryptData(result.data);
        const policyData = decrypted.policy?.[0];

        if (!policyData) {
            throw new Error('Data polis tidak ditemukan');
        }

        const policyEndDateStr = policyData.polis_end_date;

        if (policyEndDateStr) {
            const [d, m, y] = policyEndDateStr.split('-').map(Number);
            const policyEndDate = new Date(y, m - 1, d);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            policyEndDate.setHours(0, 0, 0, 0);

            if (policyEndDate < today) {
                Swal.fire({
                    icon: 'error',
                    title: 'Polis Kadaluarsa',
                    text: 'Polis Anda telah berakhir. Silakan perbarui polis terlebih dahulu.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: 'Ke Dashboard',
                }).then(() => {
                    window.location.href = '/dashboard';
                });
            }
        }
    } catch (error) {
        console.error('Error checking Policy status:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal Validasi Polis',
            text: error.message || 'Terjadi kesalahan saat memvalidasi status polis.',
        });
    }
}

async function populateDashboardData() {
    try {
        const response = await fetch(`${apiUrl}/api/client/dashboard`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const result = await response.json();
        if (result.status !== 200) {
            throw new Error('Gagal memuat data dashboard');
        }

        const decrypted = await decryptData(result.data);
        const userData = decrypted.data?.[0];
        const policyData = decrypted.policy?.[0];

        if (!userData || !policyData) {
            throw new Error('Data tidak lengkap');
        }

        // Informasi Polis
        $('#no-sertifikat').val(policyData.polis_no);
        $('#asuransi').val(policyData.ins_nama);
        $('#periode-polis').val(`${policyData.polis_start_date} s/d ${policyData.polis_end_date}`);
        $('#jaminan-pertanggungan').val(policyData.sum_insured || 'Asuransi Kesehatan Profesional');
        $('#nama-peserta').val(userData.nama);
        $('#no-hp').val(userData.no_hp);
        $('#email').val(userData.email);
        $('#profesi').val(userData.profesi_kategori_desc);
        $('#no-str').val(userData.str_no);
        $('#klaim-profesi').text(userData.profesi_desc);

        // Dokumen (auto-fill jika tersedia)
        const documents = decrypted.document || [];
        const docMap = {};
        documents.forEach(doc => {
            docMap[doc.file_type] = doc;
        });

        // Simpan untuk referensi di validasi upload
        documentsList = documents;
    } catch (error) {
        console.error('Error populating dashboard ', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat Data Awal',
            text: error.message || 'Terjadi kesalahan saat memuat data awal.',
        });
    }
}

function loadSIPList() {
    const $container = $('#sip-list-container');
    $container.html(`
        <div class="text-center py-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div>Memuat daftar SIP...</div>
        </div>
    `);

    fetch(`${apiUrl}/api/client/klaim/register-asset?type=2`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
        .then(response => response.json())
        .then(async (result) => {
            if (result.status === 200) {
                const decrypted = await decryptData(result.data);
                const sipDatas = decrypted.datas || [];
                renderSIPList(sipDatas);
            } else {
                $container.empty();
                $container.append('<div class="text-danger text-center py-3">Gagal memuat data SIP</div>');
            }
        })
        .catch(error => {
            $container.empty();
            $container.append('<div class="text-danger text-center py-3">Terjadi kesalahan saat memuat data SIP</div>');
        });
}

function renderSIPList(sipDatas) {
    const $container = $('#sip-list-container');
    $container.empty();

    if (sipDatas.length === 0) {
        $container.append('<div class="text-muted text-center py-3">Tidak ada SIP yang tersedia</div>');
        return;
    }

    sipDatas.forEach((sip, index) => {
        const radioId = `sip-radio-${index}`;
        const $item = $(`
            <div class="offer-check border border-dark rounded p-3 mb-2 sip-item" style="cursor: pointer; transition: all 0.3s ease;">
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
            </div>
        `);

        // Tambahkan efek hover
        $item.hover(
            function () {
                $(this).addClass('bg-light');
                $(this).css('transform', 'translateY(-2px)');
                $(this).css('box-shadow', '0 4px 8px rgba(0,0,0,0.15)');
            },
            function () {
                $(this).removeClass('bg-light');
                $(this).css('transform', 'translateY(0)');
                $(this).css('box-shadow', 'none');
            }
        );

        $item.find('input[type="radio"]').on('change', function () {
            if ($(this).is(':checked')) {
                $('#no-sip').val(sip.sip_no);
                $('#tempat-praktik').val(sip.tempat_praktik);
                $('#lokasi-kejadian').val(sip.tempat_praktik); // Auto isi lokasi kejadian
                selectedSIPData = sip;
                $('#sipModal').modal('hide');
                fetchAndDisplayDocuments(sip.id);
            }
        });

        $container.append($item);
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
        $dokumenContainer.append('<div class="text-danger text-center py-3">Gagal memuat dokumen</div>');
        return;
    }

    const decrypted = await decryptData(result.data);
    documentsList = decrypted.datas || [];
    console.log('Dokumen yang tersedia:', documentsList);

    $dokumenContainer.empty();

    // Daftar dokumen: 1-4 wajib upload jika belum ada, 5 (Master Polis) hanya ditampilkan
    const requiredFileTypes = [
        { type: 1, label: 'Sertifikat' },
        { type: 2, label: 'KTP' },
        { type: 3, label: 'STR' },
        { type: 4, label: 'SIP' },
        { type: 5, label: 'Master Polis', optional: true } // ✅ Tambahkan Master Polis sebagai opsional
    ];

    const $row = $('<div class="row g-3"></div>');

    requiredFileTypes.forEach(({ type, label, optional = false }) => {
        const doc = documentsList.find(d => d.file_type === type);

        const $col = $('<div class="col-12 col-md-6"></div>');

        if (doc && doc.get_file) {
            const fileUrl = `${apiUrl}/${doc.get_file}`;
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
            if (optional) {
                // Untuk dokumen opsional (Master Polis), tampilkan "-" jika tidak ada
                const $card = $(`
                    <div class="border rounded p-3 h-100 d-flex flex-column justify-content-center bg-light">
                        <strong class="mb-2">${label}</strong>
                        <span class="text-muted">-</span>
                    </div>
                `);
                $col.append($card);
            } else {
                // Untuk dokumen wajib, tampilkan input upload
                const $uploadGroup = $(`
                    <div class="border rounded p-3 h-100 d-flex flex-column">
                        <label class="form-label mb-2">${label} <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="dokumen_upload_${type}" data-type="${type}" />
                    </div>
                `);
                $col.append($uploadGroup);
            }
        }

        $row.append($col);
    });

    $dokumenContainer.append($row);
}

async function submitKlaim() {
    try {
        // Validasi SIP
        if (!selectedSIPData) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih SIP terlebih dahulu'
            });
            return;
        }

        // Validasi Nama Pasien
        const namaPasien = $('#nama-pasien').val()?.trim();
        if (!namaPasien) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nama Pasien wajib diisi'
            });
            $('#nama-pasien').focus();
            return;
        }

        // Validasi Usia
        const usia = $('#usia-pasien').val()?.trim();
        if (!usia) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Usia wajib diisi'
            });
            $('#usia-pasien').focus();
            return;
        }

        // Validasi Jenis Kelamin
        const jenisKelamin = $('#jenis-kelamin-pasien').val();
        if (!jenisKelamin) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Jenis Kelamin wajib dipilih'
            });
            $('#jenis-kelamin-pasien').focus();
            return;
        }

        // Validasi Tanggal Kejadian
        const tanggalKejadian = $('#tanggal-kejadian').val()?.trim();
        if (!tanggalKejadian) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tanggal Kejadian wajib diisi'
            });
            $('#tanggal-kejadian').focus();
            return;
        }

        // Validasi Lokasi Kejadian
        const lokasiKejadian = $('#lokasi-kejadian').val()?.trim();
        if (!lokasiKejadian) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Lokasi Kejadian wajib diisi'
            });
            $('#lokasi-kejadian').focus();
            return;
        }

        // Validasi Jenis Tuntutan
        const jenisTuntutan = $('#jenis-tuntutan').val()?.trim();
        if (!jenisTuntutan) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Jenis Tuntutan wajib diisi'
            });
            $('#jenis-tuntutan').focus();
            return;
        }

        // Validasi Kronologis Kejadian
        const kronologisKejadian = $('#kronologis-kejadian').val()?.trim();
        if (!kronologisKejadian) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Kronologis Kejadian wajib diisi'
            });
            $('#kronologis-kejadian').focus();
            return;
        }

        // Parsing dan validasi tanggal
        const tanggalPengaduan = $('#tanggal-pengaduan').val();
        const pengaduanDate = parseDate(tanggalPengaduan);
        const kejadianDate = parseDate(tanggalKejadian);

        if (pengaduanDate < kejadianDate) {
            await Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tanggal Pengaduan tidak boleh kurang dari Tanggal Kejadian'
            });
            return;
        }

        // ✅ Validasi dokumen wajib (type 1-4) hanya jika belum ada di server
        const requiredTypes = [1, 2, 3, 4];
        for (let type of requiredTypes) {
            const docExists = documentsList.some(doc => doc.file_type === type);
            if (!docExists) {
                const inputFile = $(`input[name="dokumen_upload_${type}"]`)[0];
                if (!inputFile || !inputFile.files || inputFile.files.length === 0) {
                    const labelMap = { 1: 'Sertifikat', 2: 'KTP', 3: 'STR', 4: 'SIP' };
                    await Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: `File upload untuk "${labelMap[type]}" wajib diisi.`
                    });
                    return;
                }
            }
        }

        // Proses upload dokumen
        const uploadPromises = [];
        for (let type of [1, 2, 3, 4]) {
            const docExists = documentsList.some(doc => doc.file_type === type);
            if (!docExists) {
                const inputFile = $(`input[name="dokumen_upload_${type}"]`)[0];
                if (inputFile && inputFile.files.length > 0) {
                    const base64 = await fileToBase64(inputFile.files[0]);
                    uploadPromises.push({
                        file_type: type,
                        file_name: inputFile.files[0].name,
                        file_base64: base64
                    });
                }
            } else {
                // Dokumen sudah ada di server, kirim metadata saja
                const doc = documentsList.find(d => d.file_type === type);
                uploadPromises.push({
                    file_type: type,
                    file_name: doc.file_name,
                    file_path: doc.file_path,
                    file_base64: ''
                });
            }
        }

        // Buat payload
        const payload = {
            sipId: selectedSIPData.id,
            report_date: formatDateYmd(pengaduanDate),
            incident_date: formatDateYmd(kejadianDate),
            incident_location: lokasiKejadian,
            cause_of_action: jenisTuntutan,
            incident_description: kronologisKejadian,
            patient_name: namaPasien,
            patient_age: usia,
            patient_gender: jenisKelamin,
            // 👇 Ambil dari kontak WALI PASIEN (sesuai form)
            pic_name: $('#pasien-wali-nama').val()?.trim() || null,
            pic_relationship: $('#pasien-wali-hubungan').val()?.trim() || null,
            pic_no: $('#pasien-wali-no-hp').val()?.trim() || null,
            upload: uploadPromises
        };

        console.log('Payload yang akan dikirim:', payload);

        showGlobalLoading('Mengirim data klaim...');

        $.ajax({
            url: `${apiUrl}/api/client/klaim/register`,
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(payload),
            success: async function (result) {
                hideGlobalLoading();
                if (result.status === 200) {
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
            },
            error: function (xhr, status, error) {
                hideGlobalLoading();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengirim data: ' + (xhr.responseJSON?.message || error),
                });
            }
        });

    } catch (error) {
        hideGlobalLoading();
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
        reader.onload = () => resolve(reader.result.split(',')[1]); // Hanya base64 tanpa prefix
        reader.onerror = error => reject(error);
        reader.readAsDataURL(file);
    });
}
