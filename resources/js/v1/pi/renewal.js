import { decryptData, encryptData } from "../encrypt.js";

const planDetails = {}; // Initialize planDetails object
var tempatPraktikDetails = {}; // Initialize tempatPraktikDetails object
var id;
var selectedPlan;
var kategoriProfesiId;
var profesiId;
var daerahPenerbitId;
var insuranceId;
var requestId;
let oldKtpFilePath = '';
let oldStrFilePath = '';

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
    var expSTRCheckb
    var expSTRCheckbox = $("#status-str");
    var periodeAkhirSTRContainer = $("#periode-akhir-str-container");
    var periodeAkhirSTRCiner = $("#periode-awal-str-container");

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

    renderTable();  // Assuming renderTable doesn't need to be awaited
    getDataDashboard();
    getDataDetail();

    tenagaMedisRadio.prop("checked", true);

    tenagaMedisRadio.on("change", function() {
        $('input[name="asuransi"]').prop('checked', false);
        $('#div-biaya-kepesertaan').hide()
        if ($(this).is(":checked")) {
            getDataProfesi(1);
        }
    });

    tenagaKesehatanRadio.on("change", function() {
        $('input[name="asuransi"]').prop('checked', false);
        $('#div-biaya-kepesertaan').hide()
        if ($(this).is(":checked")) {
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
            periodeAkhirSTRCiner.show();
        } else {
            periodeAkhirSTRContainer.show();
            periodeAkhirSTRCiner.hide();
        }
    });

    $('#plan').change(function() {
        const selectedPlan = $(this).val();
        if (planDetails[selectedPlan]) {
            $('#premi-tahunan').text(planDetails[selectedPlan].premiTahunan);
            $('#jaminan-pertanggungan').text(planDetails[selectedPlan].jaminanPertanggungan);
            $('#div-premi-tahunan').removeClass('d-none');
            $('#div-jaminan-pertanggungan').removeClass('d-none');
        } else {
            $('#premi-tahunan').text('');
            $('#jaminan-pertanggungan').text('');
            $('#div-premi-tahunan').addClass('d-none');
            $('#div-jaminan-pertanggungan').addClass('d-none');
        }
    });

    $('.btntambahTempatPraktik').on('click', function() {
        $('#tambahTempatPraktikTitle').text('Tambah Surat Izin Praktik');
        clearInputFields();
        $('#saveChanges').removeData('id'); // Clear the data-id attribute
        $('#saveChanges').data('action', 'add');
        $('#tambahTempatPraktik').modal('show');
    });

    // Handle save changes button click
    $('#saveChanges').on('click', function () {
        const saveChanges = $(this);
        saveChanges.data('original-text', saveChanges.html());
        setLoading(saveChanges, true);

        const action = $(this).data('action');
        const id = $(this).data('id');
        const nomorSIP = $('#nomor-sip').val();
        const periodeAwalSIP = $('#periode-awal-sip').val();
        const periodeAkhirSIP = $('#periode-akhir-sip').val();
        const daerahPenerbitSIP_id = $('#daerah-penerbit-sip').val();
        const daerahPenerbitSIP = $('#daerah-penerbit-sip option:selected').text();
        const tempat = $('#tempat-praktik').val();
        const namaPenerbitSIP = $('#nama-penerbit-sip').val();
        const unggahSIPFile = $('#unggah-sip').prop('files')[0];

        if (nomorSIP && periodeAwalSIP && periodeAkhirSIP && daerahPenerbitSIP_id && tempat) {
            // Validate if nomorSIP is already in use
            for (const key in tempatPraktikDetails) {
                if (tempatPraktikDetails.hasOwnProperty(key) && tempatPraktikDetails[key].nomorSIP === nomorSIP && key !== id) {
                    Swal.fire({
                        icon: "error",
                        text: "Nomor SIP sudah digunakan. Harap gunakan nomor SIP yang berbeda.",
                        allowOutsideClick: false,
                    });
                    return;
                }
            }

            if (daerahPenerbitSIP_id === "0" && !namaPenerbitSIP) {
                Swal.fire({
                    icon: "error",
                    text: "Harap isi Nama Penerbit SIP terlebih dahulu.",
                    allowOutsideClick: false,
                });
                return;
            }

            // If action is "add" and a file is uploaded
            if (action === 'add') {
                if (unggahSIPFile) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const base64String = e.target.result; // Base64 string of the file

                        // Generate a unique ID for the new entry
                        const newId = Date.now().toString();

                        // Add new entry to tempatPraktikDetails
                        tempatPraktikDetails[newId] = {
                            nomorSIP,
                            periodeAwalSIP,
                            periodeAkhirSIP,
                            daerahPenerbitSIP_id,
                            daerahPenerbitSIP,
                            tempat,
                            unggahSIP: base64String, // Assign the Base64 string here
                        };

                        renderTable();
                        $('#tambahTempatPraktik').modal('hide');
                        clearInputFields();
                    };
                    reader.readAsDataURL(unggahSIPFile); // Convert file to Base64
                } else {
                    Swal.fire({
                        icon: "error",
                        text: "Harap unggah file Surat Izin Praktik.",
                        allowOutsideClick: false,
                    });
                }
            } else if (action === 'edit' && id) {
            tempatPraktikDetails[id] = {
                nomorSIP,
                periodeAwalSIP,
                periodeAkhirSIP,
                daerahPenerbitSIP_id,
                daerahPenerbitSIP,
                tempat,
                unggahSIP: tempatPraktikDetails[id].unggahSIP || '', // Retain existing link
            };
        }

        renderTable();
        $('#tambahTempatPraktik').modal('hide');
        clearInputFields();
        setLoading(saveChanges, false);
        } else {
            Swal.fire({
                icon: "error",
                text: "Anda harus mengisi semua data!",
                allowOutsideClick: false,
            });
        }
    });

    // Handle delete row click
    $('#accordionFlushExample').on('click', '.delete-row', function() {
        const rowId = $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                delete tempatPraktikDetails[rowId];
                renderTable();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil dihapus!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });

    // Handle edit row click
    $('#accordionFlushExample').on('click', '.edit-detail', function() {
        const rowId = $(this).data('id');
        const detail = tempatPraktikDetails[rowId];

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

    $('#updateData').on('submit', async function(e) {
        e.preventDefault()
        await Swal.fire({
                icon: 'warning',
                html: 'Dengan melanjutkan, saya menyatakan bahwa data yang saya berikan adalah benar dan akurat. Saya memahami bahwa ketidakakuratan atau kesalahan dalam data yang diberikan dapat menjadi kendala proses klaim. <br><br> Lanjutkan proses memperbaiki data?',
                showDenyButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                denyButtonText: `Batal`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    handleupdateData()
                } else if (result.isDenied) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Perubahan tidak disimpan',
                        showConfirmButton: true,
                    });
                }
            })
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
    $('#saveChanges').removeData('id');
}

function getDataDetail() {
    return new Promise((resolve, reject) => {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    // Get the token safely
    const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
    const token = cookie ? cookie.split('=')[1] : null;

    $.ajax({
        "url": `${apiUrl}/api/client/renewal/get-data`,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": `Bearer ${token}`
        },
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        console.log(response);

        var statusId;
        $.each(response['data'], function(j, item) {
            id = item.id
            profesiId = item.profesi_id
            kategoriProfesiId = item.profesi_kategori_id
            selectedPlan = item.plan_id
            daerahPenerbitId = item.sip_penerbit
            statusId = item.status_id;
            insuranceId = item.ins_id;
            requestId = item.id;

            $('#nomor-register').html(item.register_no)
            $('#nama').val(item.nama)
            $('#nik').val(item.nik)
            $('#tempat-lahir').val(item.tempat_lahir)
            $('#tanggal-lahir').val(item.tanggal_lahir)
            $('#email').val(item.email)
            $('#jenis-kelamin').val(item.jenis_kelamin).change();
            $('#nomor-handphone').val(item.no_hp)
            $('#npwp').val(item.npwp)
            $('#alamat').val(item.alamat)
            $('#nama-kontak-darurat').val(item.kontak_darurat)
            $('#nomor-kontak-darurat').val(item.nomor_darurat)
            if (item.str_stat == '1') {
                $('#status-str').prop('checked', true);
                $('#periode-awal-str').val(item.str_date_start)
                $("#periode-akhir-str-container").hide();
                $("#periode-awal-str-container").show();
            } else {
                $('#status-str').prop('checked', false);
                $('#periode-akhir-str').val(item.str_date_end)
                $("#periode-akhir-str-container").show();
                $("#periode-awal-str-container").hide();
            }
            $('#nomor-str').val(item.str_no)
            $('#nomor-sip').val(item.sip_no)
            $('#periode-awal-sip').val(item.sip_date_start)
            $('#periode-akhir-sip').val(item.sip_date_end)
            $('#premi-tahunan').text(item.premi)
            $('#jaminan-pertanggungan').text(item.sum_insured)
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
                        },
                        {
                            id: '#poin-lima',
                            class: 'js-active'
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
                        },
                        {
                            id: '#poin-lima',
                            class: 'js-active'
                        }
                    ];
                case 7:
                case 8:
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
                            class: 'bg-light-warning border border-warning',
                            text: 'Dalam Proses'
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
                            id: '#poin-lima',
                            class: 'js-proses'
                        },
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
                            class: 'bg-light-success border border-success',
                            text: 'Selesai'
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
                        },
                        {
                            id: '#poin-lima',
                            class: 'js-active'
                        }
                    ];
            }
        };

          const statuses = getStatusesByStatusId(statusId);

          statuses.forEach(status => {
            $(status.id).addClass(status.class).text(status.text);
          });

          $('#revision-alert').html(`Catatan: ${response.revision}`)

        if (statusId === 8) {
            $('#div-revision-alert').hide();
        }

        $.each(response['document'], function (j, item) {
            if (item.file_type == 1) {
                oldKtpFilePath = `${apiUrl}/${item.file_path}`;
                $('#file_ktp').attr('href', oldKtpFilePath);
                $('#file_ktp').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> KTP</span> ');
            } else if (item.file_type == 2) {
                oldStrFilePath = `${apiUrl}/${item.file_path}`;
                $('#file_str').attr('href', oldStrFilePath);
                $('#file_str').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> STR</span> ');
            } else {
                $('#file_sip').attr('href', `${apiUrl}/${item.file_path}`);
                $('#file_sip').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> SIP</span> ');
            }
        });

        if (profesiId == 1) {
            $('#option1').prop('checked', true);
            $('#option2').prop('checked', false);
            await getDataProfesi(1);
        } else {
            $('#option2').prop('checked', true);
            $('#option1').prop('checked', false);
            await getDataProfesi(2);
        }

        $('#kategori-profesi').val(kategoriProfesiId).change();

        await getBiayaKepesertaan(insuranceId); // Get the plans associated with this insurance

        await getDataKota();

        $('#daerah-penerbit-sip').val(daerahPenerbitId).change();

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

        populateTempatPraktikDetails(response)

        Swal.close()
    }).fail(function(error) {
        let data;
        try {
            // Attempt to parse the error response as JSON
            data = JSON.parse(error.responseText);
        } catch (e) {
            // If parsing fails, use a default error message
            data = { message: 'An unexpected error occurred' };
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
    resolve();  // Call resolve when done
});
}

// Function to dynamically populate tempatPraktikDetails from response
async function populateTempatPraktikDetails(response) {
    for (const item of response.praktik) {
        const id = item.id;
        const sipDocument = response.document.find(doc => doc.tempat_praktik_id === id && doc.file_type === 3);
        const sipURL = sipDocument ? sipDocument.file_path : '';

        let unggahSIPBase64 = '';
        if (sipURL) {
            try {
                unggahSIPBase64 = await urlToBase64(sipURL);
            } catch (error) {
                console.error('Gagal mengonversi file SIP ke Base64:', error);
            }
        }

        tempatPraktikDetails[id] = {
            sipId: item.id,
            nomorSIP: item.sip_no,
            periodeAwalSIP: item.sip_date_start,
            periodeAkhirSIP: item.sip_date_end,
            daerahPenerbitSIP_id: item.kota_id,
            daerahPenerbitSIP: item.sip_penerbit,
            namaPenerbitSIP: item.sip_penerbit_desc,
            tempat: item.tempat_praktik,
            unggahSIP: unggahSIPBase64
        };
    }
    renderTable();
}

async function urlToBase64(url) {
    const response = await fetch(url);
    const blob = await response.blob();
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(blob);
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
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-info mx-1 edit-detail" data-id="${id}"><i class="ti ti-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger mx-1 delete-row" data-id="${id}"><i class="ti ti-trash"></i> Hapus</button>
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
        var response = await decryptData(responses.data)
        var kategoriProfesi = $('#kategori-profesi');

        // Clear existing Choices.js instance if it exists
        if (kategoriProfesi.data('choices')) {
            kategoriProfesi.data('choices').destroy();
            kategoriProfesi.removeData('choices');
        }

        // Clear the select element before appending new options
        kategoriProfesi.empty();

        kategoriProfesi.append($('<option>', {
            value: '',
            text: "-- Pilih Kategori Profesi --"
        }));

        $.each(response.data, function(i, item) {
            kategoriProfesi.append($('<option>', {
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
        kategoriProfesi.data('choices', choices);

        kategoriProfesi.data('choices').setChoiceByValue(kategoriProfesiId.toString())

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
                                        <h5 class="h6" style="margin-bottom: 0;">Asuransi ${item.nama}</h5>
                                    </div>
                                </div>
                            </label>
                            <div class="text-center d-none d-sm-grid">
                                <h6 class="text-muted" style="margin-bottom: 0;">Asuransi<br>${item.nama}</h6>
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

        $(`#asuransi${insuranceId}`).prop('checked', true); // Ensure the insurance is checked

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
            profesi_id: profesiId,
            profesi_kategori_id: kategoriProfesiId,
            ins_id: ins_id
        }
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        // Clear the #biaya-kepesertaan element
        $('#biaya-kepesertaan').empty();

        // Determine the column class based on the number of items
        let colClass = response.data.length === 2 ? 'col-xl-6' : (response.data.length % 2 === 0 ? 'col-xl-3' : 'col-xl-4');

        // Populate planDetails object with response data
        $.each(response.data, function(i, item) {
            $('#biaya-kepesertaan').append(`
            <div class="col-12 col-md-6 col-lg-6 ${colClass} px-1">
                <div class="offer-check rounded p-2" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;">
                    <div class="form-check">
                    <input type="radio" name="plan" class="form-check-input input-primary" value="${item.id}" id="plan${item.id}" />
                    <label class="form-check-label d-block" for="plan${item.id}">
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

        $(`#plan${selectedPlan}`).prop('checked', true); // Ensure the plan is checked
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
            data = { message: 'An unexpected error occurred' };
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

async function handleupdateData() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    const fields = [
        { id: '#nama', message: 'Mohon masukan nama anda terlebih dahulu!' },
        { id: '#nik', message: 'Mohon masukan NIK anda terlebih dahulu!' },
        { id: '#tempat-lahir', message: 'Mohon masukan tempat lahir anda terlebih dahulu!' },
        { id: '#tanggal-lahir', message: 'Mohon masukan tanggal lahir anda terlebih dahulu!' },
        { id: '#jenis-kelamin', message: 'Mohon pilih jenis kelamin anda terlebih dahulu!' },
        { id: '#nomor-handphone', message: 'Mohon masukan nomor handphone anda terlebih dahulu!' },
        { id: '#email', message: 'Mohon masukan alamat email anda terlebih dahulu!' },
        { id: '#npwp', message: 'Mohon masukan npwp anda terlebih dahulu!' },
        { id: '#alamat', message: 'Mohon masukan domisili tempat tinggal anda terlebih dahulu!' },
        { id: '#nomor-str', message: 'Mohon masukan nomor STR anda terlebih dahulu!' },
        { id: '#kategori-profesi', message: 'Mohon pilih kategori profesi anda terlebih dahulu!' },
    ];

    for (const field of fields) {
        if ($(field.id).val() === '' || $(field.id).val() == null) {
            await Swal.fire({
                icon: "error",
                text: field.message,
                allowOutsideClick: false,
            });
            return;
        }
    }

    let kontakDarurat = $('#nama-kontak-darurat').val();
    let nomorDarurat = $('#nomor-kontak-darurat').val();

    if ((kontakDarurat && kontakDarurat !== '-') || (nomorDarurat && nomorDarurat !== '-')) {
        if (!kontakDarurat || kontakDarurat === '-') {
            Swal.fire({
                icon: "error",
                text: 'Mohon masukan nama kontak darurat anda!',
                allowOutsideClick: false,
            });
            return;
        }
        if (!nomorDarurat || nomorDarurat === '-') {
            Swal.fire({
                icon: "error",
                text: 'Mohon masukan nomor darurat anda!',
                allowOutsideClick: false,
            });
            return;
        }
    }

    kontakDarurat = (kontakDarurat === '-' ? null : kontakDarurat);
    nomorDarurat = (nomorDarurat === '-' ? null : nomorDarurat);

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
        tempat_praktik_id: [],
        sip_no: [],
        sip_date_start: [],
        sip_date_end: [],
        sip_penerbit: [],
        sip_penerbit_desc: [],
        tempat_praktik: [],
        fileInputSIP: [],
        fileInputKTP: '',
        fileInputSTR: '',
    };

    // Ambil file KTP dan STR, fallback ke file lama jika tidak ada upload baru
    formData.fileInputKTP = await getBase64FileOrOld('#unggah-ktp', oldKtpFilePath);
    formData.fileInputSTR = await getBase64FileOrOld('#unggah-str', oldStrFilePath);

    await Promise.all(
        Object.values(tempatPraktikDetails).map(async (detail) => {
            formData.tempat_praktik_id.push(detail.sipId);
            formData.sip_no.push(detail.nomorSIP);
            formData.sip_date_start.push(detail.periodeAwalSIP);
            formData.sip_date_end.push(detail.periodeAkhirSIP);
            formData.sip_penerbit.push(detail.daerahPenerbitSIP_id);
            formData.sip_penerbit_desc.push(detail.daerahPenerbitSIP_id === "0" ? detail.namaPenerbitSIP : "0");
            formData.tempat_praktik.push(detail.tempat);
            formData.fileInputSIP.push(detail.unggahSIP ? detail.unggahSIP : null);
        })
    );

    const formDataString = JSON.stringify(formData);

    console.log(formDataString);
    const encryptedData = await encryptData(formDataString);

    const form = new FormData();
    form.append("data", encryptedData);

    // Ambil token dari cookie
    const cookie = document.cookie.split('; ').find(row => row.startsWith('piat='));
    const token = cookie ? cookie.split('=')[1] : null;

    $.ajax({
        async: true,
        url: `${apiUrl}/api/client/renewal/insert`,
        method: "POST",
        processData: false,
        contentType: false,
        mimeType: "multipart/form-data",
        data: form,
        headers: {
            "Authorization": `Bearer ${token}`
        },
    })
    .done(async function (responses) {
        const response = JSON.parse(responses);

        if (response.status === 200) {
            const data = await decryptData(response.data);
            await Swal.fire({
                icon: 'success',
                title: data.data,
                html: "Silakan periksa email Anda untuk informasi dan instruksi selanjutnya. <br><br> <small>Anda akan dialihkan ke halaman berikutnya dalam <b></b> detik</small>",
                timer: 10000,
                timerProgressBar: true,
                showConfirmButton: true,
                allowOutsideClick: false,
                didOpen: () => {
                    const timer = Swal.getPopup().querySelector("b");
                    const timerInterval = setInterval(() => {
                        timer.textContent = `${Math.ceil(Swal.getTimerLeft() / 1000)}`;
                    }, 100);
                }
            }).then(() => {
                $('#div-renewal').hide();
                $('#div-renewal-success').show();
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: response.message || 'Terjadi kesalahan',
                showConfirmButton: false,
                allowOutsideClick: false,
            });
        }
    }).fail(function(error) {
        let message = 'Terjadi kesalahan saat mengirim data. Silakan coba lagi nanti.';
        try {
            const data = JSON.parse(error.responseText);
            message = data.message || message;
        } catch {}

        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
            allowOutsideClick: false,
        });
    });
}

async function getBase64FileOrOld(fileInputSelector, oldFilePath) {
    const fileElement = $(fileInputSelector)[0].files[0];
    if (fileElement) {
        return await new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => resolve(e.target.result);
            reader.onerror = reject;
            reader.readAsDataURL(fileElement);
        });
    } else if (oldFilePath) {
        try {
            return await urlToBase64(oldFilePath);
        } catch (error) {
            console.error('Gagal konversi file lama ke Base64:', error);
            return '';
        }
    }
    return '';
}

function generateRandomId(length = 10) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
}

async function getDataDashboard() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    // Get the token from the 'piat' cookie
    const token = document.cookie.split('; ').find(row => row.startsWith('piat=')).split('=')[1];

    $.ajax({
        url: `${apiUrl}/api/client/dashboard`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${token}`
        },
    }).done(async function(responses) {
        var response = await decryptData(responses.data)
        console.log(response);
        $.each(response['policy'], function(j, item) {
            if (item.polis_exp == 1 || item.polis_exp == null) {
                $('#div-polis-alert').show();
                    let alertClass = 'alert-success';
                    let alertText = "Perpanjangan polis belum dapat dilakukan saat ini karena polis Anda masih dalam masa aktif. Untuk memastikan kelancaran proses perpanjangan, pengajuan dapat dilakukan paling cepat H-30 sebelum tanggal kedaluwarsa polis.";
                $('#div-polis-alert').removeClass('alert-danger alert-warning').addClass(alertClass);
                $('#polis-alert').text(alertText);
                $('#div-renewal-form').hide();
                $('#nomor-register').hide();
            } else if (item.polis_exp == 2) {
                $('#div-polis-alert').show();
                    let alertClass = 'alert-warning';
                    let alertText = "Mohon diperhatikan bahwa polis Anda telah berakhir. Anda dapat melakukan perpanjangan dengan segera untuk memastikan perlindungan tetap aktif. Silakan mengisi formulir di bawah ini untuk melanjutkan proses perpanjangan.";
                $('#div-polis-alert').removeClass('alert-danger alert-warning').addClass(alertClass);
                $('#polis-alert').text(alertText);
            }
        });

        $.each(response['info'], function(j, item) {
        });

        Swal.close()
    }).fail(function(response) {
        if (response.status === 404) {
            Swal.fire({
                title: 'Error!',
                text: 'Request tidak ditemukan.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        } else if (response.status === 401) {
            Swal.fire({
                title: 'Error!',
                text: 'Sesi Anda telah habis. Silakan login kembali.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            }).then(function() {
                window.location.href = loginUrl;
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'Terjadi kesalahan. Silakan coba lagi.',
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        }
    });
}
