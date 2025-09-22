@extends('v1.layouts.dashboard')
@section('content')
    <style>
        .text-muted {
            font-size: 1.2rem;
        }
        .div-item{
            background-color: #e6edfb !important;
        }

        #thead-row > th{
            text-align: center !important;
        }
    </style>
    <div class="row">
        <!-- Header -->
        

        <!-- Container untuk alert polis -->
        <div class="polis-alert-container col-12">
            <!-- Alert akan di-append disini -->
        </div>
        <!-- Card Informasi Polis -->
        <div class="col-12">
            <div class="card shadow-sm border rounded-4 my-3">
                <div class="card-body px-0">
                    <h4 class="px-4">Data Polis</h4>
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="div-item p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s">
                                                    <i class="ti ti-certificate f-32"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="row g-1">
                                                    <div class="col-12">
                                                        <p class="text-muted mb-1">Nomor Polis</p>
                                                        <h4 class="mb-0" id="nomor-polis"></h4>
                                                    </div>
                                                    <div class="col-6 col-md-4 d-flex align-items-center justify-content-end"
                                                        id="status-polis"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="div-item p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s div-item-secondary">
                                                    <i class="ti ti-building-skyscraper f-32"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="row g-1">
                                                    <div class="col-12">
                                                        <p class="text-muted mb-1">Perusahaan Asuransi</p>
                                                        <h4 class="mb-0" id="asuransi"></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="div-item p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s div-item-secondary">
                                                    <i class="ti ti-calendar-time f-32"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="row g-1">
                                                    <div class="col-12">
                                                        <p class="text-muted mb-1">Periode Polis</p>
                                                        <h4 class="mb-0" id="periode-polis"></h4>
                                                        <i class="text-muted mb-1" id="expire-count"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Kolom Kanan -->
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="div-item p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s div-item-secondary">
                                                    <i class="ti ti-shield-check f-32"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="row g-1">
                                                    <div class="col-12">
                                                        <p class="text-muted mb-1">Jaminan Pertanggungan</p>
                                                        <h4 class="mb-0" id="jaminan-pertanggungan"></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="div-item p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s div-item-secondary">
                                                    <i class="ti ti-cash f-32"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="row g-1">
                                                    <div class="col-12">
                                                        <p class="text-muted mb-1">Nilai Premi</p>
                                                        <h4 class="mb-0" id="nilai-premi"></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="div-item p-3 rounded-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s div-item-secondary">
                                                    <i class="ti ti-download f-32"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted mb-1">Unduh</p>
                                                <div class="row g-1">
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                                                        <div class="mb-0" id="div-e-sertifikat"></div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                                                        <div class="mb-0" id="div-e-polis"></div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                                                        <div class="mb-0" id="div-e-nota"></div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-6">
                                                        <div class="mb-0" id="div-e-kwitansi"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion mt-4" id="exampleAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <h4>Riwayat Polis</h4>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#exampleAccordion">
                    <div class="accordion-body">
                        <table id="policy-history-table" class="table table-striped table-bordered nowrap"
                            style="width:100%">
                            <thead>
                                <tr id="thead-row">
                                    <th>Asuransi</th>
                                    <th>No. Polis</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Plan</th>
                                    <th>Sum Insured</th>
                                    <th>Premi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('levelPluginsJsh')
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    @endpush

    @push('levelPluginsJs')
        <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>

        <!-- Sweet Alert -->
        <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
        {{-- custom js --}}
        @vite(['resources/js/v1/pi/kepesertaan.js', 'resources/js/v1/pi/count-message.js'])
    @endpush
@endsection
