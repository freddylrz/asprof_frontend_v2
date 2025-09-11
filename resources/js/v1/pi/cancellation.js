import { decryptData, encryptData } from "../encrypt.js";

$(document).ready(function() {
    // Global variable to store refund amount
    let refundAmount = '';

    // Function to format date
    function formatDate(dateString) {
        if (!dateString || dateString === '0000-00-00') return '-';
        // Assuming format is DD-MM-YYYY
        const parts = dateString.split('-');
        if (parts.length === 3) {
            return `${parts[0]}-${parts[1]}-${parts[2]}`;
        }
        return dateString;
    }

    // Function to format date from YYYY-MM-DD to DD-MM-YYYY
    function formatCancelDate(dateString) {
        if (!dateString || dateString === '0000-00-00') return '-';
        const parts = dateString.split('-');
        if (parts.length === 3) {
            return `${parts[2]}-${parts[1]}-${parts[0]}`;
        }
        return dateString;
    }

    // Fungsi untuk memformat tanggal dari format YYYY-MM-DD HH:mm:ss ke DD-MM-YYYY HH:mm:ss
    function formatDateTime(dateTimeString) {
        if (!dateTimeString || dateTimeString === '0000-00-00 00:00:00') return '-';
        const date = new Date(dateTimeString);
        if (isNaN(date.getTime())) return '-';

        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
    }

    // Function to get status text based on cancellation_status_id
    function getCancellationStatusText(statusId, eventName) {
        switch(statusId) {
            case 1:
                return 'Proses Verifikasi TIB';
            case 2:
                return 'Ditolak - ' + (eventName || 'Pembatalan ditolak');
            case 3:
                return 'Diterima - ' + (eventName || 'Pembatalan diterima');
            default:
                return eventName || 'Status tidak diketahui';
        }
    }

    // Fungsi untuk menampilkan log
    function showLogModal(logData) {
        const logTableBody = $('#log-table-body');
        const noLogMessage = $('#no-log-message');

        logTableBody.empty();

        if (logData && Array.isArray(logData) && logData.length > 0) {
            logTableBody.show();
            noLogMessage.hide();

            logData.forEach(log => {
                const row = `
                    <tr>
                        <td>${formatDateTime(log.created_at)}</td>
                        <td>${log.event_name || '-'}</td>
                        <td>${log.description || '-'}</td>
                    </tr>
                `;
                logTableBody.append(row);
            });
        } else {
            logTableBody.hide();
            noLogMessage.show();
        }

        $('#logModal').modal('show');
    }

    // Event listener untuk tombol log di view utama
    $('#log-button').click(function() {
        loadAndShowLog();
    });

    // Event listener untuk tombol log di success view
    $('#log-button-success').click(function() {
        loadAndShowLog();
    });

    // Fungsi untuk memuat dan menampilkan log
    function loadAndShowLog() {
        // Get the token from the 'piat' cookie
        const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

        $.ajax({
            url: `${apiUrl}/api/client/cancellation/get-data`,
            method: 'GET',
            headers: {
                "Authorization": `Bearer ${token}`
            },
            success: async function(responses) {
                var response = await decryptData(responses.data);

                if (response && response.log && Array.isArray(response.log)) {
                    showLogModal(response.log);
                } else {
                    showLogModal([]); // Tampilkan pesan tidak ada log
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading log ', xhr, status, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data log. Silakan coba lagi.'
                });
            }
        });
    }

    // Load cancellation data
    function loadCancellationData() {
        // Get the token from the 'piat' cookie
        const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

        $.ajax({
            url: `${apiUrl}/api/client/cancellation/get-data`,
            method: 'GET',
            headers: {
                "Authorization": `Bearer ${token}`
            },
            beforeSend: function() {
                $('#submit-button').hide();
                $('#log-card').hide();
                $('#log-card-success').hide();
            },
            success: async function(responses) {
                var response = await decryptData(responses.data);

                console.log(response);

                if (response && response.detail && Array.isArray(response.detail) && response.detail.length > 0) {
                    const data = response.detail[0];

                    // Store refund amount for later use
                    refundAmount = data.nilai_refund || '';

                    // Update cancellation form data
                    $('#nomor-register').text(data.reqId || '-');
                    $('#nama-pemilik').text(data.debitur || '-');
                    $('#asuransi').text(data.insurance || '-');
                    $('#nomor-polis').text(data.polis_no || '-');
                    $('#periode-polis').text(`${formatDate(data.polis_start_date)} - ${formatDate(data.polis_end_date)}`);
                    $('#premi').text(data.premi || '-');
                    $('#hari-info').text(`${data.sisa_hari || '-'} hari / ${data.total_hari || '-'} hari`);

                    // Update success view data
                    $('#nomor-register-sukses').text(data.reqId || '-');
                    $('#nama-renewal').text(data.debitur || '-');
                    $('#nomor-polis-renewal').text(data.polis_no || '-');
                    $('#periode-polis-renewal').text(`${formatDate(data.polis_start_date)} - ${formatDate(data.polis_end_date)}`);
                    $('#premi-renewal').text(data.premi || '-');

                    // Cek apakah sudah ada data pembatalan
                    if (response.cancel_data && Array.isArray(response.cancel_data) && response.cancel_data.length > 0) {
                        const cancelData = response.cancel_data[0];
                        const statusId = cancelData.cancellation_status_id;

                        // Tampilkan card log jika ada cancel_data
                        $('#log-card').show();
                        $('#log-card-success').show();

                        // Tampilkan data pembatalan di success view
                        $('#cancellation-date').text(formatCancelDate(cancelData.cancellation_date) || '-');
                        $('#cancellation-reason').text(cancelData.reason || '-');
                        $('#cancellation-status-badge').text(getCancellationStatusText(statusId, cancelData.event_name));

                        // Logika berdasarkan status
                        if (statusId == 1) {
                            // Masih dalam proses request pembatalan
                            $('#cancellation-status-badge').removeClass('bg-success bg-danger').addClass('bg-warning');
                            $('#div-polis-alert-success').removeClass('alert-success').addClass('alert-warning');
                            $('#polis-alert-success').text('Permintaan pembatalan polis Anda sedang dalam proses verifikasi. Silakan tunggu konfirmasi lebih lanjut.');
                        } else if (statusId == 2) {
                            // Pembatalan ditolak
                            $('#cancellation-status-badge').removeClass('bg-success bg-warning').addClass('bg-danger');
                            $('#div-polis-alert-success').removeClass('alert-success').addClass('alert-danger');
                            $('#polis-alert-success').text('Maaf, permintaan pembatalan polis Anda telah ditolak.');
                        } else if (statusId == 3) {
                            // Pembatalan diterima
                            $('#cancellation-status-badge').removeClass('bg-warning bg-danger').addClass('bg-success');
                            $('#div-polis-alert-success').removeClass('alert-warning alert-danger').addClass('alert-success');
                            $('#polis-alert-success').text('Polis Anda telah berhasil dibatalkan. Silakan unduh e-sertifikat dan nota Anda di bawah ini.');
                        }

                        // Tampilkan success view
                        $('#div-cancellation').hide();
                        $('#div-cancellation-success').show();
                    } else {
                        // Jika belum ada data pembatalan, tampilkan tombol submit
                        $('#submit-button').show();
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Data tidak ditemukan',
                        text: 'Data pembatalan tidak ditemukan untuk request ini.'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading cancellation ', xhr, status, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal memuat data pembatalan. Silakan coba lagi.'
                });
            }
        });
    }

    // Tombol submit diklik - tampilkan modal
    $('#submit-button').click(function() {
        $('#reason-text').val(''); // Clear textarea
        $('#reasonModal').modal('show');
    });

    // Konfirmasi submit dari modal
    $('#confirm-submit').click(function() {
        const reason = $('#reason-text').val().trim();

        if (!reason) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Silakan masukkan alasan pembatalan.'
            });
            return;
        }

        $('#reasonModal').modal('hide');

        Swal.fire({
            title: 'Konfirmasi Pembatalan',
            text: 'Apakah Anda yakin ingin membatalkan polis ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the token from the 'piat' cookie
                const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

                // Prepare data for submission
                const submitData = {
                    reason: reason,
                    refund_amt: refundAmount
                };

                $.ajax({
                    url: `${apiUrl}/api/client/cancellation/request`,
                    method: 'POST',
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Content-Type": "application/json"
                    },
                    data: JSON.stringify(submitData),
                    beforeSend: function() {
                        $('#submit-button').prop('disabled', true).text('Memproses...');
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Permintaan pembatalan polis berhasil diajukan!'
                        });

                        // Load updated data and show success view
                        loadCancellationDataAfterSubmit();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error submitting cancellation:', xhr, status, error);
                        let errorMessage = 'Gagal mengajukan pembatalan polis. Silakan coba lagi.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        });
                        $('#submit-button').prop('disabled', false).text('Submit');
                    }
                });
            }
        });
    });

    // Load cancellation data after submit to get updated cancel_data
    function loadCancellationDataAfterSubmit() {
        // Get the token from the 'piat' cookie
        const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

        $.ajax({
            url: `${apiUrl}/api/client/cancellation/get-data`,
            method: 'GET',
            headers: {
                "Authorization": `Bearer ${token}`
            },
            success: async function(responses) {
                var response = await decryptData(responses.data);

                console.log('Updated data after submit:', response);

                if (response && response.detail && Array.isArray(response.detail) && response.detail.length > 0) {
                    const data = response.detail[0];

                    // Update success view data
                    $('#nomor-register-sukses').text(data.reqId || '-');
                    $('#nama-renewal').text(data.debitur || '-');
                    $('#nomor-polis-renewal').text(data.polis_no || '-');
                    $('#periode-polis-renewal').text(`${formatDate(data.polis_start_date)} - ${formatDate(data.polis_end_date)}`);
                    $('#premi-renewal').text(data.premi || '-');

                    // Update cancel_data information if available
                    if (response.cancel_data && Array.isArray(response.cancel_data) && response.cancel_data.length > 0) {
                        const cancelData = response.cancel_data[0];
                        const statusId = cancelData.cancellation_status_id;

                        // Tampilkan card log
                        $('#log-card').show();
                        $('#log-card-success').show();

                        $('#cancellation-date').text(formatCancelDate(cancelData.cancellation_date) || '-');
                        $('#cancellation-reason').text(cancelData.reason || '-');
                        $('#cancellation-status-badge').text(getCancellationStatusText(statusId, cancelData.event_name));

                        // Logika berdasarkan status
                        if (statusId == 1) {
                            // Masih dalam proses request pembatalan
                            $('#cancellation-status-badge').removeClass('bg-success bg-danger').addClass('bg-warning');
                            $('#div-polis-alert-success').removeClass('alert-success').addClass('alert-warning');
                            $('#polis-alert-success').text('Permintaan pembatalan polis Anda sedang dalam proses verifikasi. Silakan tunggu konfirmasi lebih lanjut.');
                        } else if (statusId == 2) {
                            // Pembatalan ditolak
                            $('#cancellation-status-badge').removeClass('bg-success bg-warning').addClass('bg-danger');
                            $('#div-polis-alert-success').removeClass('alert-success').addClass('alert-danger');
                            $('#polis-alert-success').text('Maaf, permintaan pembatalan polis Anda telah ditolak.');
                        } else if (statusId == 3) {
                            // Pembatalan diterima
                            $('#cancellation-status-badge').removeClass('bg-warning bg-danger').addClass('bg-success');
                            $('#div-polis-alert-success').removeClass('alert-warning alert-danger').addClass('alert-success');
                            $('#polis-alert-success').text('Polis Anda telah berhasil dibatalkan. Silakan unduh e-sertifikat dan nota Anda di bawah ini.');
                        }
                    }

                    // Show success view and hide form
                    $('#div-cancellation').hide();
                    $('#div-cancellation-success').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading updated cancellation ', xhr, status, error);
                // Still show success view even if we can't load updated data
                $('#div-cancellation').hide();
                $('#div-cancellation-success').show();
            }
        });
    }

    // Load data when page loads
    loadCancellationData();
});
