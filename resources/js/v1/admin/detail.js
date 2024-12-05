import {
    decryptData,
    encryptData,
    getAccessTokenFromCookies
} from "../encrypt.js";

let searchParams = new URLSearchParams(window.location.search)
var id = searchParams.get('id')
// $('#btnPolis').attr('href','/polisDev?reqId='+id)

$('#invoice').attr('href', '/admin/pdf?reqId=' + id)
var detail, ktp, str, sip = [], token

$(document).ready(async function () {
    token = await getAccessTokenFromCookies()
    getDataDetail()
})

function getDataDetail() {
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
            "reqId": id
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

            const getStatusesByStatusId = (statusId) => {
                switch (statusId) {
                    case 1:
                    case 3:
                        return [
                            {
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
                                text: 'Belum Terbit'
                            },
                            {id: '#poin-satu', class: 'js-active'},
                            {id: '#poin-dua', class: 'js-proses'},
                        ];
                    case 4:
                        return [
                            {
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
                                text: 'Belum Terbit'
                            },
                            {id: '#poin-satu', class: 'js-active'},
                            {id: '#poin-dua', class: 'js-proses'},
                        ];
                    case 5:
                        return [
                            {
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
                                text: 'Belum Terbit'
                            },
                            {id: '#poin-satu', class: 'js-active'},
                            {id: '#poin-dua', class: 'js-active'},
                            {id: '#poin-tiga', class: 'js-active'},
                            {id: '#poin-empat', class: 'js-proses'},
                        ];
                    case 6:
                        return [
                            {
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
                            {id: '#poin-satu', class: 'js-active'},
                            {id: '#poin-dua', class: 'js-active'},
                            {id: '#poin-tiga', class: 'js-active'},
                            {id: '#poin-empat', class: 'js-active'},
                            {id: '#poin-lima', class: 'js-active'},
                        ];
                    default:
                        return [
                            {
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
                                text: 'Belum Terbit'
                            },
                            {id: '#poin-satu', class: 'js-active'},
                            {id: '#poin-dua', class: 'js-active'},
                            {id: '#poin-tiga', class: 'js-proses'},
                        ];
                }
            };

            const statuses = getStatusesByStatusId(statusId);

            statuses.forEach(status => {
                $(status.id).addClass(status.class).text(status.text);
            });

        })

        if (response['praktik'] && response['praktik'].length > 0) {
            $.each(response['praktik'], function (j, item) {
                $('#divSIP').append(`
                    <div class="row mt-2" style="border: 1px solid #ddd; border-radius: 10px; padding-block: 10px; margin-inline: 7px">
                        <div class="col-md-6 col-10 d-flex align-items-center">
                            <p class="mb-0">${j + 1}. SIP NO. ${item.sip_no}</p>
                        </div>
                        <div class="col-md-6 col-2 d-flex justify-content-end align-items-center">
                            <button class="btn btn-primary btn-sm btnSIP" id="file_sip${item.id}" data-stat="2" data-id="${item.id}">
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

        $('#table_log').empty()
        $.each(response['log'], function (j, item) {
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

        $.each(response['paid'], function (j, item) {
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
                             <p>${(item.kwitansi_amt === null ? '-' : item.kwitansi_amt)}</p>
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
        swal.close()
    })
    window.Echo.channel('requestStatus-channel.' + id).listen(".request.status", async function (data) {
        notifier.show('<b>Data telah diperbarui!</b> <br> Halaman akan <u>direfresh!</u>', data.statusDesc, 'Pemberitahuan', '../logo/survey-48.png', 5000);
        setInterval(function () {
            location.reload();
        }, 6000);
    })
}

$(document).on('click', '.btnSIP', function () {
    const stat = $(this).data('stat'); // Mengambil nilai dari data-stat
    const id = $(this).data('id'); // Mengambil nilai dari data-id
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

function getStatusPayment() {
    $.ajax({
        "url": base_url.concat('/api/admin/payment/status'),
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + token
        },
        "data": {
            "reqId": id
        },
    }).done(async function (responses) {
        var response = await decryptData(responses)

        var status = 'Berhasil'
        var code = '#4CAF50'
        if (response.status_code == 201) {
            status = 'Tertunda'
            code = '#2196f3'
        }
        if (response.status_code == 202) {
            status = 'Kedaluarsa'
            code = '#FF9800'
        }

        $('#divStatPay').html(
            ` <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="">Status Pembayaran</label><br>
                          <label class="badge" style="background-color: ${code}">${status}</label>
                      </div>
                     <div class="form-group">
                          <label for="">Tanggal Kedaluarsa</label><br>
                          <label class="badge bg-danger">${response.expiry_time}</label>
                      </div>
                        <div class="form-group">
                          <label for="">Total Tagihan</label>
                         <p>${response.premi}</p>
                      </div>
                   </div>
                  <div class="col-md-6">
                    <div class="form-group">
                          <label for="">Metode Pembayaran</label>
                          <p>${response.description}</p>
                      </div>
                    <div class="form-group">
                          <label for="">Tanggal Pembayaran</label>
                          <p>-</p>
                      </div>
                        <div class="form-group">
                          <label for="">Total Pembayaran</label>
                         <p>-</p>
                      </div>
                  </div>
              </div>
            `
        )
    })
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
