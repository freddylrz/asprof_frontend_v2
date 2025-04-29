@extends('v1.layouts.dashboard')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="text-center mb-3">
         <p class="h1">Pengaduan Klaim</p>
      </div>
   </div>
   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="row">
               <!-- Nama -->
               <div class="col-12 col-lg-6">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item d-flex align-items-center">
                        <div class="flex-shrink-0">
                           <div class="avtar avtar-s bg-light-secondary">
                              <i class="ti ti-user-check f-32"></i>
                           </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                           <p class="text-muted mb-1">Nama</p>
                           <h5 class="mb-0" id="nama-peserta">test daftar tio</h5>
                        </div>
                     </li>
                  </ul>
               </div>
               <!-- NIK -->
               <div class="col-12 col-lg-6">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item d-flex align-items-center">
                        <div class="flex-shrink-0">
                           <div class="avtar avtar-s bg-light-secondary">
                              <i class="ti ti-list-numbers f-32"></i>
                           </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                           <p class="text-muted mb-1">Nomor Polis</p>
                           <h5 class="mb-0" id="nik-peserta">3321110110030029</h5>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                   <h5 class="mt-4 mb-3">Pilih SIP <span class="text-danger">*</span></h5>
                   <div id="sip-container">
                      <div class="text-center py-3">
                         <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                         </div>
                         <div>Memuat data SIP...</div>
                      </div>
                   </div>
                </div>
               <div class="col-lg-6">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label required">Tanggal Lapor<span class="text-danger">*</span></label>
                           <div class="input-group date mb-3">
                              <input type="text" class="form-control datepicker-bs5" placeholder="Tanggal Lapor" id="tanggal-lapor">
                              <span class="input-group-text">
                              <i class="feather icon-calendar"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label required">Tanggal Kejadian <span class="text-danger">*</span></label>
                           <div class="input-group date mb-3">
                              <input type="text" class="form-control datepicker-bs5" placeholder="Tanggal kejadian" id="tanggal-kejadian">
                              <span class="input-group-text">
                              <i class="feather icon-calendar"></i>
                              </span>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label required">Nama PIC <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" placeholder="Nama PIC" id="nama-pic">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label required">Nomor Telpon PIC <span class="text-danger">*</span></label>
                           <input type="text" class="form-control" placeholder="Nomor Telpon PIC" id="nomor-telpon-pic">
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="form-group">
                           <label class="form-label required">Keterangan <span class="text-danger">*</span></label>
                           <textarea class="form-control" id="alamat" name="alamat" rows="4" placeholder="Keterangan"></textarea>
                        </div>
                     </div>
                     <div class="col-lg-12 m-t-10 m-b-20" id="dokumen-container"></div>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div class="text-end">
                     <h6 class="my-auto"><i>Kolom dengan tanda bintang merah (<span class="text-danger">*</span>) wajib diisi</i></h6>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2"><i class="ti ti-mail-forward me-1"></i> Lapor Klaim</button>
         </div>
      </div>
   </div>
</div>
@endsection
@push('levelPluginsJs')
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<!-- bootstrap-datepicker -->
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js')}}"></script>
{{-- custom js --}}
@vite(['resources/js/v1/pi/klaim.js'])
@endpush
@push('levelScriptsJs')
