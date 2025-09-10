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
   <!-- Card Informasi Polis -->
   <div class="col-12">
      <div class="card shadow-sm border rounded-4 my-3">
         <div class="card-body px-0">
            <div class="row">
               <!-- Kolom Kiri -->
               <div class="col-12 col-lg-6">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
                        <div class="bg-light p-3 rounded-3">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-secondary">
                                    <i class="ti ti-certificate f-32"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <div class="row g-1">
                                    <div class="col-12">
                                       <p class="text-muted mb-1">Nomor Polis</p>
                                       <h5 class="mb-0" id="nomor-polis"></h5>
                                    </div>
                                    <div class="col-6 col-md-4 d-flex align-items-center justify-content-end" id="status-polis"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="list-group-item">
                        <div class="bg-light p-3 rounded-3">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-secondary">
                                    <i class="ti ti-building-skyscraper f-32"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <div class="row g-1">
                                    <div class="col-12">
                                       <p class="text-muted mb-1">Asuransi</p>
                                       <h5 class="mb-0" id="asuransi"></h5>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="list-group-item">
                        <div class="bg-light p-3 rounded-3">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-secondary">
                                    <i class="ti ti-calendar-time f-32"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <div class="row g-1">
                                    <div class="col-12">
                                       <p class="text-muted mb-1">Periode Polis</p>
                                       <h5 class="mb-0" id="periode-polis"></h5>
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
                        <div class="bg-light p-3 rounded-3">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-secondary">
                                    <i class="ti ti-shield-check f-32"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <div class="row g-1">
                                    <div class="col-12">
                                       <p class="text-muted mb-1">Jaminan Pertanggungan</p>
                                       <h5 class="mb-0" id="jaminan-pertanggungan"></h5>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="list-group-item">
                        <div class="bg-light p-3 rounded-3">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-secondary">
                                    <i class="ti ti-cash f-32"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <div class="row g-1">
                                    <div class="col-12">
                                       <p class="text-muted mb-1">Nilai Premi</p>
                                       <h5 class="mb-0" id="nilai-premi"></h5>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="list-group-item">
                        <div class="bg-light p-3 rounded-3">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-secondary">
                                    <i class="ti ti-download f-32"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <div class="row g-1">
                                    <div class="col-12">
                                       <p class="text-muted mb-1">Unduh E Sertifikat</p>
                                       <div class="mb-0" id="div-e-sertifikat"></div>
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
   <!-- Informasi Data Pribadi -->
   <div class="col-12">
      <div class="card shadow-sm border rounded-4 mb-4">
         <div class="card-body p-4">
            <div class="text-center mb-4">
               <h3 class="mb-0 fw-bold">Informasi Data Pribadi</h3>
            </div>
            <div class="row g-3">
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3">
                     <p class="text-muted mb-1">Nama</p>
                     <p class="mb-0 h5" id="nama"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3 h-100">
                     <div class="d-flex justify-content-between align-items-start h-100">
                        <div>
                           <p class="text-muted mb-1">NIK</p>
                           <p class="mb-0 h5" id="nik"></p>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary align-self-end" id="file_ktp" target="_blank">Lihat KTP</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3">
                     <p class="text-muted mb-1">Tempat, Tanggal Lahir</p>
                     <p class="mb-0 h5" id="ttl"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3">
                     <p class="text-muted mb-1">Jenis Kelamin</p>
                     <p class="mb-0 h5" id="jenis-kelamin"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3">
                     <p class="text-muted mb-1">No. HP</p>
                     <p class="mb-0 h5" id="nomor-handphone"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3">
                     <p class="text-muted mb-1">Email</p>
                     <p class="mb-0 h5" id="email"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3">
                     <p class="text-muted mb-1">NPWP</p>
                     <p class="mb-0 h5" id="npwp"></p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="bg-light p-3 rounded-3">
                     <p class="text-muted mb-1">Alamat</p>
                     <p class="mb-0 h5" id="alamat"></p>
                  </div>
               </div>
            </div>
            <!-- Kontak Darurat -->
            <div id="div-kontak-darurat" class="mt-4">
               <hr class="my-4">
               <div class="text-center mb-3">
                  <h6 class="fw-bold">Kontak Darurat</h6>
               </div>
               <div class="row g-3">
                  <div class="col-md-6">
                     <div class="bg-light p-3 rounded-3">
                        <p class="text-muted mb-1">Nama</p>
                        <p class="mb-0 h5" id="kontak-darurat"></p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="bg-light p-3 rounded-3">
                        <p class="text-muted mb-1">No. HP</p>
                        <p class="mb-0 h5" id="nomor-darurat"></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Informasi Data Profesi -->
   <div class="col-12">
      <div class="card shadow-sm border rounded-4 mb-4">
         <div class="card-body p-4">
            <div class="text-center mb-4">
               <h3 class="mb-0 fw-bold">Informasi Data Profesi</h3>
            </div>
            <!-- Profesi & Kategori -->
            <div class="row my-3">
               <div class="col-12">
                  <div class="bg-light p-3 rounded-3 mb-3">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Profesi</label>
                              <div class="col-sm-12 col-md-12 d-none" id="div-tenaga-medis">
                                 <i class="fas fa-user-md mx-2" style="font-size: 1.2rem;"></i>
                                 <span class="h6">Tenaga Medis</span>
                              </div>
                              <div class="col-sm-12 col-md-12 d-none" id="div-tenaga-kesehatan">
                                 <i class="fas fa-user-nurse mx-2" style="font-size: 1.2rem;"></i>
                                 <span class="h6">Tenaga Kesehatan</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Kategori Profesi</label>
                              <p class="mb-0 fw-semibold h5" id="ketegori-profesi"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- STR & SIP -->
            <div class="row my-3 g-3">
               <!-- STR -->
               <div class="col-md-6">
                  <div class="text-center mb-2">
                     <p class="h3 mb-0">Surat Tanda Registrasi</p>
                  </div>
                  <div class="bg-light p-3 rounded-3 h-100">
                     <div class="row g-2">
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">Nomor STR</label>
                              <p class="mb-0 fw-semibold h5" id="nomor-str"></p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">Status STR</label>
                              <p class="mb-0 fw-semibold h5" id="status-str"></p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">File STR</label>
                              <p class="mb-0">
                                 <a href="#" class="btn btn-sm btn-outline-primary" id="file_str" target="_blank">Lihat File</a>
                              </p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6" id="periode-akhir-str-container">
                           <div class="form-group">
                              <label class="form-label" id="label-str"></label>
                              <p class="mb-0 fw-semibold h5" id="periode-str"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- SIP -->
               <div class="col-md-6">
                  <div class="text-center mb-2">
                     <p class="h3 mb-0">Surat Izin Praktik</p>
                  </div>
                  <div class="bg-light p-3 rounded-3 h-100">
                     <ul class="list-group list-group-flush" id="list-sip">
                        <!-- Dinamis dari JS -->
                     </ul>
                  </div>
                  <div id="viewDetailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewDetailModalTitle" aria-hidden="true">
                     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="viewDetailModalTitle">Detail Surat Izin Praktik</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="row my-2">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label class="form-label">Nomor SIP</label>
                                       <p class="h5" id="detailNomorSIP"></p>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="form-label">Periode Awal SIP</label>
                                       <p class="h5" id="detailPeriodeAwalSIP"></p>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="form-label">Periode Akhir SIP</label>
                                       <p class="h5" id="detailPeriodeAkhirSIP"></p>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="form-label">Penerbit SIP</label>
                                       <p class="h5" id="detailDaerahPenerbitSIP"></p>
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="form-label">Tempat Praktik</label>
                                       <p class="h5" id="detailTempatPraktik"></p>
                                    </div>
                                 </div>
                                 <div class="col-lg-6" id="div-nama-penerbit" style="display: none">
                                    <div class="form-group">
                                       <label class="form-label">Nama Penerbit SIP</label>
                                       <p class="h5" id="namaPenerbitSIP"></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer justify-content-between">
                              <a id="file_sip" class="btn btn-primary" target="_blank"><i class="ti ti-file"></i> <span class="d-none d-md-inline">SIP</span></a>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                           </div>
                        </div>
                     </div>
                  </div>
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
@vite(['resources/js/v1/pi/dashboard.js', 'resources/js/v1/pi/count-message.js'])
@endpush
