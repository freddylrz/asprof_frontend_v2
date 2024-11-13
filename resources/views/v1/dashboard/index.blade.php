@extends('v1.layouts..dashboard')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="text-center mb-5">
         <p class="h1">Data Kepesertaan</p>
         <p class="h1" id="nomor-register"></p>
      </div>
      <div class="card available-balance-card bg-danger my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;" id="div-polis-alert">
         <div class="card-body p-2">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
               <div>
                  <h4 class="mb-0 text-white" id="polis-alert">
                     <i class="ti ti-info-circle mx-2 my-auto" style="font-size: 1.5rem; font-weight: 400; flex-shrink: 0; color: #fff"></i>
                     <span></span>
                  </h4>
               </div>
            </div>
         </div>
      </div>
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body px-0">
            <div class="row">
               <div class="col-12 col-lg-6">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
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
                                 <div class="col-6 col-md-4 d-flex align-items-center justify-content-end" id="status-polis">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li class="list-group-item">
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
                     </li>
                     <li class="list-group-item">
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
                     </li>
                  </ul>
               </div>
               <div class="col-12 col-lg-6">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
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
                     </li>
                     <li class="list-group-item">
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
                     </li>
                     <li class="list-group-item">
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
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="text-center mb-5">
               <p class="h3">Informasi Data Pribadi</p>
            </div>
            <div class="p-3" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Nama</label>
                        <p class="h5" id="nama"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group">
                           <label class="form-label">NIK</label>
                           <p class="h5" id="nik"></p>
                        </div>
                        <div>
                           <a id="file_ktp" class="btn btn-primary" target="_blank"></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Tempat Tanggal Lahir</label>
                        <p class="h5" id="ttl"></p>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <p class="h5" id="jenis-kelamin"></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Nomor Handphone</label>
                        <p class="h5" id="nomor-handphone"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Email</label>
                        <p class="h5" id="email"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">NPWP</label>
                        <p class="h5" id="npwp"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <p class="h5" id="alamat"></p>
                     </div>
                  </div>
               </div>
               <div id="div-kontak-darurat">
                  <hr>
                  <div class="text-center mb-5">
                     <h3 class="text-center">Kontak Darurat</h3>
                  </div>
                  <div class="row my-2">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label">Nama</label>
                           <p class="h5" id="kontak-darurat"></p>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label">Nomor Handphone</label>
                           <p class="h5" id="nomor-darurat"></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="text-center mb-5">
               <p class="h3">Informasi Data Profesi</p>
            </div>
            <div class="row my-4">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="p-3 mb-4" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Profesi</label>
                              <div class="col-sm-12 col-md-12 d-none" id="div-tenaga-medis">
                                 <i class="fas fa-user-md mx-2" style="font-size: 1.5rem;"></i>
                                 <span class="h4">Tenaga Medis</span>
                              </div>
                              <div class="col-sm-12 col-md-12 d-none" id="div-tenaga-kesehatan">
                                 <i class="fas fa-user-nurse mx-2" style="font-size: 1.5rem;"></i>
                                 <span class="h4">Tenaga Kesehatan</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Kategori Profesi</label>
                              <p class="h4" id="ketegori-profesi"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row my-4">
               <div class="col-12 col-md-6">
                  <div class="text-center mb-3">
                     <p class="h4">Surat Tanda Registrasi</p>
                  </div>
                  <div class="p-3 mb-4" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
                     <div class="row">
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">Nomor STR</label>
                              <p class="h5" id="nomor-str"></p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">Status STR</label>
                              <p class="h5" id="status-str"></p>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">File STR</label>
                              <p>
                                 <a id="file_str" class="btn btn-primary" target="_blank"></a>
                              </p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6" id="periode-akhir-str-container">
                           <div class="form-group">
                              <label class="form-label" id="label-str"></label>
                              <p class="h5" id="periode-str"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="text-center mb-3">
                     <p class="h4">Surat Izin Praktik</p>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
                           <div class="">
                              <ul class="list-group" id="list-sip">
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
      </div>
   </div>
</div>
@endsection
@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
{{-- custom js --}}
<script src="{{ asset('storage/v1/dashboard.js?v=3') }}"></script>
@endpush
