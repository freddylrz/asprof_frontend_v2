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
    } catch (error) {
        // Jika error, hapus spinner dan tampilkan alert
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
    $container.empty(); // kosongkan loading spinner

    if (sipDatas.length === 0) {
        $container.append('<div class="text-muted text-center py-3">Data SIP tidak tersedia.</div>');
        return;
    }

    sipDatas.forEach(sip => {
        const radioId = `sip-radio-${sip.id}`;
        const radioHtml = `
        <div class="offer-check border border-dark rounded p-3">
            <div class="form-check">
                <input type="radio" name="radio1" class="form-check-input input-primary" id="${radioId}" />
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
