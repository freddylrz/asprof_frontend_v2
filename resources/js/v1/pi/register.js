import { decryptData, encryptData } from "../encrypt.js";

const planDetails = {}; // Initialize planDetails object
const tempatPraktikDetails = {}; // Initialize tempatPraktikDetails object

function change_tab(tab_name) {
    var $someTabTriggerEl = $('a[href="' + tab_name + '"]');
    $('#auth-active-slide').html($someTabTriggerEl.data('slide-index'));
    var actTab = new bootstrap.Tab($someTabTriggerEl[0]);
    actTab.show();
}

$(document).ready(function() {
    $('.change-tab-btn').on('click', function() {
        // Get the dynamic tab name from the data-tab attribute
        var tabName = $(this).data('tab');
        change_tab(tabName);
    });
    var expSTRCheckbox = $("#status-str");
    var periodeAkhirSTRContainer = $("#periode-akhir-str-container");
    var periodeAwalSTRContainer = $("#periode-awal-str-container");

    var tenagaMedisRadio = $("#option1");
    var tenagaKesehatanRadio = $("#option2");
    var kategoriProfesi = $('#kategori-profesi');

    $(".nomorstr").inputmask({
        mask: "AA99999999999999",
        placeholder: ""
    });

    $(".enambelas").inputmask({
        mask: "9999999999999999",
        placeholder: ""
    });

    $(".mobilenumber").inputmask({
        mask: "9999-9999-999999",
        placeholder: ""
    });

    $('#poin-satu').addClass('js-proses');

    const statuses = [{
            id: '#status-poin-satu',
            class: 'bg-light-warning',
            text: 'Dalam Proses'
        },
        {
            id: '#status-poin-dua',
            class: 'bg-light-danger',
            text: 'Belum Mulai'
        },
        {
            id: '#status-poin-tiga',
            class: 'bg-light-danger',
            text: 'Belum Mulai'
        },
        {
            id: '#status-poin-empat',
            class: 'bg-light-danger',
            text: 'Belum Mulai'
        },
        {
            id: '#status-poin-lima',
            class: 'bg-light-danger',
            text: 'Belum Mulai'
        },
    ];

    statuses.forEach(status => {
        $(status.id).addClass(status.class).text(status.text);
    });

    // Get today's date
    const today = new Date();

    // Disable dates after today for 'tanggal-lahir', 'periode-awal-str', and 'periode-awal-sip'
    new Datepicker(document.querySelector('#tanggal-lahir'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        maxDate: today
    });

    new Datepicker(document.querySelector('#periode-awal-str'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        maxDate: today
    });

    new Datepicker(document.querySelector('#periode-awal-sip'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        maxDate: today
    });

    // Disable dates before today for 'periode-akhir-str' and 'periode-akhir-sip'
    new Datepicker(document.querySelector('#periode-akhir-str'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        minDate: today
    });

    new Datepicker(document.querySelector('#periode-akhir-sip'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        minDate: today
    });

    getDataKota()
    renderTable()

    // Set default to getDataProfesi(1) when page loads
    getDataProfesi(1)

    kategoriProfesi.prop('disabled', true);

    // Attach the mousedown event to the parent element of kategoriProfesi
    kategoriProfesi.parent().on("mousedown", function(event) {
        if (kategoriProfesi.prop('disabled')) {
            event.preventDefault(); // Prevent the default action (opening the select)
            Swal.fire({
                icon: 'error',
                text: 'Silahkan pilih kategori profesi terlebih dahulu',
                allowOutsideClick: false,
            });
        }
    });

    tenagaMedisRadio.on("change", function() {
        $('input[name="asuransi"]').prop('checked', false);
        $('#div-biaya-kepesertaan').hide()
        if ($(this).is(":checked")) {
            kategoriProfesi.prop('disabled', false);
            getDataProfesi(1);
        }
    });

    tenagaKesehatanRadio.on("change", function() {
        $('input[name="asuransi"]').prop('checked', false);
        $('#div-biaya-kepesertaan').hide()
        if ($(this).is(":checked")) {
            kategoriProfesi.prop('disabled', false);
            getDataProfesi(2);
        }
    });

    kategoriProfesi.on("change", function() {
        $('input[name="asuransi"]').prop('checked', false);
        $('#div-biaya-kepesertaan').hide()
    });

    expSTRCheckbox.on("change", function() {
        if ($(this).is(":checked")) {
            periodeAkhirSTRContainer.hide();
            periodeAwalSTRContainer.show();
        } else {
            periodeAkhirSTRContainer.show();
            periodeAwalSTRContainer.hide();
        }
    });

    // Open modal for adding new record
    $('.btntambahTempatPraktik').on('click', function() {
        $('#tambahTempatPraktikTitle').text('Tambah Surat Izin Praktik');
        $('#saveChanges').data('action', 'add');
        clearInputFields()
        $('#tambahTempatPraktik').modal('show');
    });

    $('#btn-next-profesi').on('click', function() {
        if (kategoriProfesi.prop('disabled')) {
            Swal.fire({
                icon: 'error',
                text: 'Silahkan pilih profesi terlebih dahulu',
                allowOutsideClick: false,
            });
        }

        const fields = [
            {
                id: '#kategori-profesi',
                message: 'Mohon pilih profesi Anda terlebih dahulu!'
            },
            {
                id: '#nomor-str',
                message: 'Mohon masukkan nomor STR Anda!'
            },
            {
                id: '#unggah-str',
                message: 'Mohon unggah file STR Anda!'
            },
        ];

        // Add conditional validation for Periode Awal STR if STR is not valid for life
        if ($('#status-str').is(':checked')) {
            fields.push({
                id: '#periode-awal-str',
                message: 'Mohon masukkan periode awal STR Anda!'
            });
        } else {
            fields.push({
                id: '#periode-akhir-str',
                message: 'Mohon masukkan periode akhir STR Anda!'
            });
        }

        if (kategoriProfesi.val() == '') {
            // If no profession category is selected, show an alert
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Profesi',
                text: 'Silakan pilih profesi sebelum melanjutkan.',
            });
            return false; // Prevent moving to the next tab
        }

        // Validate each field
        for (const field of fields) {
            if ($(field.id).val() == '' || $(field.id).val() == null) {
                Swal.fire({
                    icon: "error",
                    text: field.message,
                    allowOutsideClick: false,
                });
                return;
            }
        }

        // Check if tempatPraktikDetails has any entries
        if (Object.keys(tempatPraktikDetails).length === 0) {
            Swal.fire({
                icon: "error",
                text: "Mohon lengkapi Surat Izin Praktik (SIP) Anda!",
                allowOutsideClick: false,
            });
            return;
        }

        change_tab('#auth-3');
    });

    $('#btn-next-pribadi').on('click', function() {

        const fields = [{
                id: '#nama',
                message: 'Mohon masukan nama anda terlebih dahulu!'
            },
            {
                id: '#nik',
                message: 'Mohon masukan NIK anda terlebih dahulu!'
            },
            {
                id: '#unggah-ktp',
                message: 'Mohon unggah KTP anda terlebih dahulu!'
            },
            {
                id: '#tanggal-lahir',
                message: 'Mohon masukan tanggal lahir anda terlebih dahulu!'
            },
            {
                id: '#jenis-kelamin',
                message: 'Mohon pilih jenis kelamin anda terlebih dahulu!'
            },
            {
                id: '#nomor-handphone',
                message: 'Mohon masukan nomor handphone anda terlebih dahulu!'
            },
            {
                id: '#email',
                message: 'Mohon masukan alamat email anda terlebih dahulu!'
            },
            {
                id: '#alamat',
                message: 'Mohon masukan domisili tempat tinggal anda terlebih dahulu!'
            },
        ];

        // Validate each field
        for (const field of fields) {
            if ($(field.id).val() == '' || $(field.id).val() == null) {
                Swal.fire({
                    icon: "error",
                    text: field.message,
                    allowOutsideClick: false,
                });
                return;
            }
        }

        change_tab('#auth-4');
    });

    $('#btn-next-plan').on('click', function() {
        // Check if an insurance option is selected
        const selectedInsurance = $('input[name="asuransi"]:checked').val();
        // Check if a plan option is selected
        const selectedPlan = $('input[name="plan"]:checked').val();

        if (!selectedInsurance) {
            // If no insurance option is selected, show an alert
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Asuransi',
                text: 'Silakan pilih asuransi sebelum melanjutkan.',
            });
            return false; // Prevent moving to the next tab
        }

        if (!selectedPlan) {
            // If no plan option is selected, show an alert
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Plan',
                text: 'Silakan pilih plan sebelum melanjutkan.',
            });
            return false; // Prevent moving to the next tab
        }

        // If both are selected, proceed to the next tab
        change_tab('#auth-5');
    });

    // Handle save changes button click
    $('#saveChanges').on('click', function() {
        const saveChanges = $(this);
        saveChanges.data('original-text', saveChanges.html());
        setLoading(saveChanges, true);

        const action = $(this).data('action');
        const id = $(this).data('id') || Date.now().toString();
        const nomorSIP = $('#nomor-sip').val();
        const periodeAwalSIP = $('#periode-awal-sip').val();
        const periodeAkhirSIP = $('#periode-akhir-sip').val();
        const daerahPenerbitSIP_id = $('#daerah-penerbit-sip').val();
        const daerahPenerbitSIP = $('#daerah-penerbit-sip option:selected').text();
        const tempat = $('#tempat-praktik').val();
        const namaPenerbitSIP = $('#nama-penerbit-sip').val();
        const unggahSIP = $('#unggah-sip').prop('files')[0];

        if (nomorSIP && periodeAwalSIP && periodeAkhirSIP && daerahPenerbitSIP_id && tempat) {
            // Determine if we are adding a new entry or updating an existing one
            if (action === 'add') {
                // Validate if nomorSIP is already in use
                for (const key in tempatPraktikDetails) {
                    if (tempatPraktikDetails.hasOwnProperty(key) && tempatPraktikDetails[key].nomorSIP === nomorSIP && key !== id) {
                        setLoading(saveChanges, false);
                        Swal.fire({
                            icon: "error",
                            text: "Nomor SIP sudah digunakan. Harap gunakan nomor SIP yang berbeda.",
                            allowOutsideClick: false,
                        });
                        return;
                    }
                }

                if (daerahPenerbitSIP_id === "0") {
                    if (!namaPenerbitSIP) {
                        setLoading(saveChanges, false);
                        Swal.fire({
                            icon: "error",
                            text: "Harap isi Nama Penerbit SIP terlebih dahulu",
                            allowOutsideClick: false,
                        });
                        return false;
                    }
                }

                // Input (new entry)
                if (unggahSIP) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        tempatPraktikDetails[id] = {
                            nomorSIP: nomorSIP,
                            periodeAwalSIP: periodeAwalSIP,
                            periodeAkhirSIP: periodeAkhirSIP,
                            daerahPenerbitSIP_id: daerahPenerbitSIP_id,
                            daerahPenerbitSIP: daerahPenerbitSIP,
                            tempat: tempat,
                            namaPenerbitSIP: daerahPenerbitSIP_id === "0" ? namaPenerbitSIP : "0",
                            unggahSIP: e.target.result // Base64 string of the image
                        };
                        renderTable();
                        $('#tambahTempatPraktik').modal('hide');
                        clearInputFields();
                    }
                    reader.readAsDataURL(unggahSIP);
                    setLoading(saveChanges, false);
                } else {
                    Swal.fire({
                        icon: "error",
                        text: "Anda harus mengunggah SIP!",
                        allowOutsideClick: false,
                    });
                    setLoading(saveChanges, false);
                }
            } else {
                if (daerahPenerbitSIP_id === "0") {
                    if (!namaPenerbitSIP) {
                        setLoading(saveChanges, false);
                        Swal.fire({
                            icon: "error",
                            text: "Harap isi Nama Penerbit SIP terlebih dahulu",
                            allowOutsideClick: false,
                        });
                        return false;
                    }
                }

                // Update existing entry
                tempatPraktikDetails[id] = {
                    nomorSIP: nomorSIP,
                    periodeAwalSIP: periodeAwalSIP,
                    periodeAkhirSIP: periodeAkhirSIP,
                    daerahPenerbitSIP_id: daerahPenerbitSIP_id,
                    daerahPenerbitSIP: daerahPenerbitSIP,
                    tempat: tempat,
                    namaPenerbitSIP: daerahPenerbitSIP_id === "0" ? namaPenerbitSIP : "0",
                    unggahSIP: unggahSIP ? (new FileReader()).readAsDataURL(unggahSIP) : tempatPraktikDetails[id].unggahSIP // Keep existing file if not updated
                };

                if (unggahSIP) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        tempatPraktikDetails[id].unggahSIP = e.target.result; // Base64 string of the image
                        renderTable();
                        $('#tambahTempatPraktik').modal('hide');
                        clearInputFields();
                    }
                    reader.readAsDataURL(unggahSIP);
                    setLoading(saveChanges, false);
                } else {
                    renderTable();
                    $('#tambahTempatPraktik').modal('hide');
                    clearInputFields();
                    setLoading(saveChanges, false);
                }
            }
        } else {
            setLoading(saveChanges, false);
            Swal.fire({
                icon: "error",
                text: "Anda harus mengisi semua data!",
                allowOutsideClick: false,
            });
            return;
        }
    });

    // Delegate click event to dynamically created delete buttons
    $('#accordionFlushExample').on('click', '.delete-row', function() {
        const rowId = $(this).data('id');
        delete tempatPraktikDetails[rowId];
        renderTable();
    });

    // Delegate click event to dynamically created edit buttons
    $('#tbody-daerah-praktik').on('click', '.edit-detail', function() {
        const rowId = $(this).data('id');
        const detail = tempatPraktikDetails[rowId];

        // Pre-fill the modal form with the existing details
        $('#nomor-sip').val(detail.nomorSIP);
        $('#periode-awal-sip').val(detail.periodeAwalSIP);
        $('#periode-akhir-sip').val(detail.periodeAkhirSIP);
        $('#daerah-penerbit-sip').data('choices').setChoiceByValue(detail.daerahPenerbitSIP_id);
        $('#tempat-praktik').val(detail.tempat);

        if (detail.daerahPenerbitSIP_id === "0") {
           $('#div-nama-penerbit').show();
           $('#nama-penerbit-sip').val(detail.namaPenerbitSIP);
        } else {
           $('#div-nama-penerbit').hide();
           $('#nama-penerbit-sip').val("");
        }
        // Note: File input cannot be pre-filled for security reasons

        // Change modal title and set action to edit
        $('#tambahTempatPraktikTitle').text('Edit Surat Izin Praktik');
        $('#saveChanges').data('action', 'edit').data('id', rowId);
        $('#tambahTempatPraktik').modal('show');
    });

    $('input[type="file"]').change(function() {
        let fileInput = $(this);
        let filePath = fileInput.val();
        let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (!allowedExtensions.exec(filePath)) {
            Swal.fire({
                icon: 'warning',
                text: "Anda hanya dapat mengunggah gambar atau foto dengan format JPG atau PNG.",
                showConfirmButton: true,
            });

            fileInput.val(''); // Clear the input
        }
    });

    $('#daerah-penerbit-sip').change(function() {
        let selectedValue = $(this).val();

        if (selectedValue === "0") {
           $('#div-nama-penerbit').show();
        } else {
           $('#div-nama-penerbit').hide();
        }
     });

    $('#insertData').on('submit', async function(e) {
        e.preventDefault()

        if (!$('#setuju').is(":checked")) {
            Swal.fire({
                icon: 'warning',
                text: 'Mohon check setuju terlebih dahulu.',
                showConfirmButton: true,
            });
            return; // Exit the function if validation fails
        }

        handleInsertData()
        // await Swal.fire({
        //     icon: 'warning',
        //     html: 'Dengan melanjutkan, saya menyatakan bahwa data yang saya berikan adalah benar dan akurat. Saya memahami bahwa ketidakakuratan atau kesalahan dalam data yang diberikan dapat menjadi kendala proses klaim. <br><br> Lanjutkan proses registrasi data?',
        //     showDenyButton: true,
        //     confirmButtonText: 'Ya, Lanjutkan',
        //     denyButtonText: `Batal`,
        // }).then((result) => {
        //     /* Read more about isConfirmed, isDenied below */
        //     if (result.isConfirmed) {
        //         handleInsertData()
        //     } else if (result.isDenied) {
        //         return Swal.fire({
        //             icon: 'error',
        //             title: 'Perubahan tidak disimpan',
        //             showConfirmButton: true,
        //         });
        //     }
        // })
    });
});

function setLoading(button, isLoading) {
    if (isLoading) {
        button.html('<i class="spinner-border spinner-border-sm"></i> Loading...');
        button.prop('disabled', true);
    } else {
        button.html(button.data('original-text'));
        button.prop('disabled', false);
    }
}

// Function to clear input fields
function clearInputFields() {
    $('#nomor-sip').val('');
    $('#periode-awal-sip').val('');
    $('#periode-akhir-sip').val('');
    $('#daerah-penerbit-sip').data('choices').removeActiveItems();
    $('#tempat-praktik').val('');
    $('#unggah-sip').val('');
    $('#current-file-sip').hide().attr('href', '#');
    $('#div-nama-penerbit').hide();
    $('#periode-akhir-sip').val('');
    $('#saveChanges').removeData('id');
}

function getDataProfesi(profesi_id) {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        url: `${apiUrl}/api/client/request/get-data-profesi`,
        method: "GET",
        dataType: 'json',
        timeout: 0,
        data: {
            type: 1,
            profesi_id: profesi_id
        }
    }).done(async function(responses) {
        // console.log(responses['data'])
        var response = await decryptData(responses.data)
        var $kategoriProfesi = $('#kategori-profesi');

        // Clear existing Choices.js instance if it exists
        if ($kategoriProfesi.data('choices')) {
            $kategoriProfesi.data('choices').destroy();
            $kategoriProfesi.removeData('choices');
        }

        // Clear the select element before appending new options
        $kategoriProfesi.empty();

        $kategoriProfesi.append($('<option>', {
            value: '',
            text: "-- Pilih Profesi --"
        }));

        $.each(response.data, function(i, item) {
            $kategoriProfesi.append($('<option>', {
                value: item.id,
                text: item.description
            }));
        });

        // Initialize Choices.js with custom placeholders
        var choices = new Choices('#kategori-profesi', {
            itemSelectText: '',
            searchPlaceholderValue: 'Cari profesi',
            shouldSort: false,
        });

        // Store the Choices.js instance to the select element
        $kategoriProfesi.data('choices', choices);

        // Clear the #daftar-asuransi element
        $('#daftar-asuransi').empty();

        // Populate planDetails object with response data
        $.each(response.insurance, function(i, item) {
            $('#daftar-asuransi').append(`
                <div class="col-12 col-sm-4 col-lg-4 col-md-4 col-sm-4 px-1 insurance-item" data-bs-toggle="tooltip" data-bs-placement="top" title="${item.nama}">
                    <div class="p-1 mb-sm-4 mb-3 offer-check rounded" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;">
                        <div class="form-check">
                            <input type="radio" name="asuransi" id="asuransi${item.id}" class="form-check-input input-primary d-none" value="${item.id}" data-group="${item.logo}" data-id="${item.id}" data-logo="${item.logo}"/>
                            <label class="form-check-label d-block" for="asuransi${item.id}">
                                <div class="media align-items-center justify-content-center">
                                    <img class="rounded img-fluid flex-shrink-0 wid-50 hei-40 d-sm-none" src="${item.logo}" alt="Insurance Logo image">
                                    <img class="rounded img-fluid flex-shrink-0 hei-115 d-none d-sm-block" src="${item.logo}" alt="Insurance Logo image">
                                    <div class="media-body mx-3 my-auto d-sm-none">
                                        <h5 class="h6" style="margin-bottom:0">Asuransi ${item.nama}</h5>
                                    </div>
                                </div>
                            </label>
                            <div class="text-center d-none d-sm-grid">
                                <h6 class="text-muted" style="margin-bottom:0">Asuransi<br>${item.nama}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            `)
        });

        $(('input[type=radio][name=asuransi]')).on("change", function() {
            if ($(this).is(":checked")) {
                getBiayaKepesertaan($('input[name="asuransi"]:checked').val());
            }
        });

        Swal.close();
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
        });
    });
}

function getBiayaKepesertaan(ins_id) {
    var profesi_id = $('input[name="profesi_id"]:checked').val();
    var profesi_kategori_id = $('#kategori-profesi').val();

    // Validation for profesi_kategori_id and ins_id
    if (!profesi_id) {
        $('input[name="asuransi"]').prop('checked', false);
        Swal.fire({
            icon: 'warning',
            text: 'Mohon Pilih Profesi terlebih dahulu sebelum memilih plan.',
            showConfirmButton: true,
        });
        return; // Exit the function if validation fails
    }

    // Validation for profesi_kategori_id and ins_id
    if (!profesi_kategori_id) {
        $('input[name="asuransi"]').prop('checked', false);
        Swal.fire({
            icon: 'warning',
            text: 'Mohon Pilih Profesi terlebih dahulu sebelum memilih plan.',
            showConfirmButton: true,
        });
        return; // Exit the function if validation fails
    }

    if (!ins_id) {
        $('input[name="asuransi"]').prop('checked', false);
        Swal.fire({
            icon: 'warning',
            text: 'Mohon Pilih Asuransi terlebih dahulu sebelum memilih plan.',
            showConfirmButton: true,
        });
        return; // Exit the function if validation fails
    }

    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        url: `${apiUrl}/api/client/request/get-data-profesi`,
        method: "GET",
        timeout: 0,
        data: {
            type: 2,
            profesi_id: profesi_id,
            profesi_kategori_id: profesi_kategori_id,
            ins_id: ins_id
        }
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        // Clear the #biaya-kepesertaan element
        $('#biaya-kepesertaan').empty();

        // Determine the column class based on the number of items
        let colClass = response.data.length % 2 === 0 ? 'col-xl-3' : 'col-xl-4';

        // Populate planDetails object with response data
        $.each(response.data, function(i, item) {
            $('#biaya-kepesertaan').append(`
            <div class="col-12 col-md-6 col-lg-6 ${colClass} px-1">
                <div class="offer-check rounded p-2" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050; margin-bottom: 10px">
                    <div class="form-check">
                    <input type="radio" name="plan" class="form-check-input input-primary" value="${item.id}" id="plan${i}" />
                    <label class="form-check-label d-block" for="plan${i}">
                        <span class="h5 mb-0 d-block">${item.plan_desc}</span>
                        <p class="text-muted offer-details" style="font-size:12px">Premi Tahunan: <br><span class="h6">${item.premi}</span></p>
                        <p class="text-muted offer-details" style="font-size:12px">Jaminan Pertanggungan: <br><span class="h6">${item.sum_insured}</span></p>
                    </label>
                    </div>
                </div>
            </div>
            `)
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        $('#div-biaya-kepesertaan').show()

        Swal.close();
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
        });
    });
}

function getDataKota() {
    $.ajax({
        "url": `${apiUrl}/api/client/request/get-data-kota`,
        "method": "GET",
        "timeout": 0,
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        var $daerahPenerbitSIP = $('#daerah-penerbit-sip');

        if ($daerahPenerbitSIP.data('choices')) {
            $daerahPenerbitSIP.data('choices').destroy();
            $daerahPenerbitSIP.removeData('choices');
        }

        // Clear the select element before appending new options
        $daerahPenerbitSIP.empty();

        $daerahPenerbitSIP.append($('<option>', {
            value: '',
            text: "-- Pilih Kota/Kabupaten --"
        }));

        $.each(response.data, function(i, item) {
            $daerahPenerbitSIP.append($('<option>', {
                value: item.id,
                text: item.name
            }));
        });

        var choices2 = new Choices('#daerah-penerbit-sip', {
            itemSelectText: '',
            searchPlaceholderValue: 'Cari Kota/Kabupaten',
            shouldSort: false,
        });

        // Store the Choices.js instance to the select element
        $daerahPenerbitSIP.data('choices', choices2);

        Swal.close();
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
        });
    });
}

function renderTable() {
    const $accordion = $('#accordionFlushExample');
    $accordion.empty();

    // Check if tempatPraktikDetails is empty
    if (Object.keys(tempatPraktikDetails).length === 0) {
        const emptyMessage = `
            <div class="text-center p-4">
                <h5>Data tempat praktik masih kosong</h5>
            </div>
        `;
        $accordion.append(emptyMessage);
    } else {
        let counter = 1;
        for (const id in tempatPraktikDetails) {
            if (tempatPraktikDetails.hasOwnProperty(id)) {
                const item = `
                    <div class="accordion-item border border-dark">
                        <h2 class="accordion-header" id="flush-heading${counter}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse${counter}" aria-expanded="false" aria-controls="flush-collapse${counter}">
                                <span class="h4 text-center">${counter}. SIP Nomor. ${tempatPraktikDetails[id].nomorSIP}</span>
                            </button>
                        </h2>
                        <div id="flush-collapse${counter}" class="accordion-collapse collapse" aria-labelledby="flush-heading${counter}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="media align-items-start my-3">
                                            <div class="media-body my-auto">
                                                <p class="text-muted text-sm mb-2">Periode Awal SIP:</p>
                                                <h5 class="h5">${tempatPraktikDetails[id].periodeAwalSIP}</h5>
                                            </div>
                                        </div>
                                        <div class="media align-items-start my-3">
                                            <div class="media-body my-auto">
                                                <p class="text-muted text-sm mb-2">Periode Akhir SIP:</p>
                                                <h5 class="h5">${tempatPraktikDetails[id].periodeAkhirSIP}</h5>
                                            </div>
                                        </div>
                                        <div class="media align-items-start my-3">
                                            <div class="media-body my-auto">
                                                <p class="text-muted text-sm mb-2">Penerbit SIP:</p>
                                                <h5 class="h5">${tempatPraktikDetails[id].daerahPenerbitSIP}</h5>
                                            </div>
                                        </div>
                                        <div class="media align-items-start my-3" style="${tempatPraktikDetails[id].daerahPenerbitSIP === '99' ? '' : 'display: none'}">
                                            <div class="media-body my-auto">
                                                <p class="text-muted text-sm mb-2">Nama Penerbit SIP:</p>
                                                <h5 class="h5">${tempatPraktikDetails[id].namaPenerbitSIP}</h5>
                                            </div>
                                        </div>
                                        <div class="media align-items-start my-3">
                                            <div class="media-body my-auto">
                                                <p class="text-muted text-sm mb-2">Tempat Praktik:</p>
                                                <h5 class="h5">${tempatPraktikDetails[id].tempat}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex justify-content-center align-items-center mb-3 text-center">
                                            <span class="h5"><i class="ti ti-photo me-2"></i>Foto Surat Izin Praktik</span>
                                        </div>
                                        <div class="d-flex justify-content-center mb-3">
                                            <img src="${tempatPraktikDetails[id].unggahSIP}" alt="foto SIP" style="max-width: 100%; height: auto;">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid justify-content-end">
                                    <button type="button" class="btn btn-danger delete-row" data-id="${id}"><i class="ti ti-trash"></i> Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $accordion.append(item);
                counter++;
            }
        }
    }
}

async function handleInsertData() {
    const saveChanges = $('#kirim');
    saveChanges.data('original-text', saveChanges.html());
    setLoading(saveChanges, true);

    Swal.fire({
        icon: "info",
        text: "Loading...",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    const fields = [
        { id: '#nama', message: 'Mohon masukan nama anda terlebih dahulu!' },
        { id: '#nik', message: 'Mohon masukan NIK anda terlebih dahulu!' },
        { id: '#tanggal-lahir', message: 'Mohon masukan tanggal lahir anda terlebih dahulu!' },
        { id: '#jenis-kelamin', message: 'Mohon pilih jenis kelamin anda terlebih dahulu!' },
        { id: '#nomor-handphone', message: 'Mohon masukan nomor handphone anda terlebih dahulu!' },
        { id: '#email', message: 'Mohon masukan alamat email anda terlebih dahulu!' },
        { id: '#alamat', message: 'Mohon masukan domisili tempat tinggal anda terlebih dahulu!' },
    ];

    for (const field of fields) {
        if ($(field.id).val() === '' || $(field.id).val() === null) {
            setLoading(saveChanges, false);
            Swal.fire({
                icon: "error",
                text: field.message,
                allowOutsideClick: false,
            });
            return;
        }
    }

    var kontakDarurat = $('#nama-kontak-darurat').val();
    var nomorDarurat = $('#nomor-kontak-darurat').val();

    if ((kontakDarurat && (kontakDarurat !== '-' && kontakDarurat !== '')) ||
        (nomorDarurat && (nomorDarurat !== '-' && nomorDarurat !== ''))) {
        if (kontakDarurat === '' || kontakDarurat === null || kontakDarurat === '-') {
            setLoading(saveChanges, false);
            Swal.fire({
                icon: "error",
                text: 'Mohon masukan nama kontak darurat anda!',
                allowOutsideClick: false,
            });
            return;
        }
        if (nomorDarurat === '' || nomorDarurat === null || nomorDarurat === '-') {
            setLoading(saveChanges, false);
            Swal.fire({
                icon: "error",
                text: 'Mohon masukan nomor darurat anda!',
                allowOutsideClick: false,
            });
            return;
        }
    }

    kontakDarurat = (kontakDarurat === null || kontakDarurat === '' || kontakDarurat === '-') ? '' : kontakDarurat;
    nomorDarurat = (nomorDarurat === null || nomorDarurat === '' || nomorDarurat === '-') ? '' : nomorDarurat;

    const formData = {
        nama: $('#nama').val(),
        nik: $('#nik').val(),
        tempat_lahir: $('#tempat-lahir').val(),
        tanggal_lahir: $('#tanggal-lahir').val(),
        jenis_kelamin: $('#jenis-kelamin').val(),
        email: $('#email').val(),
        alamat: $('#alamat').val(),
        npwp: $('#npwp').val(),
        no_hp: $('#nomor-handphone').val(),
        kontak_darurat: kontakDarurat || '',
        nomor_darurat: nomorDarurat || '',
        profesi_id: $('input[name="profesi_id"]:checked').val(),
        profesi_kategori_id: $('#kategori-profesi').val(),
        str_no: $('#nomor-str').val(),
        str_stat: $('#status-str').is(':checked') ? 1 : 0,
        str_date_start: $('#status-str').is(':checked') ? $('#periode-awal-str').val() : "",
        str_date_end: $('#status-str').is(':checked') ? "" : $('#periode-akhir-str').val(),
        ins_id: $('input[name="asuransi"]:checked').val(),
        plan_id: $('input[name="plan"]:checked').val(),
        sip_no: [],
        sip_date_start: [],
        sip_date_end: [],
        sip_penerbit: [],
        sip_penerbit_desc: [],
        tempat_praktik: [],
        fileInputSIP: [],
    };

    await Promise.all(
        Object.values(tempatPraktikDetails).map(async (detail, index) => {
            formData.sip_no.push(detail.nomorSIP);
            formData.sip_date_start.push(detail.periodeAwalSIP);
            formData.sip_date_end.push(detail.periodeAkhirSIP);
            formData.sip_penerbit.push(detail.daerahPenerbitSIP_id);
            formData.sip_penerbit_desc.push(detail.daerahPenerbitSIP_id === "0" ? detail.namaPenerbitSIP : "0");
            formData.tempat_praktik.push(detail.tempat);
            formData.fileInputSIP.push(detail.unggahSIP ? detail.unggahSIP : null);
        })
    );

    function fileToBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                resolve(e.target.result);
            };
            reader.onerror = function (error) {
                reject(error);
            };
            reader.readAsDataURL(file);
        });
    }

    const fileInputs = [
        { id: '#unggah-ktp', formKey: 'fileInputKTP', text: 'KTP' },
        { id: '#unggah-str', formKey: 'fileInputSTR', text: 'STR' },
    ];

    for (const fileInput of fileInputs) {
        const fileElement = $(fileInput.id)[0].files[0];
        if (!fileElement) {
            Swal.fire({
                icon: 'error',
                text: `Harap upload file ${fileInput.text} terlebih dahulu`,
                showConfirmButton: true,
            });
            setLoading(saveChanges, false);
            return;
        }
        try {
            const base64File = await fileToBase64(fileElement);
            formData[fileInput.formKey] = base64File;
        } catch (error) {
            console.error(`Error converting ${fileInput.formKey} to Base64:`, error);
        }
    }

    const formDataString = JSON.stringify(formData);
    const encryptedData = await encryptData(formDataString);

    const form = new FormData();
    form.append("data", encryptedData);

    $.ajax({
        async: true,
        crossDomain: true,
        url: `${apiUrl}/api/client/request/insert`,
        method: "POST",
        processData: false,
        contentType: false,
        mimeType: "multipart/form-data",
        data: form,
    })
    .done(async function (responses) {
        const response = JSON.parse(responses);

        if (response.status === 200) {
            const data = await decryptData(response.data);

            Swal.fire({
                icon: 'success',
                title: data.data,
                html: "Silakan periksa email Anda untuk informasi dan instruksi selanjutnya. <br><br> <small>Anda akan dialihkan ke halaman berikutnya dalam <b></b> detik</small>",
                timer: 10000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    const b = Swal.getHtmlContainer().querySelector("b");
                    Swal.getTimerLeft() && setInterval(() => (b.textContent = Math.ceil(Swal.getTimerLeft() / 1000)), 100);
                }
            }).then(() => window.location.replace(`/detail/${data.id}`));
        } else {
            Swal.fire({
                icon: 'warning',
                title: data.message,
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    })
    .fail(function (jqXHR) {
        let errorMessage = 'Terjadi kesalahan saat mengirim data. Silakan coba lagi nanti.';
        if (jqXHR.responseText) {
            try {
                const errorData = JSON.parse(jqXHR.responseText);
                errorMessage = errorData.message || errorMessage;
            } catch (error) {
                console.error('Error parsing response:', error);
            }
        }
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Masalah',
            text: errorMessage,
            showConfirmButton: true,
        });
    })
    .always(() => setLoading(saveChanges, false));
}
