import { decryptData } from "../../encrypt.js";

// Ambil token dari cookie dengan aman
const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
const token = cookie ? cookie.split('=')[1] : null;

let dataTable;

$(document).ready(async function() {
    try {
        const klaimList = await fetchKlaimList();
        initializeDataTable(klaimList);
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal Memuat Data Klaim',
            text: error.message || 'Terjadi kesalahan saat memuat data klaim.',
        });
    }
});

async function fetchKlaimList() {
    const response = await fetch(`${apiUrl}/api/client/klaim/list`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    });
    const result = await response.json();
    if (result.status === 200) {
        const decrypted = await decryptData(result.data);
        console.log(decrypted);
        return decrypted.list || [];
    } else {
        throw new Error(result.message || 'Gagal mendapatkan data klaim dari server.');
    }
}

function initializeDataTable(klaimList) {
    if ($.fn.DataTable.isDataTable('#table-klaim')) {
        $('#table-klaim').DataTable().clear().destroy();
    }

    dataTable = $('#table-klaim').DataTable({
        data: klaimList,
        responsive: true,
        ordering: true,
        order: [[6, 'desc']], // urutkan berdasarkan Tanggal Pengaduan (kolom ke-7, index 6) desc
        columns: [
            { data: 'klaim_no', defaultContent: '-' },
            { data: 'ins_name', defaultContent: '-', className: 'text-wrap' },
            { data: 'polis_no', defaultContent: '-' },
            { data: 'nama', defaultContent: '-' },
            { data: 'tempat_praktik', defaultContent: '-' },
            {
                data: 'incident_date',
                className: 'text-nowrap'
            },
            {
                data: 'report_date',
                className: 'text-nowrap'
            },
            {
                data: null, // render custom dari row
                orderable: false,
                className: 'text-center',
                render: (data, type, row) => {
                    let btnClass = 'btn-secondary';
                    // Warna berdasarkan klaim_status_id
                    switch (row.klaim_status_id) {
                        case 1: // Pengaduan masuk
                            btnClass = 'btn-warning';
                            break;
                        case 2: // Diproses
                            btnClass = 'btn-info';
                            break;
                        case 3: // Disetujui
                        case 4: // Selesai
                            btnClass = 'btn-success';
                            break;
                        case 5: // Ditolak
                            btnClass = 'btn-danger';
                            break;
                        default:
                            btnClass = 'btn-secondary';
                    }

                    return `
                        <button class="btn btn-sm ${btnClass} btn-status"
                                style="min-width: 120px; white-space: nowrap;"
                                data-id="${row.klaimId}">
                            ${row.klaim_status_desc || '-'}
                        </button>
                    `;
                }
            }
        ]
    });

    // Pasang event handler tombol status
    $('#table-klaim tbody').off('click', '.btn-status').on('click', '.btn-status', function() {
        const klaimId = $(this).data('id');
        if (klaimId) {
            window.location.href = `/klaim/detail/${klaimId}`;
        }
    });
}
