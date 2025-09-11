document.addEventListener('DOMContentLoaded', function () {
    const table = $('#policy-history-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: `${apiUrl}/api/client/history`,
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + getAuthToken()
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'id' },
            { data: 'insurance' },
            { data: 'polis_no' },
            { data: 'polis_start_date' },
            { data: 'polis_end_date' },
            { data: 'plan_desc' },
            { data: 'sum_insured' },
            { data: 'premi' },
            { data: 'polis_stat' }
        ],
        language: {
            emptyTable: "Tidak ada data riwayat polis."
        }
    });
});

function getAuthToken() {
    const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
    if (cookie) {
        return cookie.split('=')[1];
    }
    return null;
}
