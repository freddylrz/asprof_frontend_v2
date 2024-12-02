@extends('v1.layouts.client_admin')


@section('content')
    <style>
        p {
            font-size: 17px;
        }

        .multisteps-form__progress {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
        }

        .multisteps-form__progress-btn {
            transition-property: all;
            transition-duration: 0.15s;
            transition-timing-function: linear;
            transition-delay: 0s;
            position: relative;
            padding-bottom: 30px; /* Add some padding to the bottom for space */
            padding-top: 40px;
            color: #d9534f;
            text-indent: -9999px;
            border: none;
            background-color: transparent;
            outline: none !important;
            cursor: default;
            font-size: 1.3rem;
            font-weight: 600;
            text-indent: 0;
        }
        @media (max-width: 1000px) {
            .multisteps-form__progress-btn {
                font-size: 0.9rem;
                /*padding-top: 30%;*/
                padding-bottom: 25px; /* Add some padding to the bottom for space */
            }

            .badge-bottom {
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                font-size: 10px !important;
            }
        }

        @media (max-width: 500px) {
            .multisteps-form__progress-btn {
                font-size: 0.6rem;
                /*padding-top: 30%;*/
                padding-bottom: 25px; /* Add some padding to the bottom for space */
            }

            .badge-bottom {
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                font-size: 10px !important;
            }
        }


        @media (max-width: 410px) {
            .multisteps-form__progress-btn {
                font-size: 0.5rem;
                /*padding-top: 30%;*/
                padding-bottom: 25px; /* Add some padding to the bottom for space */
            }

            .badge-bottom {
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                font-size: 10px !important;
            }
        }

        .multisteps-form__progress-btn:before {
            position: absolute;
            top: 0;
            left: 50%;
            display: block;
            width: 24px;
            height: 24px;
            content: '';
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%);
            transition: all 0.15s linear 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
            transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
            transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
            border: 2px solid currentColor;
            border-radius: 50%;
            background-color: #d9534f;
            box-sizing: border-box;
            z-index: 3;
        }

        .multisteps-form__progress-btn:after {
            position: absolute;
            top: 11px;
            left: calc(-50% - 25px / 2);
            transition-property: all;
            transition-duration: 0.15s;
            transition-timing-function: linear;
            transition-delay: 0s;
            display: block;
            width: 100%;
            height: 3px;
            content: '';
            background-color: currentColor;
            z-index: 1;
        }

        .multisteps-form__progress-btn:first-child:after {
            display: none;
        }

        .multisteps-form__progress-btn.js-active {
            color: #499249;
        }

        .multisteps-form__progress-btn.js-proses {
            color: #ff9100;
        }

        .multisteps-form__progress-btn.js-active:before {
            -webkit-transform: translateX(-50%) scale(1.2);
            transform: translateX(-50%) scale(1.2);
            background-color: currentColor;
        }

        .multisteps-form__progress-btn.js-proses:before {
            -webkit-transform: translateX(-50%) scale(1.2);
            transform: translateX(-50%) scale(1.2);
            background-color: currentColor;
        }

        .multisteps-form__form {
            position: relative;
        }

        .multisteps-form__panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            opacity: 0;
            visibility: hidden;
        }

        .multisteps-form__panel.js-active {
            height: auto;
            opacity: 1;
            visibility: visible;
        }

        .badge-bottom {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            font-size: 16px;
        }
        input[type=checkbox] {
            display: none;
        }

        .container img {
            /*margin: 100px;*/
            transition: transform 0.25s ease;
            cursor: zoom-in;
        }

        input[type=checkbox]:checked ~ label > img {
            transform: scale(2);
            cursor: zoom-out;
        }
        .notifier{
            border-left: #06c1c1 10px solid !important;
            min-height: 80px !important;
            color: black;
            top: 80px;
            z-index: 9999999 !important;
        }
        .notifier-img > .img{
            height: 65px !important;
            width: 70px !important;
        }
    </style>
    <div class="pct-body">
        <div class="mb-5">
            <button class="btn btn-secondary btn-sm fa-pull-left" onclick="window.history.back();"><i class="fa fa-arrow-alt-circle-left"></i> Back</button>
        </div>
        <div class="mb-5" style="text-align: center">
            <h1 class="text-center">NO REGISTRASI</h1>
            <h2 class="text-center" id="register_no"></h2>
        </div>
        <div class="mb-5" style="text-align: center">
            <div class="multisteps-form__progress">
                <div class="multisteps-form__progress-btn" id="poin-satu">Proses Pendaftaran <span
                        class="badge d-inline-block badge-bottom" id="status-poin-satu"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-dua">Proses Persetujuan <span
                        class="badge d-inline-block badge-bottom" id="status-poin-dua"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-tiga">Proses Konfirmasi <span
                        class="badge d-inline-block badge-bottom" id="status-poin-tiga"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-empat">Proses Pembayaran <span
                        class="badge d-inline-block badge-bottom" id="status-poin-empat"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-lima">Polis <span
                        class="badge d-inline-block badge-bottom" id="status-poin-lima"></span></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-user mb-2" style="font-size: 2.5rem;"></i> Informasi Data
                    Pribadi</h3></div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>Nama</h4>
                            <p id="nama"></p>
                        </div>
                        <div class="form-group">
                            <h4>Tempat, Tanggal Lahir</h4>
                            <p id="ttl"></p>
                        </div>
                        <div class="form-group">
                            <h4>Jenis Kelamin</h4>
                            <p id="jenis_kelamin"></p>
                        </div>
                        <div class="form-group">
                            <h4>Email</h4>
                            <p id="email"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <h4>NIK</h4>
                                    <p id="nik"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn btn-primary btnSIP" id="openModalKTP" data-stat="0"><i class="fas fa-eye"></i>
                                        Lihat KTP
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4>NPWP</h4>
                            <p id="npwp"></p>
                        </div>
                        <div class="form-group">
                            <h4>No. Hp</h4>
                            <p id="no_hp"></p>
                        </div>
                        <div class="form-group">
                            <h4>Alamat</h4>
                            <p id="alamat"></p>
                        </div>

                    </div>
                </div>

                <div class="row mt-3" id="divKontak" style="border: 1px #ddd solid; padding: 10px 10px 5px 10px; border-radius: 10px">
                    <h3><i class="fas fa-phone-alt mb-2" style="font-size: 1.5rem;"></i> Kontak Darurat</h3>
                    <hr>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>Nama</h4>
                            <p id="nama_kd"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>No. HP</h4>
                            <p id="kd"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-user-md mb-2" style="font-size: 2.5rem;"></i> Informasi Data
                    Profesi</h3></div>

            <div class="card-body">
                <div class="row" style="border: 1px solid #ddd; border-radius: 10px; padding-top: 10px">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>Profesi</h4>
                            <p id="profesi"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>Kategori Profesi</h4>
                            <p id="kat_profesi"></p>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 col-12 pt-3 pe-xl-3" style="">
                        <div style="text-align: center">
                            <h3>Surat Tanda Register</h3>
                        </div>
                        <div class="row" style="border: 1px solid #ddd; border-radius: 10px; padding-top: 10px">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4>No. STR</h4>
                                    <p id="str_no"></p>
                                </div>
                                <div class="form-group">
                                    <h4>Status STR</h4>
                                    <p id="str_stat"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-primary btnSIP"  id="openModalSTR" data-stat="1"><i class="fas fa-eye"></i>
                                        Lihat STR
                                    </button>
                                </div>
                                <div class="form-group">
                                    <h4 id="label_str"></h4>
                                    <p id="str_date"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 pt-3 ps-lg-2 pe-md-0 p-0" >

                        <div style="text-align: center">
                            <h3>Surat Izin Praktik</h3>
                        </div>
                        <div id="divSIP">

                        </div>

                    </div>
                </div>
    <style>
        .base {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: stretch;
        }

        .chil {
            padding-right: unset;
        }
    </style>
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
    </div>
{{--    <div class="row mt-3" style="border: 1px #ddd solid; padding: 10px 10px 5px 10px; border-radius: 10px">--}}
{{--        <h3><i class="fas fa-building mb-2" style="font-size: 2.5rem;"></i> Informasi--}}
{{--           Surat Izin Praktik</h3>--}}
{{--        <div class="table-responsive dt-responsive">--}}
{{--            <table class="table table-striped" style="font-size: 17px">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th style="font-size: 18px">No</th>--}}
{{--                    <th style="font-size: 16px">No SIP</th>--}}
{{--                    <th style="font-size: 16px">Periode SIP</th>--}}
{{--                    <th style="font-size: 16px">Tempat Praktik</th>--}}
{{--                    <th style="font-size: 16px">SIP Penerbit</th>--}}
{{--                    <th style="font-size: 16px; width: 100px">File SIP</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody id="table_body">--}}

{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}

    </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-file-invoice mb-2" style="font-size: 2.5rem;"></i> Informasi Plan </h3>
        </div>
        <div class="card-body">
            <div class="row" style="">
                <div class="col-md-6">
                    <div class="form-group">
                        <h4>Plan</h4>
                        <p id="plan_desc"></p>
                    </div>
                    <div class="form-group">
                        <h4>Asuransi</h4>
                        <p id="insName" style="margin-bottom: unset"></p>
                        <img src="" id="imgIns" style="width: 15%; height: auto">
                    </div>
                </div>
                <div class="col-md-6">
                        <div class="form-group">
                            <h4>Premi Tahunan</h4>
                            <p id="premi"></p>
                        </div>
                        <div class="form-group">
                            <h4>Biaya Polis</h4>
                            <p id="biaya_polis"></p>
                        </div>
                        <div class="form-group">
                            <h4>Biaya Materai</h4>
                            <p id="biaya_materai"></p>
                        </div>
                        <div class="form-group">
                            <h4>Total Premi</h4>
                            <p id="total_premi"></p>
                        </div>
                        <div class="form-group">
                            <h4>Jaminan Pertanggungan</h4>
                            <p id="sum"></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-4">
                    <button class="btn btn-light-success border border-success mr-2 btn-sm" style="display: inline-block; padding-block: 5px"
                            data-bs-toggle="modal" data-bs-target="#modal-log"
                            id="btn_log"><i class="fas fa-list"></i> Log Status
                    </button>
                </div>
                <div class="col-md-6 col-8" style="text-align: right">
                    {{--                        <button class="btn btn-warning pull-right mr-2" id="btn_rev" data-bs-toggle="modal"--}}
                    {{--                                data-bs-target="#modal-revisi">Revisi--}}
                    {{--                        </button>--}}
                    <button class="btn btn-danger pull-right mr-2 mb-2 btnVal" data-stat="2" id="btn_rev" style="display: none"
                            ><i class="fa fa-trash"></i> Delete Data
                    </button>
                    <button class="btn btn-warning pull-right mb-2 mr-2" style="display: none" data-bs-toggle="modal"
                            data-bs-target="#modal-payment" id="btn_info"><i class="fas fa-info"></i> Informasi
                        Pembayaran
                    </button>
                    <button class="btn btn-light-secondary pull-right mb-2 mr-2" style="display: none" data-bs-toggle="modal"
                            data-bs-target="#modal-proses" id="btn_stat_pembayaran"><i class="fas fa-info"></i> Cek Status
                        Pembayaran
                    </button>
                    <a href="" id="invoice" class="btn btn-info mb-2" style="display: none" target="_blank"><i
                            class="fa fa-download"></i> Download Nota</a>
                    <a class="btn btn-primary pull-right mr-2 mb-2" style="display: none" id="btn_pol"
                            target="_blank"><i class="fa fa-download"></i> e-Certificate</a>
{{--                    <a class="btn btn-primary" href="" id="btnPolis"--}}
{{--                            target="_blank"><i class="fa fa-download"></i> Polis--}}
{{--                    </a>--}}
                </div>
            </div>
        </div>

    </div>

    </div>


    <div class="modal fade" id="modal-upd">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body task-card">
                    <div class="row" id="divRow">

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" style="display: none" id="f_ktp" target="_blank" class="btn btn-primary"></a>
                    <a href="" style="display: none" id="f_str" target="_blank" class="btn btn-primary"></a>
                    <a href="" style="display: none" id="f_sip" target="_blank" class="btn btn-primary"></a>
                    <button type="button" class="btn btn-danger pull-right"
                            data-bs-dismiss="modal">Tutup
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-log">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Log Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body task-card">
                    <ul class="list-unstyled task-list" id="list-log">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right"
                            data-bs-dismiss="modal">Tutup
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-payment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Info Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="divPay">

                </div>
                <div class="modal-footer">
                    {{--                    <button class="btn btn-primary" id="btn_pol" onclick="invoice()">Download Nota</button>--}}

                    <button type="button" class="btn btn-danger pull-right"
                            data-bs-dismiss="modal">Tutup
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-proses">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Status Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="divStatPay">

                </div>
                <div class="modal-footer">
                    {{--                    <button class="btn btn-primary" id="btn_pol" onclick="invoice()">Download Nota</button>--}}

                    <button type="button" class="btn btn-danger pull-right"
                            data-bs-dismiss="modal">Tutup
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-revisi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Revisi Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea id="desc" name="desc" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="validasi(3)">Oke</button>
                    <button type="button" class="btn btn-danger pull-right"
                            data-bs-dismiss="modal">Tutup
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @push('levelPluginsJsHeader')
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    @endpush

    @push('levelPluginsJs')
        <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
        <script type="module" src="{{ asset('assets/js/plugins/notifier.js') }}"></script>

        @vite(['resources/js/v1/admin/detail.js','resources/js/app.js'])

        <script type="text/javascript">

        </script>
    @endpush
@endsection
