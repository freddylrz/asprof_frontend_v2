import { decryptData, encryptData } from "../encrypt.js";
const planDetails = {}; // Initialize planDetails object
var tempatPraktikDetails = {}; // Initialize tempatPraktikDetails object
var id;
var selectedPlan;
var kategoriProfesiId;
var profesiId;
var daerahPenerbitId;
var insuranceId;
// SIP Counter for dynamic card IDs
let sipCounter = 0;
let existingSipCounter = 1000; // Start from a high number to avoid conflicts with existing IDs
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
    var periodeAwalSTRContainer = $("#periode-awal-str-container"); // Corrected ID
    var profesiSelect = $('#profesi'); // Changed from radio buttons to select
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
    // Get reqId from the global variable
    var reqId = window.reqId;
    // Get today's date
    const today = new Date();
    // Disable dates after today for 'tanggal-lahir', 'periode-awal-str'
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
    // Disable dates before today for 'periode-akhir-str'
    new Datepicker(document.querySelector('#periode-akhir-str'), {
        buttonClass: 'btn',
        format: 'dd-mm-yyyy',
        minDate: today
    });
    // Call the function with the reqId
    executeFunctions(reqId);
    // Set initial Profesi value and trigger change
    profesiSelect.val('1').trigger('change');
    profesiSelect.on("change", function() {
        $('input[name="asuransi"]').prop('checked', false);
        $('#div-biaya-kepesertaan').hide();
        const selectedProfesiId = $(this).val();
        if (selectedProfesiId) {
            getDataProfesi(selectedProfesiId);
        }
    });
    kategoriProfesi.on("change", function() {
        $('input[name="asuransi"]').prop('checked', false);
        $('#div-biaya-kepesertaan').hide();
    });
    expSTRCheckbox.on("change", function() {
        if ($(this).is(":checked")) {
            periodeAkhirSTRContainer.hide();
            periodeAwalSTRContainer.show(); // Show Periode Awal STR
        } else {
            periodeAkhirSTRContainer.show();
            periodeAwalSTRContainer.hide(); // Hide Periode Awal STR
        }
    });
    // SIP Card Management
    $('#btn-tambah-sip').on('click', function () {
        // Create a new SIP card with empty data
        const newSIPData = {
            id: 'new_' + Date.now(), // Unique ID for new cards
            nomorSIP: '',
            periodeAwalSIP: '',
            periodeAkhirSIP: '',
            daerahPenerbitSIP_id: '',
            daerahPenerbitSIP: '',
            namaPenerbitSIP: '',
            tempat: '',
            unggahSIP: null,
            unggahSIPPreview: null
        };
        appendSIPCard(newSIPData);
    });

    // Event delegation for SIP card actions (Delete only, no Edit)
    $('#sip-cards-container').on('click', '.btn-hapus-sip', function () {
        const cardId = $(this).closest('.sip-card').data('id');
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
                // If it's an existing SIP (has a numeric ID from API), mark for deletion
                if (!isNaN(cardId) && tempatPraktikDetails[cardId]) {
                    // Mark for deletion on submit
                    tempatPraktikDetails[cardId].deleted = true;
                }
                $(`#sip-card-${cardId}`).remove();
                updateTambahButtonVisibility();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data SIP berhasil dihapus!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });

    // Handle file upload preview
    $(document).on('change', '.unggah-sip', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            const imgElement = $(this).closest('.card').find('.sip-image');

            reader.onload = function(e) {
                imgElement.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    // Handle nama penerbit visibility
    $(document).on('input', '.penerbit', function() {
        const card = $(this).closest('.sip-card');
        const namaPenerbitRow = card.find('.nama-penerbit-row');
        const namaPenerbitInput = card.find('.nama-penerbit');

        if ($(this).val().trim() !== '') {
            namaPenerbitRow.show();
            namaPenerbitInput.attr('required', 'required');
        } else {
            namaPenerbitRow.hide();
            namaPenerbitInput.removeAttr('required');
            namaPenerbitInput.val('');
        }
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
        e.preventDefault();
        await Swal.fire({
            icon: 'warning',
            html: 'Dengan melanjutkan, saya menyatakan bahwa data yang saya berikan adalah benar dan akurat. Saya memahami bahwa ketidakakuratan atau kesalahan dalam data yang diberikan dapat menjadi kendala proses klaim. <br><br> Lanjutkan proses memperbaiki data?',
            showDenyButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            denyButtonText: `Batal`,
        }).then((result) => {
            if (result.isConfirmed) {
                handleupdateData(reqId);
            } else if (result.isDenied) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Perubahan tidak disimpan',
                    showConfirmButton: true,
                });
            }
        });
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

function appendSIPCard(sipData) {
    sipCounter++;
    const cardId = sipData.id;
    const namaPenerbitRowStyle = sipData.namaPenerbitSIP ? '' : 'style="display: none;"';

    const cardHtml = `
        <div class="card border border-danger sip-card" id="sip-card-${cardId}" data-id="${cardId}">
            <div class="card-header bg-danger">
                <h4 class="text-white mb-0"><i class="ti ti-building-hospital me-1"></i>Surat Izin Praktik</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label required">Nomor SIP</label>
                            <input type="text" class="form-control sip-nomor"
                                   name="sip[${cardId}][nomorSIP]" value="${sipData.nomorSIP || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Periode Awal SIP</label>
                            <div class="input-group date mb-3">
                                <input type="text" class="form-control periode-awal datepicker-bs5-sip"
                                       name="sip[${cardId}][periodeAwalSIP]" data-date-format="dd-mm-yyyy" value="${sipData.periodeAwalSIP || ''}">
                                <span class="input-group-text">
                                    <i class="feather icon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Periode Akhir SIP</label>
                            <div class="input-group date mb-3">
                                <input type="text" class="form-control periode-akhir datepicker-bs5-sip"
                                       name="sip[${cardId}][periodeAkhirSIP]" data-date-format="dd-mm-yyyy" value="${sipData.periodeAkhirSIP || ''}">
                                <span class="input-group-text">
                                    <i class="feather icon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Daerah Penerbit SIP</label>
                            <select class="form-select daerah-penerbit-select"
                                    name="sip[${cardId}][daerahPenerbitSIP]"
                                    id="daerah-penerbit-sip-${cardId}">
                                <option value="">-- Pilih Kota/Kabupaten --</option>
                            </select>
                        </div>
                        <div class="mb-3 nama-penerbit-row" ${namaPenerbitRowStyle}>
                            <label class="form-label">Nama Penerbit SIP</label>
                            <input type="text" class="form-control nama-penerbit"
                                   name="sip[${cardId}][namaPenerbitSIP]" value="${sipData.namaPenerbitSIP || ''}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tempat Praktik</label>
                            <input type="text" class="form-control tempat-praktik"
                                   name="sip[${cardId}][tempat]" value="${sipData.tempat || ''}">
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <p><strong>Foto Surat Izin Praktik</strong></p>
                        <img src="${sipData.unggahSIPPreview || (sipData.unggahSIP ? (typeof sipData.unggahSIP === 'string' ? sipData.unggahSIP : URL.createObjectURL(sipData.unggahSIP)) : '/assets/images/no-image.png')}"
                             alt="Foto SIP" class="img-fluid sip-image" style="max-height: 200px;">
                        <input type="file" class="form-control mt-2 unggah-sip"
                               name="sip[${cardId}][unggahSIP]" accept=".jpg, .jpeg, .png">
                        <input type="hidden" name="sip[${cardId}][existingImage]" value="${sipData.unggahSIP || ''}">
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-danger btn-hapus-sip">
                    <i class="ti ti-trash"></i> Hapus
                </button>
            </div>
        </div>
    `;
    $('#sip-cards-container').append(cardHtml);

    const newCard = $(`#sip-card-${cardId}`);
    const daerahSelect = newCard.find(`#daerah-penerbit-sip-${cardId}`)[0];

    // Inisialisasi datepickers
    const today = new Date();
    const periodeAwalInput = newCard.find('.periode-awal.datepicker-bs5-sip')[0];
    const periodeAkhirInput = newCard.find('.periode-akhir.datepicker-bs5-sip')[0];

    if (periodeAwalInput) {
        new Datepicker(periodeAwalInput, {
            buttonClass: 'btn',
            format: 'dd-mm-yyyy',
            maxDate: today
        });
        if (sipData.periodeAwalSIP) {
            periodeAwalInput.value = sipData.periodeAwalSIP;
        }
    }

    if (periodeAkhirInput) {
        new Datepicker(periodeAkhirInput, {
            buttonClass: 'btn',
            format: 'dd-mm-yyyy',
            minDate: today
        });
        if (sipData.periodeAkhirSIP) {
            periodeAkhirInput.value = sipData.periodeAkhirSIP;
        }
    }

    // Inisialisasi Choices.js untuk daerah penerbit
    if (daerahSelect) {
        const choicesInstance = new Choices(daerahSelect, {
            itemSelectText: '',
            searchPlaceholderValue: 'Cari Kota/Kabupaten',
            shouldSort: false,
            removeItemButton: true
        });

        // Simpan instance Choices ke DOM element
        $(daerahSelect).data('choices', choicesInstance);

        // Load data kota dan isi ke select dengan auto-select berdasarkan daerahPenerbitSIP_id
        loadCityDataForSelect(choicesInstance, sipData.daerahPenerbitSIP_id);
    }

    updateTambahButtonVisibility();
}

// Fungsi untuk load data kota dan mengisi select dengan auto-selection
function loadCityDataForSelect(choicesInstance, selectedKotaId = null) {
    // Jika data kota sudah ada di memory, gunakan itu
    if (window.cityData && window.cityData.length > 0) {
        const cityOptions = window.cityData.map(item => ({
            value: item.id,
            label: item.name
        }));
        choicesInstance.setChoices(cityOptions, 'value', 'label', false);

        // Set selected value jika ada kota_id
        if (selectedKotaId) {
            choicesInstance.setChoiceByValue(selectedKotaId.toString());
        }
        return;
    }

    // Jika belum ada, load dari API
    $.ajax({
        url: `${apiUrl}/api/client/request/get-data-kota`,
        method: "GET",
        timeout: 0,
    }).done(async function(responses) {
        var response = await decryptData(responses.data);

        // Simpan data kota ke memory
        window.cityData = response.data;

        // Format untuk Choices.js
        const cityOptions = response.data.map(item => ({
            value: item.id,
            label: item.name
        }));

        // Set choices
        choicesInstance.setChoices(cityOptions, 'value', 'label', false);

        // Set selected value jika ada kota_id
        if (selectedKotaId) {
            choicesInstance.setChoiceByValue(selectedKotaId.toString());
        }
    }).fail(function(error) {
        let data;
        try {
            data = JSON.parse(error.responseText);
        } catch (e) {
            data = { message: 'Gagal memuat data kota' };
        }
        const message = data.message || 'Gagal memuat data kota';
        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
        });
    });
}

// Function to update the visibility of the "Tambah SIP" button
function updateTambahButtonVisibility() {
    // Always show the button
    $('#btn-tambah-sip').show();
}
async function executeFunctions(reqId) {
    if (reqId !== null && reqId !== undefined) {
        // Initial render for SIP container (empty)
        updateTambahButtonVisibility();
        await getDataDetail(reqId);
    } else {
        window.location.href = '/pendaftaran';
    }
}
function getDataDetail(reqId) {
    return new Promise((resolve, reject) => {
        Swal.fire({
            icon: "info",
            text: "loading",
            showConfirmButton: false,
            allowOutsideClick: false,
        });
        $.ajax({
            "url": `${apiUrl}/api/client/request/detail`,
            "method": "GET",
            "timeout": 0,
            "data": {
                "reqId": reqId
            },
        }).done(async function(responses) {
            var response = await decryptData(responses.data);
            console.log(response);

            let shouldRedirect = false;
            var statusId;
            $.each(response['data'], function(j, item) {
                if (item.status_id != 3 && item.status_id != 8) {
                    shouldRedirect = true;
                    return false; // Break the loop
                }
                id = item.id;
                profesiId = item.profesi_id;
                kategoriProfesiId = item.profesi_kategori_id;
                selectedPlan = item.plan_id;
                daerahPenerbitId = item.sip_penerbit;
                statusId = item.status_id;
                insuranceId = item.ins_id;
                $('#nomor-register').html(item.register_no);
                $('#nama').val(item.nama);
                $('#nik').val(item.nik);
                $('#tempat-lahir').val(item.tempat_lahir);
                $('#tanggal-lahir').val(item.tanggal_lahir);
                $('#email').val(item.email);
                $('#jenis-kelamin').val(item.jenis_kelamin).change();
                $('#nomor-handphone').val(item.no_hp);
                $('#npwp').val(item.npwp);
                $('#alamat').val(item.alamat);
                $('#nama-kontak-darurat').val(item.kontak_darurat);
                $('#nomor-kontak-darurat').val(item.nomor_darurat);
                if (item.str_stat == '1') {
                    $('#status-str').prop('checked', true);
                    $('#periode-awal-str').val(item.str_date_start);
                    $("#periode-akhir-str-container").hide();
                    $("#periode-awal-str-container").show();
                } else {
                    $('#status-str').prop('checked', false);
                    $('#periode-akhir-str').val(item.str_date_end);
                    $("#periode-akhir-str-container").show();
                    $("#periode-awal-str-container").hide();
                }
                $('#nomor-str').val(item.str_no);
                // sip_no, sip_date_start, sip_date_end are now handled by cards
                $('#premi-tahunan').text(item.premi);
                $('#jaminan-pertanggungan').text(item.sum_insured);
            });
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
            $('#revision-alert').html(`Catatan: ${response.revision}`);
            if (statusId === 8) {
                $('#div-revision-alert').hide();
            }
            $.each(response['document'], function(j, item) {
                if (item.file_type == 1) {
                    $('#file_ktp').attr('href', item.link);
                    $('#file_ktp').html('<i class="ti ti-file"></i> <span class="d-none d-md-inline"> KTP</span>');
                } else if (item.file_type == 2) {
                    // Handle STR document if needed in UI
                } else {
                    // Handle SIP documents - these are now handled by cards
                }
            });
            // Set Profesi Select
            $('#profesi').val(profesiId).trigger('change');
            // getDataProfesi will be called by the change event handler above
            // Note: kategori-profesi will be set after getDataProfesi completes
            await getBiayaKepesertaan(insuranceId); // Get the plans associated with this insurance
            await getDataKota();
            // Note: daerah-penerbit-sip will be set after getDataKota completes
            if (shouldRedirect) {
                window.location.href = `/detail/${reqId}`;
                return;
            }
            $('#list-log').html('');
            $.each(response['log'], function(j, item) {
                $('#list-log').append(`
                    <li key="${j+1}">
                    <i class="feather icon-check f-w-600 task-icon bg-success"></i>
                    <p class="m-b-5">${item.created_at}</p>
                    <p class="text-muted m-b-5 h3">${item.status_desc}</p>
                    <p class="m-b-5 h6">${item.description}</p>
                    </li>
                `);
            });
            populateTempatPraktikDetails(response); // This will populate cards
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
        resolve();
    });
}
// Function to dynamically populate tempatPraktikDetails from response and create cards
function populateTempatPraktikDetails(response) {
    tempatPraktikDetails = {}; // Reset
    $('#sip-cards-container').empty(); // Clear existing cards
    response.praktik.forEach((item) => {
        const id = item.id;
        const sipDocument = response.document.find(doc => doc.tempat_praktik_id === id && doc.file_type === 3);
        const sipURL = sipDocument ? sipDocument.link : '';
        // Store in tempatPraktikDetails for reference (e.g., editing existing)
        tempatPraktikDetails[id] = {
            id: id,
            nomorSIP: item.sip_no,
            periodeAwalSIP: item.sip_date_start,
            periodeAkhirSIP: item.sip_date_end,
            daerahPenerbitSIP_id: item.kota_id,
            daerahPenerbitSIP: item.sip_penerbit,
            namaPenerbitSIP: item.sip_penerbit_desc,
            tempat: item.tempat_praktik,
            unggahSIP: sipURL, // URL string for existing
            deleted: false // Flag to track deletions
        };
        // Create card for existing SIP
        appendSIPCard(tempatPraktikDetails[id]);
    });
    updateTambahButtonVisibility();
}
function getDataProfesi(profesi_id) {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });
    return $.ajax({
        url: `${apiUrl}/api/client/request/get-data-profesi`,
        method: "GET",
        dataType: 'json',
        timeout: 0,
        data: {
            type: 1,
            profesi_id: profesi_id
        }
    }).done(async function(responses) {
        var response = await decryptData(responses.data);
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
        // Set the value *after* Choices.js is initialized
        if (kategoriProfesiId) {
             kategoriProfesi.data('choices').setChoiceByValue(kategoriProfesiId.toString());
        }
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
            `);
        });
        $('input[type=radio][name=asuransi]').on("change", function() {
            if ($(this).is(":checked")) {
                getBiayaKepesertaan($('input[name="asuransi"]:checked').val());
            }
        });
        if (insuranceId) {
            $(`#asuransi${insuranceId}`).prop('checked', true); // Ensure the insurance is checked
        }
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
        var response = await decryptData(responses.data);
        // Clear the #biaya-kepesertaan element
        $('#biaya-kepesertaan').empty();
        // Determine the column class based on the number of items
        let colClass = response.data.length % 2 === 0 ? 'col-xl-3' : 'col-xl-4';
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
            `);
        });
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        if (selectedPlan) {
            $(`#plan${selectedPlan}`).prop('checked', true); // Ensure the plan is checked
        }
        $('#div-biaya-kepesertaan').show();
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
        const message = data.message || 'An unexpected error occurred';
        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
        });
    });
}
function getDataKota() {
    return $.ajax({
        url: `${apiUrl}/api/client/request/get-data-kota`,
        method: "GET",
        timeout: 0,
    }).done(async function(responses) {
        var response = await decryptData(responses.data);
        window.cityData = response.data; // Simpan ke memory
        Swal.close();
    }).fail(function(error) {
        let data;
        try {
            data = JSON.parse(error.responseText);
        } catch (e) {
            data = { message: 'Gagal memuat data kota' };
        }
        const message = data.message || 'Gagal memuat data kota';
        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true,
        });
    });
}

async function handleupdateData(reqId) {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    // Validasi Tab 2
    const fieldsTab2 = [
        { id: '#nama', message: 'Mohon masukan nama anda terlebih dahulu!' },
        { id: '#nik', message: 'Mohon masukan NIK anda terlebih dahulu!' },
        { id: '#tempat-lahir', message: 'Mohon masukan tempat lahir anda terlebih dahulu!' },
        { id: '#tanggal-lahir', message: 'Mohon masukan tanggal lahir anda terlebih dahulu!' },
        { id: '#jenis-kelamin', message: 'Mohon pilih jenis kelamin anda terlebih dahulu!' },
        { id: '#nomor-handphone', message: 'Mohon masukan nomor handphone anda terlebih dahulu!' },
        { id: '#email', message: 'Mohon masukan alamat email anda terlebih dahulu!' },
        { id: '#npwp', message: 'Mohon masukan npwp anda terlebih dahulu!' },
        { id: '#alamat', message: 'Mohon masukan domisili tempat tinggal anda terlebih dahulu!' },
    ];
    // Validasi Tab 1
    const fieldsTab1 = [
        { id: '#nomor-str', message: 'Mohon masukan nomor STR anda terlebih dahulu!' },
        { id: '#kategori-profesi', message: 'Mohon pilih kategori profesi anda terlebih dahulu!' },
        { id: '#profesi', message: 'Mohon pilih profesi anda terlebih dahulu!' },
    ];

    for (const field of fieldsTab2) {
        if (!$(field.id).val()) {
            await Swal.fire({ icon: "error", text: field.message });
            change_tab('#auth-2');
            $(field.id).focus();
            return;
        }
    }
    for (const field of fieldsTab1) {
        if (!$(field.id).val()) {
            await Swal.fire({ icon: "error", text: field.message });
            change_tab('#auth-1');
            $(field.id).focus();
            return;
        }
    }

    let kontakDarurat = $('#nama-kontak-darurat').val();
    let nomorDarurat = $('#nomor-kontak-darurat').val();
    if ((kontakDarurat && kontakDarurat !== '-') || (nomorDarurat && nomorDarurat !== '-')) {
        if (!kontakDarurat || kontakDarurat === '-') {
            Swal.fire({ icon: "error", text: 'Mohon masukan nama kontak darurat anda!' });
            change_tab('#auth-2');
            $('#nama-kontak-darurat').focus();
            return;
        }
        if (!nomorDarurat || nomorDarurat === '-') {
            Swal.fire({ icon: "error", text: 'Mohon masukan nomor darurat anda!' });
            change_tab('#auth-2');
            $('#nomor-kontak-darurat').focus();
            return;
        }
    }

    if (!$('input[name="asuransi"]:checked').val()) {
        await Swal.fire({ icon: "error", text: 'Mohon pilih asuransi terlebih dahulu!' });
        change_tab('#auth-3');
        return;
    }
    if (!$('input[name="plan"]:checked').val()) {
        await Swal.fire({ icon: "error", text: 'Mohon pilih plan terlebih dahulu!' });
        change_tab('#auth-3');
        return;
    }

    // Helper: File to Base64
    function fileToBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result.split(',')[1]); // Hapus prefix data URL
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }

    // Siapkan data form utama
    const formData = {
        reqId: reqId,
        nama: $('#nama').val(),
        nik: $('#nik').val(),
        tempat_lahir: $('#tempat-lahir').val(),
        tanggal_lahir: $('#tanggal-lahir').val(),
        jenis_kelamin: $('#jenis-kelamin').val(),
        email: $('#email').val(),
        alamat: $('#alamat').val(),
        npwp: $('#npwp').val(),
        no_hp: $('#nomor-handphone').val(),
        kontak_darurat: kontakDarurat === '-' ? "" : (kontakDarurat || ""),
        nomor_darurat: nomorDarurat === '-' ? "" : (nomorDarurat || ""),
        profesi_id: $('#profesi').val(),
        profesi_kategori_id: $('#kategori-profesi').val(),
        str_no: $('#nomor-str').val(),
        str_stat: $('#status-str').is(':checked') ? 1 : 0,
        str_date_start: $('#status-str').is(':checked') ? $('#periode-awal-str').val() : "",
        str_date_end: $('#status-str').is(':checked') ? "" : $('#periode-akhir-str').val(),
        ins_id: $('input[name="asuransi"]:checked').val(),
        plan_id: $('input[name="plan"]:checked').val(),
        fileInputKTP: "",
        fileInputSTR: "",
        sip: []
    };

    // Proses file KTP & STR
    const ktpFile = $('#unggah-ktp')[0].files[0];
    const strFile = $('#unggah-str')[0].files[0];
    if (ktpFile) formData.fileInputKTP = await fileToBase64(ktpFile);
    if (strFile) formData.fileInputSTR = await fileToBase64(strFile);

    // Proses data SIP dari card
    $('.sip-card').each(async function () {
        const cardId = $(this).data('id');
        const isExisting = !isNaN(cardId) && tempatPraktikDetails[cardId];
        const isNew = cardId.toString().startsWith('new_');
        let sipEntry = null;

        if (isExisting && !tempatPraktikDetails[cardId].deleted) {
            // SIP yang ada dan tidak ditandai dihapus
            sipEntry = {
                sip_id: tempatPraktikDetails[cardId].id,
                sip_no: tempatPraktikDetails[cardId].nomorSIP,
                sip_date_start: tempatPraktikDetails[cardId].periodeAwalSIP,
                sip_date_end: tempatPraktikDetails[cardId].periodeAkhirSIP,
                tempat_praktik: tempatPraktikDetails[cardId].tempat,
                sip_penerbit: tempatPraktikDetails[cardId].daerahPenerbitSIP_id,
                sip_penerbit_desc: tempatPraktikDetails[cardId].namaPenerbitSIP || '',
                fileInputSIP: ""
            };
            // Cek jika file baru diunggah untuk SIP yang ada
            const file = $(this).find('.unggah-sip')[0].files[0];
            if (file) sipEntry.fileInputSIP = await fileToBase64(file);
            // Jika tidak ada file baru, kirim string kosong (tidak mengubah file di server)
            else sipEntry.fileInputSIP = "";
        } else if (isNew) {
            // SIP baru
            sipEntry = {
                sip_id: "0",
                sip_no: $(this).find('.sip-nomor').val(),
                sip_date_start: $(this).find('.periode-awal').val(),
                sip_date_end: $(this).find('.periode-akhir').val(),
                tempat_praktik: $(this).find('.tempat-praktik').val(),
                sip_penerbit: $(this).find('.daerah-penerbit-select').val(), // Ambil dari select
                sip_penerbit_desc: $(this).find('.nama-penerbit').val() || '',
                fileInputSIP: ""
            };
            const file = $(this).find('.unggah-sip')[0].files[0];
            if (file) sipEntry.fileInputSIP = await fileToBase64(file);
        }

        if (sipEntry) {
            // Validasi: SIP baru harus unggah file
            if (sipEntry.sip_id === "0" && !sipEntry.fileInputSIP) {
                Swal.fire({ icon: "error", text: "File SIP harus diunggah untuk SIP baru." });
                // Hentikan iterasi dan fungsi jika validasi gagal
                throw new Error("File SIP baru tidak diunggah");
            }
            formData.sip.push(sipEntry);
        }
    });

    // Tambahkan ID SIP yang dihapus
    const deletedSipIds = [];
    for (const id in tempatPraktikDetails) {
        if (tempatPraktikDetails[id].deleted) {
            deletedSipIds.push(id);
        }
    }
    formData.deleted_sip_ids = JSON.stringify(deletedSipIds);

    // Enkripsi data sebelum dikirim
    const encryptedData = await encryptData(JSON.stringify(formData));

    // Kirim ke Backend
    $.ajax({
        url: `${apiUrl}/api/client/request/update-confirmation`,
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify({ data: encryptedData }), // Bungkus dalam objek dengan key 'data'
    })
    .done(async function (apiResponse) { // apiResponse adalah objek JSON yang diterima dari server
        // console.log("Raw API Response:", apiResponse); // Untuk debugging

        if (apiResponse && apiResponse.status === 200) {
            try {
                // Dekripsi data dari API
                const decryptedData = await decryptData(apiResponse.data);
                console.log("Decrypted Data:", decryptedData); // Untuk debugging

                // Tampilkan sukses dan redirect
                await Swal.fire({
                    icon: 'success',
                    title: decryptedData.data || 'Data berhasil diperbarui!',
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
                        Swal.getPopup().addEventListener('swal-close', () => {
                            clearInterval(timerInterval);
                        });
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer || result.isConfirmed) {
                        if (decryptedData.id) {
                            window.location.replace(`/detail/${decryptedData.id}`);
                        } else {
                            console.error("Redirect ID not found in decrypted data:", decryptedData);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Mengalihkan',
                                text: 'Gagal menemukan ID untuk pengalihan halaman.',
                                showConfirmButton: true,
                            });
                        }
                    }
                });

            } catch (decryptError) {
                console.error("Error decrypting data:", decryptError);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mendekripsi',
                    text: 'Terjadi kesalahan saat mendekripsi data dari server.',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                });
            }
        } else {
            // Tangani error dari API (status bukan 200)
            const errorMessage = apiResponse?.message || apiResponse?.data || 'Terjadi kesalahan tidak dikenal.';
            Swal.fire({
                icon: 'warning',
                title: 'Gagal Memperbarui',
                text: errorMessage,
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    })
    .fail(function (jqXHR, textStatus, errorThrown) { // Tangani error jaringan atau HTTP
        console.error("AJAX request failed:", textStatus, errorThrown, jqXHR);
        let message = 'Terjadi kesalahan jaringan atau server.';
        try {
            // Coba dapatkan pesan error dari response API
            const errorResponse = JSON.parse(jqXHR.responseText);
            message = errorResponse?.message || errorResponse?.data || message;
        } catch (e) {
            // Jika parsing gagal, gunakan pesan generik atau status text
            if (jqXHR.statusText) {
                 message = `Error ${jqXHR.status}: ${jqXHR.statusText}`;
            }
            console.error("Failed to parse error response:", e);
        }
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan Permintaan',
            text: message,
            showConfirmButton: true,
            allowOutsideClick: false,
        });
    });
}

