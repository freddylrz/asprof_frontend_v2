@extends('v1.layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="text-center mb-5">
           <p class="h1">Laporan Awal Klaim</p>
        </div>
    </div>

    <div class="col-12">
        <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175); border: 2px solid #dddddd;">
            <div class="card-body px-0">
                <div class="text-center mb-5">
                    <h3>Informasi Peserta</h3>
                </div>
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
                                    <p class="text-muted mb-1">NIK</p>
                                    <h5 class="mb-0" id="nik-peserta">3321110110030029</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Nomor STR -->
                    <div class="col-12 col-lg-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-s bg-light-secondary">
                                        <i class="ti ti-id f-32"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1">Nomor STR</p>
                                    <h5 class="mb-0" id="nomor-str">AS35535355335346</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- NPWP -->
                    <div class="col-12 col-lg-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-s bg-light-secondary">
                                        <i class="ti ti-receipt f-32"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-1">NPWP</p>
                                    <h5 class="mb-0" id="npwp">4363666346545555</h5>
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
                <h3>Formulir Pengajuan Klaim</h3>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="form-group">
                     <label class="form-label required">Pilih SIP</label>
                     <select class="form-control" data-trigger name="str" id="pilih-str">
                        <option value="1">12498057202543595 - Primaya Hospital Depok</option>
                        <option value="2">80509252903345347 - Rumah Sakit Mitra Keluarga Depok</option>
                     </select>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label required">Tanggal kejadian</label>
                     <div class="input-group date mb-3">
                        <input type="text" class="form-control datepicker-bs5" placeholder="Tanggal kejadian" id="periode-awal-str">
                        <span class="input-group-text">
                        <i class="feather icon-calendar"></i>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label required">Estimasi Besarnya klaim</label>
                     <input type="text" class="form-control" placeholder="Estimasi Besarnya klaim" id="nomor-sip">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label required">Keterangan</label>
                     <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Keterangan"></textarea>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label required">Unggah Laporan Awal Klaim</label>
                     <input type="file" class="form-control" id="unggah-laporan-awal" accept=".jpg, .jpeg, .png">
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <button type="reset" class="btn btn-danger">Batal</button>
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
<script src="{{ asset('storage/v1/dashboard.js?v=1') }}"></script>
@endpush
@push('levelScriptsJs')
