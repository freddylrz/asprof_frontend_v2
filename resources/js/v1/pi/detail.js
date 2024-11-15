import { decryptData, encryptData } from "../encrypt.js";

const tempatPraktikDetails = {}; // Initialize tempatPraktikDetails object
var registerId;
let paymentStatusInterval; // Variable to store the interval ID

$(document).ready(function() {
    // Get reqId from the global variable
    var reqId = window.reqId;
    // Get the current URL of the page
    const urlString = window.location.href;
    // Create a URL object
    const url = new URL(urlString);
    // Get the value of the status_tib parameter
    const statusTib = url.searchParams.get('status_tib');

    var paymentModal = $('#paymentModal');

    // Initialize the modal with static backdrop and keyboard false
    var modal = new bootstrap.Modal(paymentModal.get(0), {
        backdrop: 'static',
        keyboard: false
    });

    // Add event listener for the close button
    $('#closePaymentModal').on('click', function() {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Anda akan menutup halaman pembayaran",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, tutup!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                modal.hide();
                $('#footer-main').show();
                $('#footer-payment').hide();
                hideAllPaymentOutputs(); // Hide all payment outputs
                switchTab('#main');
            }
        });
    });

    // Function to handle konfirmasi-pembayaran button click
    $('#konfirmasi-pembayaran').on('click', function() {
        var selectedPaymentMethod = $('input[name="pembayaran"]:checked').data('group');
        var selectedPaymentId = $('input[name="pembayaran"]:checked').data('id');
        var selectedPaymentLogo = $('input[name="pembayaran"]:checked').data('logo');
        const bayarButton = $(this);
        bayarButton.data('original-text', bayarButton.html());
        setLoading(bayarButton, true);

        if (!selectedPaymentMethod) {
            Swal.fire({
                text: 'Silakan pilih metode pembayaran sebelum melanjutkan.',
                icon: 'warning',
                showConfirmButton: true
            });

            setLoading(bayarButton, false);
        } else {
            if (selectedPaymentMethod != 3) {
                handleRequestPayment(reqId, selectedPaymentId, selectedPaymentLogo).done(function(response) {
                    $('#footer-main').hide();
                    $('#footer-payment').show();
                    $.each(response['info'], function(j, paymentInfo) {
                        switchTab(`#payment-${selectedPaymentMethod}`);
                        // Hide all payment outputs before showing the selected one
                        hideAllPaymentOutputs();

                        // Handle different payment method outputs
                        switch (selectedPaymentId) {
                            case 1: // Permata Virtual Account
                            case 2: // BCA Virtual Account
                            case 4: // BNI Virtual Account
                            case 5: // BRI Virtual Account
                            case 6: // CIMB Virtual Account
                                $('#va-logo').attr('src', paymentInfo.payment_logo);
                                $('#va-number').text(paymentInfo.va_number); // Example VA number
                                $('#hidden-va-number').val(paymentInfo.va_number);
                                $('#va-payment-status').text(paymentInfo.status_description);
                                $('#va-expiry-time').text(paymentInfo.expiry_time_desc);
                                $('#va-transaction-time').text(paymentInfo.transaction_time);
                                makeCountdown(paymentInfo.expiry_time, 'countdown-payment-bt');
                                $('#va-output').show();
                                break;
                            case 3: // Mandiri Bill Payment
                                $('#bill-logo').attr('src', paymentInfo.payment_logo);
                                $('#company-biller').text(paymentInfo.description);
                                $('#key-bill').text(paymentInfo.bill_key);
                                $('#hidden-key-bill').val(paymentInfo.bill_key);
                                $('#code-bill').text(paymentInfo.biller_code);
                                $('#hidden-code-bill').val(paymentInfo.biller_code);
                                $('#bill-payment-status').text(paymentInfo.status_description);
                                $('#bill-expiry-time').text(paymentInfo.expiry_time_desc);
                                $('#bill-transaction-time').text(paymentInfo.transaction_time);
                                makeCountdown(paymentInfo.expiry_time, 'countdown-payment-bt');
                                $('#bill-payment-output').show();
                                break;
                            case 7: // QRIS (OVO, DANA, LINK AJA)
                                $('#qr-logo').attr('src', paymentInfo.payment_logo);
                                $('#qr-code').attr('src', paymentInfo.qr_code); // Example QR code
                                $('#qr-payment-status').text(paymentInfo.status_description);
                                $('#qr-expiry-time').text(paymentInfo.expiry_time_desc);
                                $('#qr-transaction-time').text(paymentInfo.transaction_time);
                                makeCountdown(paymentInfo.expiry_time, 'countdown-payment-ew');
                                $('#qr-output').show();
                                break;
                            case 8: // GO-PAY
                                $('#gopay-logo').attr('src', paymentInfo.payment_logo);
                                $('#gopay-qr-code').attr('src', paymentInfo.qr_code); // Example QR code
                                $('#gopay-redirect').attr('href', paymentInfo.deeplink); // Example redirect URL
                                $('#gopay-payment-status').text(paymentInfo.status_description);
                                $('#gopay-expiry-time').text(paymentInfo.expiry_time_desc);
                                $('#gopay-transaction-time').text(paymentInfo.transaction_time);
                                makeCountdown(paymentInfo.expiry_time, 'countdown-payment-ew');
                                $('#gopay-output').show();
                                break;
                            case 9: // SHOPEE-PAY
                                $('#shopeepay-logo').attr('src', paymentInfo.payment_logo);
                                $('#shopeepay-redirect').attr('href', paymentInfo.deeplink); // Example redirect URL
                                $('#shopeepay-payment-status').text(paymentInfo.status_description);
                                $('#shopeepay-expiry-time').text(paymentInfo.expiry_time_desc);
                                $('#shopeepay-transaction-time').text(paymentInfo.transaction_time);
                                makeCountdown(paymentInfo.expiry_time, 'countdown-payment-ew');
                                $('#shopeepay-output').show();
                                setTimeout(function() {
                                    window.open(
                                        paymentInfo.deeplink,
                                        '_blank' // <- This is what makes it open in a new window.
                                      );
                                }, 2000);
                                break;
                            default:
                                console.log('Unknown payment method');
                        }
                    })

                    setLoading(bayarButton, false);

                    // Call getPaymentStatus every 5 seconds
                    // paymentStatusInterval = setInterval(function() {
                    //     getPaymentStatus(reqId);
                    // }, 5000);
                });
            } else {
                $('#footer-main').hide();
                switchTab(`#payment-3`);
                $('#cc-dc-form').show();
                setLoading(bayarButton, false);
            }
        }
    });

    // Function to handle ccdcForm submit
    $('#ccdcForm').on('submit', function(e) {
        e.preventDefault();
        handleRequestPayment(reqId, 10).done(function(response) {
            $.each(response['info'], function(j, paymentInfo) {
                switchTab(`#payment-4`);
                setTimeout(function() {
                    window.open(
                        paymentInfo.deeplink,
                        '_blank' // <- This is what makes it open in a new window.
                    );
                }, 3000);
            })
        });
    });

    // Function to handle cek-status-bayar button click
    $('#cek-status-bayar').on('click', function() {
        const cekStatusButton = $(this);
        cekStatusButton.data('original-text', cekStatusButton.html());
        setLoading(cekStatusButton, true);

        getPaymentStatus(reqId)
    });

    // Function to handle back to main tab button click
    $('.back-to-main').on('click', function() {
        $('#footer-main').show();
        $('#footer-payment').hide();
        hideAllPaymentOutputs(); // Hide all payment outputs
        switchTab('#main');
    });

    // Attach the copy functionality to the copy button
    $(".copyVirtualAccount").on('click', function() {
        var hiddenInput = $(this).closest('.media').find('input[type="text"]');
        copyToClipboard(hiddenInput[0]);
    });

    $(".enambelas").inputmask({
        mask: "9999 9999 9999 9999",
        placeholder: ""
    });

    $(".tiga").inputmask({
        mask: "999",
        placeholder: ""
    });

    $(".dua").inputmask({
        mask: "99",
        placeholder: ""
    });

    // Check if statusTib is not null or undefined
    if (statusTib === 1) {
        handleDeletePayment(reqId);
    }

    // Check if reqId is not null or undefined
    if (reqId !== null && reqId !== undefined) {
        getDataDetail(reqId)
    } else {
        window.location.href = '/pendaftaran';
    }

    $('#btn_nota').on('click', function() {
        invoice(reqId)
    })

    // Handle paid-now button click
    $('#paid-now').on('click', function() {
        // handlePayment(reqId)
        getPaymentStatus(reqId)
        getPaymentMethod()
    })

    // Event listener for "View Detail" button
    $('#list-sip').on('click', '.view-detail', function() {
        const id = $(this).data('id');
        const detail = tempatPraktikDetails[id];

        $('#detailNomorSIP').text(detail.nomorSIP);
        $('#detailPeriodeAwalSIP').text(detail.periodeAwalSIP);
        $('#detailPeriodeAkhirSIP').text(detail.periodeAkhirSIP);
        $('#detailDaerahPenerbitSIP').text(detail.daerahPenerbitSIP);
        if(detail.daerahPenerbitSIP_id === "0"){
            $('#div-nama-penerbit').show()
            $('#namaPenerbitSIP').text(detail.namaPenerbitSIP);
        } else {
            $('#div-nama-penerbit').hide()
            $('#namaPenerbitSIP').text(detail.namaPenerbitSIP);
        }
        $('#detailTempatPraktik').text(detail.tempat);
        $('#file_sip').attr('href', detail.unggahSIP ? detail.unggahSIP : '#'); // Set the SIP link

        $('#viewDetailModal').modal('show');
    });

});

function countdownSuccessPayment() {
    var countdownElement = $('#countdown-success-payment');
    var countdownValue = parseInt(countdownElement.text());

    if (countdownValue > 0) {
        countdownValue--;
        countdownElement.text(countdownValue);
    } else {
        location.reload();
    }
}

// Function to toggle loading state on a button
function setLoading(button, isLoading) {
    if (isLoading) {
        button.html('<i class="spinner-border spinner-border-sm"></i> Loading...');
        button.prop('disabled', true);
    } else {
        button.html(button.data('original-text'));
        button.prop('disabled', false);
    }
}

// Function to copy the value from the hidden input to the clipboard
function copyToClipboard(element) {
    element.select();
    element.setSelectionRange(0, 99999); // For mobile devices
    document.execCommand("copy");
    Swal.fire({
        text: 'Nomor Virtual Account telah disalin.',
        icon: 'success',
        showConfirmButton: false,
        timer: 1000,
    });
}

function makeCountdown(expiryTime, countdownElementId) {
    const countdownElement = document.getElementById(countdownElementId);
    const expiryDate = new Date(expiryTime).getTime();

    const updateCountdown = setInterval(() => {
        const now = new Date().getTime();
        const timeLeft = expiryDate - now;

        if (timeLeft <= 0) {
            clearInterval(updateCountdown);
            countdownElement.textContent = "00:00:00";
            // Optionally, handle the expired state (e.g., disable payment options, notify user)
            alert("Waktu pembayaran telah habis. Silakan coba lagi.");
            switchTab('#main');
            return;
        }

        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        countdownElement.textContent = formattedTime;
    }, 1000);
}

// Function to hide all payment output elements
function hideAllPaymentOutputs() {
    $('#va-output').hide();
    $('#bill-payment-output').hide();
    $('#qr-output').hide();
    $('#gopay-output').hide();
    $('#shopeepay-output').hide();
    $('#cc-dc-form').hide();
}

// Function to switch tabs
function switchTab(tabId) {
    const tabTrigger = $(`a[href="${tabId}"]`);
    $('#payment-active-slide').html(tabTrigger.data('slide-index'));
    const tab = new bootstrap.Tab(tabTrigger[0]);
    tab.show();
}

function getDataDetail(reqId) {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        "url": `${apiUrl}/api/client/request/detail?reqId=${reqId}`,
        "method": "GET",
        "timeout": 0,
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        var statusId;
        $.each(response['data'], function(j, item) {
            registerId = item.register_no;
            statusId = item.status_id;
            $('#nomor-register').html(item.register_no)
            $('#nama').html(item.nama)
            $('#nik').html(item.nik)
            $('#ttl').html(item.tempat_lahir + ', ' + item.tanggal_lahir)
            $('#email').html(item.email)
            $('#jenis-kelamin').html(item.jenis_kelamin_desc)
            $('#nomor-handphone').html(item.no_hp)
            $('#npwp').html(item.npwp)
            $('#alamat').html(item.alamat)
            if(item.kontak_darurat == null) {
                $('#div-kontak-darurat').hide()
            }
            $('#kontak-darurat').html(item.kontak_darurat ? item.kontak_darurat : '-')
            $('#nomor-darurat').html(item.nomor_darurat ? item.nomor_darurat : '-')
            if (item.profesi_id == 1) {
                $('#div-tenaga-medis').removeClass('d-none')
            } else {
                $('#div-tenaga-kesehatan').removeClass('d-none')
            }
            $('#ketegori-profesi').html(item.profesi_kategori_desc)
            $('#nomor-str').html(item.str_no)
            if (item.str_stat == "1") {
                $('#status-str').html('Seumur Hidup')
                $('#label-str').html('Periode Awal STR')
                $('#periode-str').html(item.str_date_start)
            } else {
                $('#status-str').html('Belum Seumur Hidup')
                $('#label-str').html('Masa Berakhir STR')
                $('#periode-str').html(item.str_date_end)
            }
            $('#plan').html(item.plan_desc)
            $('#premi-tahunan').html(item.premi)
            $('#jaminan-pertanggungan').html(item.sum_insured)
            $('#plan-pembayaran').html(item.plan_desc)
            $('#biaya-polis').html(item.biaya_polis)
            $('#biaya-materai').html(item.biaya_materai)
            $('#premi-tahunan-pembayaran').html(item.premi)
            $('#total-tagihan').html(item.total_premi)
            $('#div-asuransi').html(`
                <div class="form-group">
                    <label class="form-label">Asuransi pilihan:</label>
                    <img class="img-fluid hei-150 d-block mx-auto" src="${item.ins_logo}" alt="Card image" style="object-fit: contain;">
                    <p class="h5 text-center">Asuransi ${item.ins_nama}</p>
                </div>
            `)
        })

        const getStatusesByStatusId = (statusId) => {
            switch (statusId) {
                case 1:
                case 3:
                    return [{
                            id: '#status-poin-satu',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-dua',
                            class: 'bg-light-warning border border-warning',
                            text: 'Dalam Proses'
                        },
                        {
                            id: '#status-poin-tiga',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#status-poin-empat',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#status-poin-lima',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#poin-satu',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-dua',
                            class: 'js-proses'
                        },
                    ];
                case 4:
                    return [{
                            id: '#status-poin-satu',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-dua',
                            class: 'bg-light-warning border border-warning',
                            text: 'Dalam Proses'
                        },
                        {
                            id: '#status-poin-tiga',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#status-poin-empat',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#status-poin-lima',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#poin-satu',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-dua',
                            class: 'js-proses'
                        },
                    ];
                case 5:
                    return [{
                            id: '#status-poin-satu',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-dua',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-tiga',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-empat',
                            class: 'bg-light-warning border border-warning',
                            text: 'Dalam Proses'
                        },
                        {
                            id: '#status-poin-lima',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#poin-satu',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-dua',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-tiga',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-empat',
                            class: 'js-proses'
                        }
                    ];
                case 6:
                    return [{
                            id: '#status-poin-satu',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-dua',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-tiga',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-empat',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-lima',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#poin-satu',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-dua',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-tiga',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-empat',
                            class: 'js-active'
                        }
                    ];
                default:
                    return [{
                            id: '#status-poin-satu',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-dua',
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
                        },
                        {
                            id: '#status-poin-tiga',
                            class: 'bg-light-warning border border-warning',
                            text: 'Dalam Proses'
                        },
                        {
                            id: '#status-poin-empat',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#status-poin-lima',
                            class: 'bg-light-danger border border-danger',
                            text: 'Belum Mulai'
                        },
                        {
                            id: '#poin-satu',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-dua',
                            class: 'js-active'
                        },
                        {
                            id: '#poin-tiga',
                            class: 'js-proses'
                        }
                    ];
            }
        };

        const statuses = getStatusesByStatusId(statusId);

        statuses.forEach(status => {
            $(status.id).addClass(status.class).text(status.text);
        });

        // Initial button settings based on status_id
        if (statusId === 5 || statusId === 6) {
            $('#btn_info').show();
            $('#btn_nota').show();
        } else {
            $('#btn_info').hide();
            $('#btn_nota').hide();
        }

        if (statusId === 3) {
            $('#btn_edit').show();
            $('#div-revision-alert').show();
        } else {
            $('#btn_edit').hide();
            $('#div-revision-alert').hide();
        }

        if (statusId === 2) {
            // Call getPaymentStatus immediately
            getPaymentStatus(reqId);

            // Set up interval to call getPaymentStatus every 5 seconds
            paymentStatusInterval = setInterval(function() {
                getPaymentStatus(reqId);
            }, 5000);
            $('#payment-footer').removeClass('d-none');
            $('#container-detail').css('margin-bottom', '10rem');
        }

        $('#revision-alert').html(`Catatan: ${response.revision}`)

        populateTempatPraktikDetails(response)

        $('#list-log').html('')
        $.each(response['log'], function(j, item) {
            $('#list-log').append(`
                    <li key="${j+1}">
                    <i class="feather icon-check f-w-600 task-icon bg-success"></i>
                    <p class="m-b-5">${item.created_at}</p>
                    <p class="text-muted m-b-5 h3">${item.status_desc}</p>
                    <p class="m-b-5 h6">${item.description}</p>
                    </li>
                    `)
        })

        $.each(response['document'], function(j, item) {
            if (item.file_type == 1) {
                $('#file_ktp').attr('href', item.link)
                $('#file_ktp').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> KTP</span> ')
            } else if (item.file_type == 2) {
                $('#file_str').attr('href', item.link)
                $('#file_str').html('<i class="ti ti-file"></i> <span class=""> STR</span> ')
            } else {
                $('#file_sip').attr('href', item.link)
                $('#file_sip').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> SIP</span> ')
            }
        })

        $.each(response['paid'], function(j, item) {
            $('#divPay').html(
                ` <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">No Kwitansi</label>
                        <p>${item.no_kwitansi}</p>
                    </div>
                        <div class="form-group">
                        <label for="">Tanggal Kwitansi</label>
                        <p>${item.kwitansi_date}</p>
                    </div>
                        <div class="form-group">
                        <label for="">Jumlah Bayar</label>
                        <p>${(item.kwitansi_amt === null? '-' : item.kwitansi_amt)}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Pembayaran</label>
                        <p>${item.paid_date}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Dibayar</label>
                        <p>${item.paid_amt}</p>
                    </div>
                </div>
            </div>
            `
            )
        })

        Swal.close()

        return statusId;
    }).fail(function(error) {
        let data;
        try {
            // Attempt to parse the error response as JSON
            data = JSON.parse(error.responseText);
        } catch (e) {
            // If parsing fails, use a default error message
            data = {
                message: 'An unexpected error occurred'
            };
        }

        // Ensure data.message exists
        const message = data.message || 'An unexpected error occurred';

        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                return window.location.href = '/pendaftaran';
            }
        });
    });
}

// Function to dynamically populate tempatPraktikDetails from response
function populateTempatPraktikDetails(response) {
    response.praktik.forEach((item) => {
        const id = item.id; // Use the item id as the key
        const sipDocument = response.document.find(doc => doc.tempat_praktik_id === id && doc.file_type === 3);
        const sipURL = sipDocument ? sipDocument.link : '';

        tempatPraktikDetails[id] = {
            nomorSIP: item.sip_no,
            periodeAwalSIP: item.sip_date_start,
            periodeAkhirSIP: item.sip_date_end,
            daerahPenerbitSIP: item.sip_penerbit,
            namaPenerbitSIP: item.sip_penerbit_desc,
            tempat: item.tempat_praktik,
            unggahSIP: sipURL
        };
    });
    renderList();
}

// Function to render table based on tempatPraktikDetails
function renderTable() {
    const $tbody = $('#tbody-daerah-praktik');
    $tbody.empty();
    let counter = 1;
    for (const id in tempatPraktikDetails) {
        if (tempatPraktikDetails.hasOwnProperty(id)) {
            const detail = tempatPraktikDetails[id];
            const row = `
                <tr data-id="${id}">
                    <td>${counter}</td>
                    <td>${detail.nomorSIP}</td>
                    <td>${detail.periodeAwalSIP}</td>
                    <td>${detail.periodeAkhirSIP}</td>
                    <td>${detail.daerahPenerbitSIP}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm view-detail" data-id="${id}"><i class="fa fa-eye"></i></button>
                    </td>
                </tr>
            `;
            $tbody.append(row);
            counter++;
        }
    }
}

// Function to render list based on tempatPraktikDetails
function renderList() {
    const listSIP = $('#list-sip');
    listSIP.empty();
    let counter = 1;
    for (const id in tempatPraktikDetails) {
        if (tempatPraktikDetails.hasOwnProperty(id)) {
            const detail = tempatPraktikDetails[id];
            const row = `
                <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0" data-id="${id}">
                    <b>No SIP: ${detail.nomorSIP}</b>
                    <button type="button" class="btn btn-info btn-sm view-detail" data-id="${id}"><i class="fa fa-eye"></i></button>
                </li>
            `;
            listSIP.append(row);
            counter++;
        }
    }
}

function polis(reqId) {
    Swal.fire({
        icon: 'info',
        text: "Loading!",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var url = `${apiUrl}/api/generate/polis?reqId=${reqId}`;

    var requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow',
        mimeType: "multipart/form-data",
    };

    fetch(url, requestOptions)
        .then(response => {
            var contentDisposition = response.headers.get('Content-Disposition');
            if (contentDisposition) {
                var filename = contentDisposition.split('filename=')[1];
                filename = filename.replace(/["']/g, "");

                response.blob().then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.setAttribute('download', filename);
                    document.body.appendChild(a); // we need to append the element to the DOM -> otherwise it will not work in Firefox
                    a.click();
                    a.remove(); // afterwards we remove the element again
                });

                Swal.fire({
                    icon: 'success',
                    text: "Download berhasil!",
                    showConfirmButton: true,
                });
            } else {
                var filename = `polis-${registerId}.pdf`;
                filename = filename.replace(/["']/g, "");

                response.blob().then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.setAttribute('download', filename);
                    document.body.appendChild(a); // we need to append the element to the DOM -> otherwise it will not work in Firefox
                    a.click();
                    a.remove(); // afterwards we remove the element again
                });

                Swal.fire({
                    icon: 'success',
                    text: "Download berhasil!",
                    showConfirmButton: true,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                text: `Error: ${error.message}`,
                showConfirmButton: true,
            });
        });
}

function invoice(reqId) {
    Swal.fire({
        icon: 'info',
        text: "Loading!",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var url = `${apiUrl}/api/generate/invoice?reqId=${reqId}&type=1`;

    var requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow',
        mimeType: "multipart/form-data",
    };

    fetch(url, requestOptions)
        .then(response => {
            var contentDisposition = response.headers.get('Content-Disposition');
            if (contentDisposition) {
                var filename = contentDisposition.split('filename=')[1];
                filename = filename.replace(/["']/g, "");

                response.blob().then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.setAttribute('download', filename);
                    document.body.appendChild(a); // we need to append the element to the DOM -> otherwise it will not work in Firefox
                    a.click();
                    a.remove(); // afterwards we remove the element again
                });

                Swal.fire({
                    icon: 'success',
                    text: "Download berhasil!",
                    showConfirmButton: true,
                });
            } else {
                var filename = `Invoice-${registerId}.pdf`;
                filename = filename.replace(/["']/g, "");

                response.blob().then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.setAttribute('download', filename);
                    document.body.appendChild(a); // we need to append the element to the DOM -> otherwise it will not work in Firefox
                    a.click();
                    a.remove(); // afterwards we remove the element again
                });

                Swal.fire({
                    icon: 'success',
                    text: "Download berhasil!",
                    showConfirmButton: true,
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                text: `Error: ${error.message}`,
                showConfirmButton: true,
            });
        });
}

function handlePayment(reqId) {
    snap.show();
    ajaxGetToken(reqId, function(error, snapToken) {
        if (error) {
            snap.hide();
        } else {
            snap.pay(snapToken, {
                language: 'id',
                onSuccess: async function(resultmt) {
                    await Swal.fire({
                        icon: 'success',
                        html: "<h3>Pembayaran berhasil</h3><br>Silakan periksa email Anda untuk informasi dan instruksi selanjutnya. <br><br> <small>Anda akan dialihkan ke halaman berikutnya dalam <b></b> detik</small>",
                        timer: 10000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        didOpen: () => {
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                // Convert milliseconds to seconds
                                timer.textContent = `${Math.ceil(Swal.getTimerLeft() / 1000)}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then(() => {
                        return window.location.href = resultmt.finish_redirect_url;
                    });
                },
                onPending: function(result) {
                    Swal.fire({
                        icon: 'warning',
                        text: "menunggu pembayaran Anda!",
                        showConfirmButton: true,
                        allowOutsideClick: false,
                    })
                },
                onError: function(result) {
                    Swal.fire({
                        icon: 'warning',
                        text: "Pembayaran Gagal",
                        showConfirmButton: true,
                        allowOutsideClick: false,
                    })
                },
                onClose: function() {
                    Swal.fire({
                        icon: 'warning',
                        text: "Anda menutup popup tanpa menyelesaikan pembayaran",
                        showConfirmButton: true,
                        allowOutsideClick: false,
                    })
                }
            });
        }
    });
}

function ajaxGetToken(reqId, callback) {
    var snapToken;
    // Request get token to your server & save result to snapToken variable

    const form = new FormData();
    form.append("reqId", reqId);

    $.ajax({
        async: true,
        crossDomain: true,
        url: `${apiUrl}/api/client/request/proses-payment`,
        method: "POST",
        processData: false,
        contentType: false,
        data: form
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        if (response.status == 200) {
            snapToken = response.token.toString();
            console.log(snapToken);
            if (snapToken) {
                callback(null, snapToken);
            } else {
                callback(new Error('Failed to fetch snap token'), null);
            }
        } else {
            Swal.fire({
                icon: 'warning',
                text: response.message,
                timer: 3000,
                showConfirmButton: false,
                allowOutsideClick: false,
            });
        }
    }).fail(async function(error) {
        let data;
        try {
            // Attempt to parse the error response as JSON
            data = JSON.parse(error.responseText);
        } catch (e) {
            // If parsing fails, use a default error message
            data = {
                message: 'An unexpected error occurred'
            };
        }

        // Ensure data.message exists
        const message = data.message || 'An unexpected error occurred';

        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
        });
    });
}

function handleDeletePayment(reqId) {
    const form = new FormData();
    form.append("reqId", reqId);

    $.ajax({
        async: true,
        crossDomain: true,
        url: `${apiUrl}/api/client/request/delete-payment`,
        method: "POST",
        processData: false,
        contentType: false,
        data: form
    }).fail(async function(error) {
        let data;
        try {
            // Attempt to parse the error response as JSON
            data = JSON.parse(error.responseText);
        } catch (e) {
            // If parsing fails, use a default error message
            data = {
                message: 'An unexpected error occurred'
            };
        }

        // Ensure data.message exists
        const message = data.message || 'An unexpected error occurred';

        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
        });
    });
}

function handleRequestPayment(reqId, selectedPaymentId) {
    let payload = {
        type: selectedPaymentId,
        reqId: reqId
    };

    if (selectedPaymentId === 10) { // Credit/Debit Card
        payload.card_number = $('#card-number').val();
        payload.card_exp_month = $('#expiry-month').val();
        payload.card_exp_year = $('#expiry-year').val();
        payload.card_cvv = $('#cvv-number').val();
    }

    return $.ajax({
        async: true,
        crossDomain: true,
        url: `${apiUrl}/api/client/request/proses-payment`,
        method: "POST",
        processData: false,
        contentType: "application/json",
        data: JSON.stringify(payload)
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        return response;
    }).fail(async function(error) {
        let data;
        try {
            // Attempt to parse the error response as JSON
            data = JSON.parse(error.responseText);
        } catch (e) {
            // If parsing fails, use a default error message
            data = {
                message: 'An unexpected error occurred'
            };
        }

        // Ensure data.message exists
        const message = data.message || 'An unexpected error occurred';

        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
        });
    });
}

function getPaymentMethod() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        url: `${apiUrl}/api/client/request/payment-method`,
        method: "GET",
        timeout: 0,
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        // Clear the #payment-list element
        $('#payment-list').empty();

        // Group payment methods by payment_group
        const groupedPayments = {};
        response.data.forEach(item => {
            if (!groupedPayments[item.payment_group]) {
                groupedPayments[item.payment_group] = [];
            }
            groupedPayments[item.payment_group].push(item);
        });

        // Define payment group titles
        const paymentGroupTitles = {
            1: "Bank Transfer",
            2: "E Wallet",
            3: "Kartu Kredit/Debit"
        };

        // Function to append payment methods to the specified container
        function appendPaymentMethods(container, items) {
            items.forEach((item) => {
                container.append(`
                    <div class="col-12 col-sm-4 col-lg-4 col-md-4 col-sm-4 payment-item" data-bs-toggle="tooltip" data-bs-placement="top" title="${item.description}">
                        <div class="p-1 p-sm-4 mb-sm-4 mb-1 offer-check rounded" style="border: 2px solid #e7eaee">
                            <div class="form-check">
                                <input type="radio" name="pembayaran" id="pembayaran${item.id}" class="form-check-input input-primary d-none" value="${item.id}" data-group="${item.payment_group}" data-id="${item.id}" data-logo="${item.payment_logo}"/>
                                <label class="form-check-label d-block" for="pembayaran${item.id}">
                                    <div class="media align-items-center justify-content-center">
                                        <img class="rounded img-fluid flex-shrink-0 wid-50 d-sm-none" src="${item.payment_logo}" alt="Payment Logo image">
                                        <img class="rounded img-fluid flex-shrink-0 d-none d-sm-block" src="${item.payment_logo}" alt="Payment Logo image">
                                        <div class="media-body mx-3 my-auto d-sm-none">
                                            <h5 class="h5" style="margin-bottom:0">${item.description}</h5>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                `);
            });
        }

        // Append grouped payment methods to the #payment-list
        Object.keys(groupedPayments).forEach(group => {
            const items = groupedPayments[group];

            // Create a div element for the payment group
            // add border border-dark p-3 mb-3 for add border
            const paymentGroupContainer = $(`
                <div class="">
                    <p class="h6 d-block my-4">${paymentGroupTitles[group]}</p>
                    <div class="row"></div>
                </div>
            `);

            // Append payment methods to the group's row container
            appendPaymentMethods(paymentGroupContainer.find('.row'), items);

            // Append the group container to the payment list
            $('#payment-list').append(paymentGroupContainer);
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        Swal.close();
    }).fail(function(error) {
        let data;
        try {
            data = JSON.parse(error.responseText);
        } catch (e) {
            data = {
                message: 'An unexpected error occurred'
            };
        }

        Swal.fire({
            icon: 'error',
            text: data.message || 'An unexpected error occurred',
            showConfirmButton: true,
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/pendaftaran';
            }
        });
    });
}

function getPaymentStatus(reqId) {
    $.ajax({
        url: `${apiUrl}/api/client/request/payment-status?reqId=${reqId}`,
        method: "GET",
        contentType: "application/json",
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        if (response.status === 201) {
            if (!$('#paymentModal').hasClass('show')) {
                $('#paymentModal').modal('show');
            }
            $('#footer-main').hide();
            $('#footer-payment').show();
            $.each(response['info'], function(j, paymentInfo) {
                switchTab(`#payment-${paymentInfo.payment_group}`);
                hideAllPaymentOutputs();

                // Handle different payment method outputs
                switch (paymentInfo.payment_type_id) {
                    case 1: // Permata Virtual Account
                    case 2: // BCA Virtual Account
                    case 4: // BNI Virtual Account
                    case 5: // BRI Virtual Account
                    case 6: // CIMB Virtual Account
                        $('#va-logo').attr('src', paymentInfo.payment_logo);
                        $('#va-number').text(paymentInfo.va_number); // Example VA number
                        $('#hidden-va-number').val(paymentInfo.va_number);
                        $('#va-payment-status').text(paymentInfo.status_description);
                        $('#va-expiry-time').text(paymentInfo.expiry_time_desc);
                        $('#va-transaction-time').text(paymentInfo.transaction_time);
                        makeCountdown(paymentInfo.expiry_time, 'countdown-payment-bt');
                        $('#va-output').show();
                        break;
                    case 3: // Mandiri Bill Payment
                        $('#bill-logo').attr('src', paymentInfo.payment_logo);
                        $('#company-biller').text(paymentInfo.description);
                        $('#key-bill').text(paymentInfo.bill_key);
                        $('#hidden-key-bill').val(paymentInfo.bill_key);
                        $('#code-bill').text(paymentInfo.biller_code);
                        $('#hidden-code-bill').val(paymentInfo.biller_code);
                        $('#bill-payment-status').text(paymentInfo.status_description);
                        $('#bill-expiry-time').text(paymentInfo.expiry_time_desc);
                        $('#bill-transaction-time').text(paymentInfo.transaction_time);
                        makeCountdown(paymentInfo.expiry_time, 'countdown-payment-bt');
                        $('#bill-payment-output').show();
                        break;
                    case 7: // QRIS (OVO, DANA, LINK AJA)
                        $('#qr-logo').attr('src', paymentInfo.payment_logo);
                        $('#qr-code').attr('src', paymentInfo.qr_code); // Example QR code
                        $('#qr-payment-status').text(paymentInfo.status_description);
                        $('#qr-expiry-time').text(paymentInfo.expiry_time_desc);
                        $('#qr-transaction-time').text(paymentInfo.transaction_time);
                        makeCountdown(paymentInfo.expiry_time, 'countdown-payment-ew');
                        $('#qr-output').show();
                        break;
                    case 8: // GO-PAY
                        $('#gopay-logo').attr('src', paymentInfo.payment_logo);
                        $('#gopay-qr-code').attr('src', paymentInfo.qr_code); // Example QR code
                        $('#gopay-redirect').attr('href', paymentInfo.deeplink); // Example redirect URL
                        $('#gopay-payment-status').text(paymentInfo.status_description);
                        $('#gopay-expiry-time').text(paymentInfo.expiry_time_desc);
                        $('#gopay-transaction-time').text(paymentInfo.transaction_time);
                        makeCountdown(paymentInfo.expiry_time, 'countdown-payment-ew');
                        $('#gopay-output').show();
                        break;
                    case 9: // SHOPEE-PAY
                        $('#shopeepay-logo').attr('src', paymentInfo.payment_logo);
                        $('#shopeepay-redirect').attr('href', paymentInfo.deeplink); // Example redirect URL
                        $('#shopeepay-payment-status').text(paymentInfo.status_description);
                        $('#shopeepay-expiry-time').text(paymentInfo.expiry_time_desc);
                        $('#shopeepay-transaction-time').text(paymentInfo.transaction_time);
                        makeCountdown(paymentInfo.expiry_time, 'countdown-payment-ew');
                        $('#shopeepay-output').show();
                        setTimeout(function() {
                            window.open(
                                paymentInfo.deeplink,
                                '_blank' // <- This is what makes it open in a new window.
                              );
                        }, 2000);
                        break;
                    default:
                        console.log('Unknown payment method');
                }
            });
        } else if (response.status === 202) {
            // Reset all the states
            switchTab('#main');
            hideAllPaymentOutputs();
            $('#footer-payment').hide();
            $('#footer-main').show();
            clearCountdowns();
        } else if (response.status === 200) {
            if (!$('#paymentModal').hasClass('show')) {
                $('#paymentModal').modal('show');
            }
            $('#footer-payment').hide();
            $('#footer-main').hide();
            switchTab('#payment-4');

            setInterval(countdownSuccessPayment, 1000);
        }

        // Ensure loading is stopped in case of an error
        setLoading($('#cek-status-bayar'), false);
    }).fail(function(error) {
        let data;
        try {
            data = JSON.parse(error.responseText);
        } catch (e) {
            data = {
                message: 'An unexpected error occurred'
            };
        }

        // Stop the interval if there's an error
        clearInterval(paymentStatusInterval);

        Swal.fire({
            icon: 'error',
            text: data.message || 'An unexpected error occurred',
            showConfirmButton: true,
            allowOutsideClick: false,
        })

        // Ensure loading is stopped in case of an error
        setLoading($('#cek-status-bayar'), false);
    });
}

function clearCountdowns() {
    $('#countdown-payment-bt').text('');
    $('#countdown-payment-ew').text('');
}
