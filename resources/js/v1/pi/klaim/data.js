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
        order: [[3, 'desc']], // urutkan berdasarkan Tanggal Lapor desc
        columns: [
            {
                data: null,
                render: (data, type, row, meta) => meta.row + 1,
                className: 'text-center',
                orderable: false
            },
            { data: 'klaim_no', defaultContent: '-' },
            { data: 'ins_name', defaultContent: '-', className: 'text-wrap' },
            { data: 'tempat_praktik', defaultContent: '-' },
            { data: 'nama', defaultContent: '-' },
            {
                data: 'report_date',
                render: data => formatDateIndo(data),
                className: 'text-nowrap'
            },
            {
                data: 'accept_date',
                render: data => data ? formatDateIndo(data) : '-',
                className: 'text-nowrap'
            },
            { data: 'klaim_status_desc', defaultContent: '-', className: 'text-wrap' },
            {
                data: 'klaimId',
                orderable: false,
                className: 'text-center',
                render: data => `
                    <button class="btn btn-primary btn-icon btn-sm btn-detail" data-id="${data}">
                        <i class="ti ti-eye"></i>
                    </button>
                `
            }
        ]
    });

    // Pasang event handler tombol detail
    $('#table-klaim tbody').off('click', '.btn-detail').on('click', '.btn-detail', function() {
        const klaimId = $(this).data('id');
        if (klaimId) {
            window.location.href = `/klaim/detail/${klaimId}`;
        }
    });
}

function formatDateIndo(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    if (isNaN(date)) return '-';

    const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    const d = date.getDate();
    const m = months[date.getMonth()];
    const y = date.getFullYear();
    return `${d} ${m} ${y}`;
}
