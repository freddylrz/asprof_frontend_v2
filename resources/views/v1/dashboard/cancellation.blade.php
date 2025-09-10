@extends('v1.layouts.dashboard')

@section('content')
<div class="row" id="div-cancellation">
    <div class="col-12">
        <div class="text-center mb-5">
            <p class="h1">Pembatalan</p>
            <p class="h1" id="nomor-register"></p>
        </div>

        <div class="alert alert-danger d-flex align-items-center" role="alert" id="div-polis-alert">
            <i class="ti ti-info-circle me-3 my-auto" style="font-size: 2.5rem; font-weight: 900; flex-shrink: 0; color: #050505"></i>
            <span id="polis-alert" class="text-wrap h4 my-auto" style="flex: 1;">
                Kami memahami bahwa keputusan untuk membatalkan polis bukanlah hal yang mudah. Jika Anda yakin ingin melanjutkan proses pembatalan, harap tinjau kembali informasi di bawah ini.
            </span>
        </div>
    </div>

    <div class="col-12">
        <div class="card shadow-sm border rounded-4 my-3">
            <div class="card-body px-0">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Detail Pembatalan</h3>
                        </div>
                    </div>

                    <!-- Kolom Kiri -->
                    <div class="col-12 col-lg-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-user-check f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Nama</p>
                                            <h5 class="mb-0" id="nama-pemilik">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-building-bank f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Asuransi</p>
                                            <h5 class="mb-0" id="asuransi">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-calendar-time f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Periode Polis</p>
                                            <h5 class="mb-0" id="periode-polis">-</h5>
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
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-list-numbers f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Nomor Polis</p>
                                            <h5 class="mb-0" id="nomor-polis">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-currency-dollar f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Premi</p>
                                            <h5 class="mb-0" id="premi">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-clock f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Sisa Hari / Total Hari</p>
                                            <h5 class="mb-0" id="hari-info">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="button" id="submit-button" class="btn btn-primary me-2" style="display: none;">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Tampilan Sukses Setelah Cancellation -->
<div class="row" id="div-cancellation-success" style="display: none">
    <div class="col-12">
        <div class="text-center mb-5">
            <p class="h1">Data Pembatalan</p>
            <p class="h1" id="nomor-register-sukses"></p>
        </div>

        <div class="alert alert-warning d-flex align-items-center" role="alert" id="div-polis-alert-success">
            <i class="ti ti-info-circle me-3 my-auto" style="font-size: 2.5rem; font-weight: 900; flex-shrink: 0; color: #050505"></i>
            <span id="polis-alert-success" class="text-wrap h4 my-auto" style="flex: 1;">
                Permintaan pembatalan polis Anda sedang dalam proses verifikasi. Silakan tunggu konfirmasi lebih lanjut.
            </span>
        </div>
    </div>

    <div class="col-12">
        <div class="card shadow-sm border rounded-4 my-3">
            <div class="card-body px-0">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-12 col-lg-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-user-check f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Nama</p>
                                            <h5 class="mb-0" id="nama-renewal">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-calendar-time f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Periode Polis</p>
                                            <h5 class="mb-0" id="periode-polis-renewal">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-clock f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Tanggal Pengajuan</p>
                                            <h5 class="mb-0" id="cancellation-date">-</h5>
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
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-list-numbers f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Nomor Polis</p>
                                            <h5 class="mb-0" id="nomor-polis-renewal">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-currency-dollar f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Premi</p>
                                            <h5 class="mb-0" id="premi-renewal">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-info-circle f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Status</p>
                                            <h5 class="mb-0">
                                                <span class="badge bg-warning" id="cancellation-status-badge"></span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Alasan Pembatalan - Full Width -->
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="p-3 rounded-3" style="background-color: #E6EDFB">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-s bg-light-secondary">
                                                <i class="ti ti-forms f-32"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted mb-1">Alasan Pembatalan</p>
                                            <h5 class="mb-0" id="cancellation-reason">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Download Section -->
            <div class="card-footer" id="download-section" style="display: none;">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="card h-100 shadow-sm border rounded-3">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <i class="ti ti-download f-32 mb-2 text-primary"></i>
                                <p class="text-muted mb-2">Unduh E Sertifikat</p>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm w-100" id="btn-download-sertifikat">E-Sertifikat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100 shadow-sm border rounded-3">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <i class="ti ti-download f-32 mb-2 text-primary"></i>
                                <p class="text-muted mb-2">Unduh Nota</p>
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm w-100" id="btn-download-nota">Nota</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Card Tombol Log untuk Success View -->
<div class="col-12" id="log-card-success" style="display: none;">
    <div class="card shadow-sm border rounded-4 my-3">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button type="button" id="log-button-success" class="btn btn-success">
                    <i class="ti ti-history me-2"></i>Lihat Log
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alasan Pembatalan -->
<div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reasonModalLabel">Alasan Pembatalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="reason-text" class="form-label">Silakan masukkan alasan pembatalan polis:</label>
                    <textarea class="form-control" id="reason-text" rows="4" placeholder="Masukkan alasan pembatalan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirm-submit">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Log -->
<div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logModalLabel">Aktivitas Log Pembatalan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal & Waktu</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody id="log-table-body">
                            <!-- Log akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div id="no-log-message" class="text-center text-muted" style="display: none;">
                    Tidak ada aktivitas log
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<!-- Bootstrap Modal -->
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
@vite('resources/js/v1/pi/cancellation.js')
@endpush
