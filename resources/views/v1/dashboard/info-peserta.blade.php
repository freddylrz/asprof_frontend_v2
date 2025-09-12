@extends('v1.layouts.dashboard')
@section('content')
<div class="row">
   <!-- Header -->
   <div class="col-12 text-center mb-5">
      <p class="h1">Data Kepesertaan</p>
      <p class="h1" id="nomor-register"></p>
   </div>
   <!-- Container untuk alert polis -->
   <div class="polis-alert-container col-12">
      <!-- Alert akan di-append disini -->
   </div>
<style>
   .text-muted, .h5{
      font-size: 1.2rem;
   }
</style>
   <!-- Informasi Data Pribadi -->
   <div class="col-12">
      <!-- Informasi Data Pribadi -->
      <div class="card shadow-sm border rounded-4 mb-4">
         <div class="card-body p-4">
            <div class="text-center mb-4">
               <h3 class="mb-0 fw-bold">Informasi Data Pribadi</h3>
            </div>
            <div class="row g-3">
               <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                     <p class="text-muted">Nama</p>
                     <p class="mb-0 fw-semibold h5" id="nama"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3 rounded-3"    style="background-COLOR: #E6EDFB">
                     <div class="d-flex justify-content-between align-items-start h-100">
                        <div>
                           <p class="text-muted">NIK</p>
                           <p class="mb-0 fw-semibold h5" id="nik"></p>
                        </div>
                        <a href="#" class="btn btn-sm btn-primary align-self-end" id="file_ktp" target="_blank"></a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                     <p class="text-muted">Tempat, Tanggal Lahir</p>
                     <p class="mb-0 fw-semibold h5" id="ttl"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                     <p class="text-muted">Jenis Kelamin</p>
                     <p class="mb-0 fw-semibold h5" id="jenis-kelamin"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                     <p class="text-muted">No. HP</p>
                     <p class="mb-0 fw-semibold h5" id="nomor-handphone"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                     <p class="text-muted">Email</p>
                     <p class="mb-0 fw-semibold h5" id="email"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                     <p class="text-muted">NPWP</p>
                     <p class="mb-0 fw-semibold h5" id="npwp"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                     <p class="text-muted">Alamat</p>
                     <p class="mb-0 fw-semibold h5" id="alamat"></p>
                  </div>
               </div>
            </div>
            <!-- Kontak Darurat -->
            <div id="div-kontak-darurat">
               <hr class="my-4">
               <div class="text-center mb-3">
                  <h3 class="fw-bold">Kontak Darurat</h3>
               </div>
               <div class="row g-3">
                  <div class="col-md-6">
                     <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                        <p class="text-muted">Nama</p>
                        <p class="mb-0 fw-semibold h5" id="kontak-darurat"></p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                        <p class="text-muted">No. HP</p>
                        <p class="mb-0 fw-semibold h5" id="nomor-darurat"></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Informasi Data Profesi -->
   <div class="col-12">
        <!-- Informasi Data Profesi -->
        <div class="card shadow-sm border rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h3 class="mb-0 fw-bold">Informasi Data Profesi</h3>
                </div>

                <!-- Baris 1: Kategori & Profesi -->
                <div class="row mb-4 g-3">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                            <p class="text-muted">Kategori</p>
                            <p class="mb-0 h5" id="profesi"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                            <p class="text-muted">Profesi</p>
                            <p class="mb-0 h5" id="ketegori-profesi"></p>
                        </div>
                    </div>
                </div>

                <!-- Baris 2: STR & SIP -->
                <div class="row g-3">
                    <!-- Surat Tanda Registrasi (STR) -->
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-color: #e6edfb">
                            <p class="text-muted">Surat Tanda Register (STR)</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="mb-0 h5" id="nomor-str"></p>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#strModal">
                                    Lihat STR
                                </button>
                            </div>
                            <div class="row g-2 mt-2">
                            <div class="col-auto">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill" style="border: 1px solid #000; font-size: 0.9rem;" id="status-str"></span>
                            </div>
                            <div class="col-auto">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill" style="border: 1px solid #000; font-size: 0.9rem;" id="periode-str"></span>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- Surat Izin Praktik (SIP) -->
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background-COLOR: #E6EDFB">
                            <p class="text-muted">Surat Izin Praktik (SIP)</p>
                            <div id="list-sip-container">
                                <!-- SIP items will be populated here dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal STR -->
        <div class="modal fade" id="strModal" tabindex="-1" aria-labelledby="strModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="strModalLabel">Surat Tanda Registrasi (STR)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Kolom Kiri: Detail -->
                            <div class="col-lg-6 =">
                                <div class="mb-3">
                                    <strong>Nomor STR:</strong>
                                    <p class="h5 mb-0" id="modalNomorSTR"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Status:</strong>
                                    <p class="h5 mb-0" id="modalStatusSTR"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Periode Awal:</strong>
                                    <p class="h5 mb-0" id="modalPeriodeAwalSTR"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Periode Akhir:</strong>
                                    <p class="h5 mb-0" id="modalPeriodeAkhirSTR"></p>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Gambar -->
                            <div class="col-lg-6">
                                <img id="strImage" src="" alt="Gambar STR" class="img-fluid rounded-3 shadow-sm" style="max-height: 70vh; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="#" id="downloadSTR" class="btn btn-primary" target="_blank">
                            <i class="ti ti-download"></i> Download STR
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal SIP -->
        <div class="modal fade" id="sipModal" tabindex="-1" aria-labelledby="sipModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sipModalLabel">Surat Izin Praktik (SIP)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Kolom Kiri: Detail -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <strong>Nomor SIP:</strong>
                                    <p class="h5 mb-0" id="detailNomorSIP"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Periode Awal:</strong>
                                    <p class="h5 mb-0" id="detailPeriodeAwalSIP"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Periode Akhir:</strong>
                                    <p class="h5 mb-0" id="detailPeriodeAkhirSIP"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Penerbit:</strong>
                                    <p class="h5 mb-0" id="detailDaerahPenerbitSIP"></p>
                                </div>
                                <div class="mb-3">
                                    <strong>Tempat Praktik:</strong>
                                    <p class="h5 mb-0" id="detailTempatPraktik"></p>
                                </div>
                                <div class="mb-3" id="div-nama-penerbit" style="display: none;">
                                    <strong>Nama Penerbit:</strong>
                                    <p class="h5 mb-0" id="namaPenerbitSIP"></p>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Gambar -->
                            <div class="col-lg-6">
                                <img id="sipImage" src="" alt="Gambar SIP" class="img-fluid rounded-3 shadow-sm" style="max-height: 70vh; object-fit: contain;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a href="#" id="downloadSIP" class="btn btn-primary" target="_blank">
                            <i class="ti ti-download"></i> Download SIP
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
{{-- custom js --}}
@vite(['resources/js/v1/pi/kepesertaan.js', 'resources/js/v1/pi/count-message.js'])
@endpush
