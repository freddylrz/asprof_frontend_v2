@extends('v1.layouts.dashboard')

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
            padding-bottom: 30px;
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
                padding-bottom: 25px;
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
                padding-bottom: 25px;
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
                padding-bottom: 25px;
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
            transform: translateX(-50%);
            transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
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
            transform: translateX(-50%) scale(1.2);
            background-color: currentColor;
        }

        .multisteps-form__progress-btn.js-proses:before {
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
            transition: transform 0.25s ease;
            cursor: zoom-in;
        }

        input[type=checkbox]:checked~label>img {
            transform: scale(2);
            cursor: zoom-out;
        }

        .notifier {
            border-left: #06c1c1 10px solid !important;
            min-height: 80px !important;
            color: black;
            top: 80px;
            z-index: 9999999 !important;
        }

        .notifier-img>.img {
            height: 65px !important;
            width: 70px !important;
        }

        table>thead>tr>th {
            text-align: center;
        }

        .swal2-title {
            padding: unset !important;
        }
    </style>
    <div class="pct-body">
        <div class="mb-5" id="div-back" style="display: none">
            <button class="btn btn-secondary btn-sm fa-pull-left" onclick="window.history.back();"><i
                    class="fa fa-arrow-alt-circle-left"></i> Back</button>
        </div>
        <div class="mb-5" style="text-align: center">
            <h1 class="text-center">NO KLAIM</h1>
            <h2 class="text-center" id="register-no"></h2>
        </div>
        <div class="mb-5" style="text-align: center">
            <div class="multisteps-form__progress">
                <div class="multisteps-form__progress-btn" id="poin-satu">Diajukan <span
                        class="badge d-inline-block badge-bottom" id="status-poin-satu"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-dua">Verifikasi <span
                        class="badge d-inline-block badge-bottom" id="status-poin-dua"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-tiga">Investigasi <span
                        class="badge d-inline-block badge-bottom" id="status-poin-tiga"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-empat">Mediasi <span
                        class="badge d-inline-block badge-bottom" id="status-poin-empat"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-lima">Keputusan <span
                        class="badge d-inline-block badge-bottom" id="status-poin-lima"></span></div>
                <div class="multisteps-form__progress-btn" id="poin-enam">Selesai <span
                        class="badge d-inline-block badge-bottom" id="status-poin-enam"></span></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="text-muted" style="text-align: right"><i>Tanggal Diterima : <span id="accept-date"></span></i>
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div style="border: 1px solid #ddd; padding: 10px; margin-bottom:20px">
                            <h3 style="text-align: center"> Informasi Polis </h3>
                            <hr>
                            <div class="form-group">
                                <h4>No Sertifikat </h4>
                                <p id="polis-no">-</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Periode Polis </h4>
                                        <p id="periode-polis">-</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Jaminan Pertanggungan </h4>
                                        <p id="sum-insured">-</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Nama Peserta</h4>
                                <p id="nama">-</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>No. HP </h4>
                                        <p id="no-hp">-</p>
                                    </div>
                                    <div class="form-group">
                                        <h4>Profesi </h4>
                                        <p style="margin-bottom : 2px !important" id="profesi">-</p>
                                        <label for="">(<i id="kategori"></i>)</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Email </h4>
                                        <p id="email">-</p>
                                    </div>
                                    <div class="form-group">
                                        <h4>No. STR </h4>
                                        <p id="str-no">-</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>No. SIP </h4>
                                        <p style="margin-bottom : 2px !important" id="sip-no">-</p>
                                        <label><i>(<span id="sip-periode"></span>)</i></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Tempat Praktek </h4>
                                        <p id="tempat-praktik">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="border: 1px solid #ddd; padding: 10px; margin-bottom:20px">

                            <h3 style="text-align: center">Informasi Data Pasien </h3>
                            <hr>
                            <div class="form-group">
                                <h4>Nama Pasien </h4>
                                <p id="patient-name">-</p>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Usia </h4>
                                        <p id="patient-age">-</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Jenis Kelamin </h4>
                                        <p id="patient-gender">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="border: 1px solid #ddd; padding: 10px; margin-bottom:20px">
                            <h3 style="text-align: center">Informasi Awal Klaim </h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Tanggal Pengaduan</h4>
                                        <p id="report-date">-</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Tanggal Kejadian</h4>
                                        <p id="incident-date">-</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Lokasi Kejadian</h4>
                                        <p id="incident-location">-</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Jenis Tuntutan</h4>
                                        <p id="cause-of-action">-</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <h4>Detail Pengaduan</h4>
                                <p id="incident-description">-</p>
                            </div>
                        </div>
                        <div style="border: 1px solid #ddd; padding: 10px; margin-bottom:20px">
                            <h3 style="text-align: center"> Informasi Kontak Alternatif </h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>Nama</h4>
                                        <p id="pic-name"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h4>No. HP</h4>
                                        <p id="pic-no"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="text-align: center">Daftar Dokumen</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Dokumen</th>
                                        <th>Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody id="table-doc">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-light-success border border-success btn-sm"
                        style="display: inline-block; padding-block: 5px" data-bs-toggle="modal"
                        data-bs-target="#modal-log" id="btn-log">
                        <i class="fas fa-list"></i> Log Status
                    </button>

                    <div id="div-btn" class="d-flex gap-2">
                        <!-- tombol lain masuk sini -->
                    </div>
                </div>
            </div>
        </div>
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
                    <button type="button" class="btn btn-danger pull-right" data-bs-dismiss="modal">Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('levelPluginsJsHeader')
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    @endpush

    @push('levelPluginsJs')
        <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
        @vite(['resources/js/v1/pi/klaim/detail.js'])
    @endpush
@endsection
