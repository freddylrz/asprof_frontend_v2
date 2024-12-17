import {
    decryptData,
    encryptData,
    getAccessTokenFromCookies
} from "../encrypt.js";

let token;
let searchParams = new URLSearchParams(window.location.search)
var batchId = searchParams.get('batchId')
$(document).ready(async function () {
    token = await getAccessTokenFromCookies();

    getData();
});

$('#cari').on('click', function () {
    getData()
})

function getData() {
    $.ajax({
        "url": base_url.concat('/api/client-admin/request/detail-list'),
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + token
        },
        "data" : {
            "bacthId" : batchId
        }
    }).done(async function (responses) {
        var response = await decryptData(responses['data'])
        var status = response['batch'][0]['request_status_id']

        console.log(response)
        if ($.fn.DataTable.isDataTable('#table')) {
            $('#table').DataTable().clear().destroy(); // Bersihkan dan hancurkan instance DataTable
        }
        if (status == 7) {
            $('#table').find('thead').remove();
            $('#table').html(`
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Register</th>
                    <th>Nama</th>
                    <th>Profesi</th>
                    <th>Kategori Profesi</th>
                    <th>No STR</th>
                    <th>Premi</th>
                    <th>Sum Insured</th>
                    <th id="colCheckbox">
                        <div class="form-inline">
                            <input style="vertical-align: super; margin-right: 10px" type="checkbox" checked id="check" class="">
                            <label for="check">Select All /<br>Deselect All</label>
                        </div>
                    </th>
                    <th></th>
                </tr>
            </thead>
        `);
        }
// Definisikan kolom default
        let columns = [
            {
                "data": "reqId",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"data": "register_no"},
            {"data": "nama"},
            {"data": "profesi"},
            {"data": "profesi_kategori"},
            {"data": "str_no"},
            {"data": "premi"},
            {"data": "sum_insured"},
        ];

// Tambahkan kolom checkbox hanya jika status == 7
        if (status == 7) {
            columns.push({
                "data": "reqId",
                className: "text-center",
                render: function (data, type, row, meta) {
                    return `<input type="checkbox" name="reqId" checked class="form-check reqId" value="${data}">`;
                }
            });
        }

// Tambahkan kolom aksi (selalu ada)
//         columns.push({
//             "data": "reqId",
//             className: "text-center",
//             render: function (data, type, row, meta) {
//                 return `
//             <a class="btn btn-info btn-xs btnDetail" id="detail" style="margin-right: 10px" href="/admin/detail?id=${data}">
//                 <i class="fa fa-eye"></i>
//             </a>
//         `;
//             }
//         });
        columns.push({
            "data": "reqId",
            className: "text-center",
            render: function (data, type, row, meta) {
                return `
            <button class="btn btn-info btn-xs btnDetail" data-reqid="${data}">
                <i class="fa fa-eye"></i>
            </button>
        `;
            }
        });

// Inisialisasi DataTable
        $('#table').DataTable({
            processing: false,
            "pageLength": 25,
            "autoWidth": false,
            order: [],
            "scrollX": true,
            "bDestroy": true,
            "searching": true,
            data: response.list,
            "columns": columns, // Gunakan kolom yang sudah didefinisikan secara dinamis
        });


        $('#table_log').empty()
        $.each(response['batch'], function (j, item) {
            $('#list-log').append(`
                                <li>
                                <i class="feather icon-check f-w-600 task-icon bg-success"></i>
                                <p class="m-b-5">${item.created_at}</p>
                                <h5 class="text-muted">
                                    ${item.status_desc}</h5>
                                <h6 style="color: darkgrey">${item.description}</h6>
                                </li>
                        `)
            $('#table_log').append(`
                            <tr>
                                <td style="font-size: 18px">${j + 1}</td>
                                <td style="font-size: 18px">${item.status_desc}</td>
                                <td style="font-size: 18px">${item.description}</td>
                                <td style="font-size: 18px">${item.created_at}</td>
                            </tr>
                        `)
        })

        Swal.close();
    })
}

$(document).on('click', '.btnDetail', async function () {
    var reqId = $(this).data('reqid')

    await getDataDetail(reqId)
    $('#modal-detail').modal('show')
})

var str,sip =[],ktp, detail
function getDataDetail(reqId){
    Swal.fire({
        icon: "info",
        text: "Loading...",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        "url": base_url.concat('/api/client-admin/request/detail-data'),
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + token
        },
        "data": {
            "reqId": reqId
        },
    }).done(async function (responses) {
        var response = await decryptData(responses['data'])
        detail = response
        var statusId;
        $.each(response['data'], function (j, item) {
            statusId = item.status_id;
            $('#register_no').html(item.register_no)
            $('#nama').html(item.nama)
            $('#nik').html(item.nik)
            $('#ttl').html(item.tanggal_lahir)
            $('#email').html(item.email)
            $('#jenis_kelamin').html(item.jenis_kelamin_desc)
            $('#no_hp').html(item.no_hp)
            $('#npwp').html((item.npwp == null) ? item.npwp : '-')
            $('#alamat').html(item.alamat)
            if (item.kontak_darurat == null || item.nomor_darurat == null) {
                $('#divKontak').hide()
            }
            $('#nama_kd').html(item.kontak_darurat)
            $('#kd').html((item.nomor_darurat == null) ? item.nomor_darurat : '-')
            $('#profesi').html(item.profesi_desc)
            $('#kat_profesi').html(item.profesi_kategori_desc)
            $('#str_no').html(item.str_no)
            $('#plan_desc').html(item.plan_desc)
            $('#insName').html(item.ins_nama)
            $('#imgIns').attr('src', item.ins_logo)
            $('#premi').html(item.premi)
            $('#biaya_polis').html((item.biaya_polis == null ? '-' : item.biaya_polis))
            $('#biaya_materai').html((item.biaya_materai == null ? '-' : item.biaya_materai))
            $('#total_premi').html((item.total_premi == null ? '-' : item.total_premi))
            $('#sum').html(item.sum_insured)
            if (item.str_stat == 1) {
                $('#str_stat').html('Seumur Hidup')
                $('#label_str').html('Periode Awal STR')
                $('#str_date').html(item.str_date_start)
            } else {
                $('#str_stat').html('Belum Seumur Hidup')
                $('#label_str').html('Masa Berakhir STR')
                $('#str_date').html(item.str_date_end)
            }
            $('#sip_no').html(item.sip_no)
            $('#penerbit').html(item.sip_penerbit_desc)
            $('#sip_date_start').html(item.sip_date_start)
            $('#sip_date_end').html(item.sip_date_end)

            if (item.status_id == 1 || item.status_id == 4) {
                $('#btn_rev').css('display', 'inline-block')
                $('#btn_val').css('display', 'inline-block')
            }
            if (item.status_id >= 5) {
                $('#btn_info').css('display', 'inline-block')
                $('#invoice').css('display', 'inline-block')
            }
            if (item.status_id == 2) {
                getStatusPayment()
                $('#btn_stat_pembayaran').css('display', 'inline-block')
                $('#invoice').css('display', 'inline-block')
            }
            if (item.status_id == 6) {
                $('#btn_pol').css('display', 'inline-block')
            }

        if (response['praktik'] && response['praktik'].length > 0) {
            $.each(response['praktik'], function (j, item) {
                $('#divSIP').append(`
                    <div class="row mt-2" style="border: 1px solid #ddd; border-radius: 10px; padding-block: 10px; margin-inline: 7px">
                        <div class="col-md-6 col-10 d-flex align-items-center">
                            <p class="mb-0">${j + 1}. SIP NO. ${item.sip_no}</p>
                        </div>
                        <div class="col-md-6 col-2 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary btn-sm btnSIP" type="button" id="file_sip${item.id}" data-stat="2" data-id="${item.id}">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                `);
            })
        } else {
            $('#divSIP').html(`
                <div class="d-flex justify-content-center align-items-center" style="height: 150px; border: 1px solid #ddd; border-radius: 10px;">
                    <p>Data tidak tersedia</p>
                </div>
            `);
        }

        $.each(response['polis'], function (j, item) {
            $('#btn_pol').attr('href', item.file_path)
        })

        $.each(response['document'], function (j, item) {
            if (item.file_type == 1) {
                $('#f_ktp').attr('href', item.link)
                $('#f_ktp').html('<i class="fas fa-download"></i> Download KTP')
                ktp = base_url.concat(`/${item.file_path}`)
            } else if (item.file_type == 2) {
                $('#f_str').attr('href', item.link)
                $('#f_str').html('<i class="fas fa-eye"></i> Download STR')
                str = base_url.concat(`/${item.file_path}`)
            } else {
                $('#f_sip').attr('href', item.link)
                $('#f_sip').html('<i class="fas fa-eye"></i> Download SIP')
                sip.push({
                    'file': base_url.concat(`/${item.file_path}`),
                    'id_file': item.tempat_praktik_id
                })
            }
        })
        })

        swal.close()
    })
}

$(document).on('click', '.btnSIP', function () {
    const stat = $(this).data('stat'); // Mengambil nilai dari data-stat
    const id = $(this).data('id'); // Mengambil nilai dari data-id
    console.log('haha')
    openModal(stat, id)
});

function openModal(stat, id = 0) {

    const setModalContent = (title, displayId, detailContent, imgSrc) => {
        $('#title-modal').html(title);
        $('#f_ktp, #f_str, #f_sip').css('display', 'none');
        $(displayId).css('display', 'inline-block');
        $('#divRow').html(detailContent);
        if (imgSrc) {
            $('#col-8').html(`<img src="${base_url}/${imgSrc}" id="file_img" style="max-width: inherit; width: 100%; max-height: 500px; height: auto; border: 1px solid black; border-radius: 10px;" alt="">`);
        }
    };

    let detailContent = '';
    switch (stat) {
        case 0:
            detailContent = detail['data'].map(item => `
                <div class="col-md-4" style="border-right: 1px #ddd solid">
                    <div class="form-group"><h4>NIK</h4><p>${item.nik}</p></div>
                    <div class="form-group"><h4>Nama</h4><p>${item.nama}</p></div>
                    <div class="form-group"><h4>Tempat, Tanggal Lahir</h4><p>${item.tempat_lahir}, ${item.tanggal_lahir}</p></div>
                    <div class="form-group"><h4>Jenis Kelamin</h4><p>${item.jenis_kelamin_desc}</p></div>
                </div>
                <div class="col-md-8 container" style="text-align: center">
                    <input type="checkbox" id="zoomCheck">
                    <label for="zoomCheck">
                        <img src="${ktp}" id="file_img" style="width:100%; object-fit: cover; border: 1px solid black; border-radius: 10px;" alt="">
                    </label>
                </div>
            `).join('');
            setModalContent('File KTP', '#f_ktp', detailContent);
            break;

        case 1:
            detailContent = detail['data'].map(item => {
                const label = item.str_stat == 1 ? 'Seumur Hidup' : 'Belum Seumur Hidup';
                const label1 = item.str_stat == 1 ? 'Periode Awal STR' : 'Masa Berakhir STR';
                const date = item.str_stat == 1 ? item.str_date_start : item.str_date_end;
                return `
                    <div class="col-md-4" style="border-right: 1px #ddd solid">
                        <div class="form-group"><h4>NO. STR</h4><p>${item.str_no}</p></div>
                        <div class="form-group"><h4>Nama</h4><p>${item.nama}</p></div>
                        <div class="form-group"><h4>Status STR</h4><p>${label}</p></div>
                        <div class="form-group"><h4>${label1}</h4><p>${date}</p></div>
                    </div>
                    <div class="col-md-8 container" style="text-align: center">
                        <input type="checkbox" id="zoomCheck">
                        <label for="zoomCheck">
                            <img src="${str}" id="file_img" style="width: 100%; min-height: 500px;max-height: 500px; border: 1px solid black; border-radius: 10px;" alt="">
                        </label>
                    </div>
                `;
            }).join('');
            setModalContent('File STR', '#f_str', detailContent);
            break;

        case 2:
            detailContent = detail['praktik'].map(item => {
                if (item.id == id) {
                    return `
                        <div class="col-md-4" style="border-right: 1px #ddd solid">
                            <div class="form-group"><h4>NO. SIP</h4><p>${item.sip_no}</p></div>
                            <div class="form-group"><h4>Tempat Praktik</h4><p>${item.tempat_praktik}</p></div>
                            <div class="form-group"><h4>Periode SIP</h4><p>${item.sip_date_start} s/d ${item.sip_date_end}</p></div>
                            <div class="form-group"><h4>Daerah Penerbit SIP</h4><p>${item.sip_penerbit}</p></div>
                        </div>
                        <div class="col-md-8 container" style="text-align: center">
                            <input type="checkbox" id="zoomCheck">
                            <label for="zoomCheck" id="col-8"></label>
                        </div>
                    `;
                }
                return '';
            }).join('');
            const imgSrc = detail['document'].find(doc => doc.tempat_praktik_id == id)?.file_path || '';

            setModalContent('File SIP', '#f_sip', detailContent, imgSrc);
            break;
    }

    $('#modal-upd').modal('show');
}


$(document).on('click', '.btnVal', function () {
    Swal.fire({
        title: "Apakah anda yakin menghapus data ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: `<i class="fa fa-trash"></i> Delete`,
        confirmButtonColor: '',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {

        }
    });
});

$('#check').click(function() {
    const table = $('#table').DataTable();
    const isChecked = this.checked;

    // Menggunakan DataTables untuk memilih semua baris termasuk yang tersembunyi karena pagination
    table.rows().nodes().to$().find('input[name="reqId"]').prop('checked', isChecked);
});

$('#fileForm').on('submit', function (event) {
    event.preventDefault();  // Menghindari pengiriman form default
    const form = this;
    Swal.fire({
        title: "Apakah anda yakin?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: `<i class="fa fa-upload"></i> Insert`,
        confirmButtonColor: '',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            insertBatch(form)
        }
    });
});

$('.btnAction').click(function() {
    const stat = $(this).data('stat'); // Ambil nilai stat
    const isDelete = (stat == 0); // Tentukan apakah ini aksi hapus

    // Konfigurasi Swal untuk aksi delete atau submit
    const swalConfig = {
        title: isDelete ? "Apakah anda yakin untuk menghapus data tersebut?" : "Apakah anda yakin?",
        icon: isDelete ? 'warning' : 'info',
        showCancelButton: true,
        confirmButtonText: isDelete
            ? `<i class="fa fa-trash"></i> Delete`
            : `<i class="fa fa-check-circle"></i> Submit`,
        confirmButtonColor: '', // Kosongkan agar tidak konflik dengan customClass
        customClass: {
            confirmButton: isDelete ? 'btn btn-danger' : 'btn btn-success', // Tombol sesuai aksi
            cancelButton: 'btn btn-secondary' // Tombol batal
        },
        buttonsStyling: false // Gunakan gaya Bootstrap
    };

    // Tampilkan modal Swal
    Swal.fire(swalConfig).then((result) => {
        if (result.isConfirmed) {
            isDelete ? deleteData() : sendBatch();
        }
    });
});

function deleteData(){

}

function insertBatch(elm){
    var formData = new FormData(elm);  // Membuat objek FormData dari form

    formData.append("ins_id", "2");
    formData.append("batch_id", "2");

    var settings = {
        "url": base_url + "/api/client-admin/request/insert-data",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "headers": {
            "Authorization": "Bearer " + token
        },
        "data": formData
    };

    $.ajax(settings).done(async function (responses) {
        responses = JSON.parse(responses)
        var response = await decryptData(responses['data'])

        progressData(response)
    });
}

function progressData(response){

    var jobId = response['jobId']
    var progressText

    // SweetAlert untuk menampilkan loading
    Swal.fire({
        title: 'Loading...',
        html: 'Progress: <b id="prog">0%</b>',
        showCancelButton: false,
        showConfirmButton: false,
        didOpen: () => {
            // Menyimpan referensi progressText agar bisa diakses di luar didOpen
            const content = Swal.getHtmlContainer();
            progressText = content.querySelector('b');
        }
    });

    // Fetch dengan chunk
    fetch(base_url + `/api/client-admin/request/progres-insert-data?jobId=${jobId}`, {
        method: 'GET',
        headers: {
            "Authorization": "Bearer " + token
        }
    })
        .then(response => {
            const reader = response.body.getReader();
            const decoder = new TextDecoder("utf-8");

            function readChunk() {
                reader.read().then(({done, value}) => {
                    if (done) {
                        console.log('Transfer selesai.');
                        return;
                    }

                    // Decode chunk menjadi teks
                    const chunk = decoder.decode(value, {stream: true});

                    // Memproses setiap baris dalam chunk
                    chunk.split("\n").forEach(line => {
                        if (line.trim()) { // Abaikan baris kosong
                            try {
                                // Parse JSON langsung dari respons
                                const {progress, is_finished} = JSON.parse(line);

                                // Update progress di SweetAlert
                                progressText.textContent = `${progress}%`;

                                if (is_finished) {
                                    // Jika proses selesai, tampilkan pesan sukses
                                    Swal.fire({
                                        title: 'Finished!',
                                        text: 'The loading is complete.',
                                        icon: 'success',
                                        showCancelButton: false,
                                        showConfirmButton: false,
                                    });
                                    setInterval(function () {
                                        location.reload();
                                    }, 2000);
                                    return; // Hentikan membaca chunk
                                }
                            } catch (error) {
                                console.error("Error parsing JSON:", error, line);
                            }
                        }
                    });

                    // Baca chunk berikutnya
                    readChunk();
                });
            }

            // Mulai membaca chunk
            readChunk();
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Terjadi kesalahan saat membaca progress.',
                icon: 'error'
            });
        });
}

async function sendBatch() {
    Swal.fire({
        icon: 'info',
        text: "Loading!",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    let reqId = [];
    const table = $('#table').DataTable();
    // table.rows().nodes().to$().find('input[type="checkbox"]:checked').each(function() {
    //     reqId.push($(this).val());
    // });

    // Ambil data dari semua baris pada kolom pertama
    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
        const data = this.data(); // Mendapatkan data baris
        reqId.push(data['reqId']); // Kolom pertama (index 0)
    });

    if(reqId.length == 0){
        Swal.fire({
            icon: 'warning',
            title: 'Harap pilih data!',
            showConfirmButton: true,
            allowOutsideClick: false,
        });

        return
    }

    var data = await encryptData(JSON.stringify(
        {
            "bacthId": batchId,
            "statusId": 1,
            "reqId": reqId,
        })
    )
    $.ajax({
        "url": base_url.concat('/api/client-admin/request/verification'),
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + token
        },
        "data": {
            data : data
        },
        success: async function (responses) {
            // responses = JSON.parse(responses)
            var response = await decryptData(responses['data'])
            progressData(response)
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");

            Swal.fire({
                icon: 'error',
                title: err.message,
                showConfirmButton: false,
                timer: 2000
            });
        }
    })
}

