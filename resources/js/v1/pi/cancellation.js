import { decryptData, encryptData } from "../encrypt.js";

$(document).ready(function() {
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

    // Function to calculate period text
    function getPeriodText(startDate, endDate) {
        if (!startDate || !endDate || startDate === '0000-00-00' || endDate === '0000-00-00') return '-';

        try {
            // Parse dates (assuming DD-MM-YYYY format)
            const startParts = startDate.split('-');
            const endParts = endDate.split('-');

            if (startParts.length !== 3 || endParts.length !== 3) return '-';

            const start = new Date(startParts[2], startParts[1] - 1, startParts[0]);
            const end = new Date(endParts[2], endParts[1] - 1, endParts[0]);

            if (isNaN(start.getTime()) || isNaN(end.getTime())) return '-';

            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            const years = Math.floor(diffDays / 365);
            const months = Math.floor((diffDays % 365) / 30);
            const days = diffDays % 30;

            let periodText = '';
            if (years > 0) periodText += `${years} tahun `;
            if (months > 0) periodText += `${months} bulan `;
            if (days > 0) periodText += `${days} hari`;

            return periodText.trim() || `${diffDays} hari`;
        } catch (error) {
            console.error('Error calculating period:', error);
            return '-';
        }
    }

    // Function to calculate remaining period text
    function getRemainingPeriodText(sisaHari) {
        if (sisaHari === undefined || sisaHari === null || sisaHari < 0) return '-';

        const years = Math.floor(sisaHari / 365);
        const months = Math.floor((sisaHari % 365) / 30);
        const days = sisaHari % 30;

        let periodText = '';
        if (years > 0) periodText += `${years} tahun `;
        if (months > 0) periodText += `${months} bulan `;
        if (days > 0) periodText += `${days} hari`;

        return periodText.trim() || `${sisaHari} hari`;
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
            },
            success: async function(responses) {
                var response = await decryptData(responses.data);

                console.log(response);

                if (response && response.detail && Array.isArray(response.detail) && response.detail.length > 0) {
                    const data = response.detail[0];

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
                        // Jika sudah ada data pembatalan, sembunyikan tombol submit
                        $('#submit-button').hide();

                        // Tampilkan pesan bahwa pembatalan sudah dilakukan
                        Swal.fire({
                            icon: 'info',
                            title: 'Pembatalan Sudah Dilakukan',
                            text: 'Polis ini sudah pernah dibatalkan sebelumnya.'
                        });
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
                console.error('Error loading cancellation data:', xhr, status, error);
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

                $.ajax({
                    url: `${apiUrl}/api/cancellation/submit`,
                    method: 'POST',
                    headers: {
                        "Authorization": `Bearer ${token}`,
                        "Content-Type": "application/json"
                    },
                    data: JSON.stringify({
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        reason: reason
                    }),
                    beforeSend: function() {
                        $('#submit-button').prop('disabled', true).text('Memproses...');
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Polis berhasil dibatalkan!'
                        });

                        // Show success view and hide form
                        $('#div-cancellation').hide();
                        $('#div-cancellation-success').show();

                        // Update additional success data if available
                        if (response.data) {
                            const data = response.data;
                            $('#nik-renewal').text(data.nik || '-');
                            $('#npwp-renewal').text(data.npwp || '-');
                        }

                        // Update download links if provided in response
                        if (response.download_links) {
                            if (response.download_links.certificate) {
                                $('#btn-download-sertifikat').attr('href', response.download_links.certificate).attr('target', '_blank');
                            }
                            if (response.download_links.nota) {
                                $('#btn-download-nota').attr('href', response.download_links.nota).attr('target', '_blank');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error submitting cancellation:', xhr, status, error);
                        let errorMessage = 'Gagal membatalkan polis. Silakan coba lagi.';

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

    // Load data when page loads
    loadCancellationData();
});
