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
                  <div class="offer-check border border-dark rounded p-3">
                     <div class="form-check">
                        <input type="radio" name="radio1" class="form-check-input input-primary" id="sip-radio1" />
                        <label class="form-check-label d-block" for="sip-radio1">
                           <div class="row">
                              <div class="col-12 col-md-6 col-lg-12 m-b-10">
                                 <span class="mb-2 d-block">Nomor SIP:</span>
                                 <span class="h5 mb-1 d-block">sip/du/774490/2024</span>
                                 <h6 class="text-muted offer-details">
                                    <i><i class="ti ti-calendar-time"></i> 2020-05-06 s/d 2025-05-06</i>
                                 </h6>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 m-b-10">
                                 <span class="mb-2 d-block">Tempat Praktik:</span>
                                 <span class="h5 mb-1 d-block">RS Pelita Jaya Harapan Bangsa Negara</span>
                              </div>
                           </div>
                        </label>
                     </div>
                  </div>
                  <div class="offer-check border border-dark rounded p-3">
                     <div class="form-check">
                        <input type="radio" name="radio1" class="form-check-input input-primary" id="sip-radio2" />
                        <label class="form-check-label d-block" for="sip-radio2">
                           <div class="row">
                              <div class="col-12 col-md-6 col-lg-12 m-b-10">
                                 <span class="mb-2 d-block">Nomor SIP:</span>
                                 <span class="h5 mb-1 d-block">sip/du/774490/2024</span>
                                 <h6 class="text-muted offer-details">
                                    <i><i class="ti ti-calendar-time"></i> 2020-05-06 s/d 2025-05-06</i>
                                 </h6>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 m-b-10">
                                 <span class="mb-2 d-block">Tempat Praktik:</span>
                                 <span class="h5 mb-1 d-block">RS Pelita Jaya Harapan Bangsa Negara</span>
                              </div>
                           </div>
                        </label>
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
                              <input type="text" class="form-control datepicker-bs5" placeholder="Tanggal kejadian" id="tamggal-kejadian">
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
{{-- custom js --}}
@vite(['resources/js/v1/pi/klaim.js'])
@endpush
@push('levelScriptsJs')
