@extends('v1.layouts.app') {{-- Perbaikan typo: v1.layouts..app -> v1.layouts.app --}}
@push('levelPluginsJsh')
<style>
   .required:after {
   content:" *";
   color: red;
   }
</style>
@endpush
@section('content')
<div class="container">
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <div class="text-center mb-5">
         <h1 class="text-center">Revisi Data</h1>
         <p class="h1" id="nomor-register"></p>
      </div>
      <div class="text-center mb-5">
         <div class="multisteps-form__progress">
            <div class="multisteps-form__progress-btn" id="poin-satu">Proses<br>Pendaftaran <span class="badge d-inline-block badge-bottom" id="status-poin-satu"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-dua">Proses<br>Persetujuan <span class="badge d-inline-block badge-bottom" id="status-poin-dua"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-lima">Proses<br>Konfirmasi <span class="badge d-inline-block badge-bottom" id="status-poin-lima"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-tiga">Proses<br>Pembayaran <span class="badge d-inline-block badge-bottom" id="status-poin-tiga"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-empat">Proses<br>Polis <span class="badge d-inline-block badge-bottom" id="status-poin-empat"></span></div>
         </div>
      </div>
      <div class="alert alert-warning h4" role="alert" style="display: flex; align-items: middle" id="div-revision-alert">
         <i class="ti ti-info-circle mx-2" style="font-size: 1.5rem; font-weight: 900; flex-shrink: 0;"></i>
         <span id="revision-alert" style="flex: 1;"></span>
      </div>
      <div class="card bg-light my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="auth-tab-1" data-bs-toggle="tab" href="#auth-1" role="tab" data-slide-index="1" aria-controls="auth-1" aria-selected="true"></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="auth-tab-2" data-bs-toggle="tab" href="#auth-2" role="tab" data-slide-index="2" aria-controls="auth-2" aria-selected="true"></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="auth-tab-3" data-bs-toggle="tab" href="#auth-3" role="tab" data-slide-index="3" aria-controls="auth-3" aria-selected="true"></a>
               </li>
            </ul>
            <form id="updateData" role="form" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="tab-content">
                  <div class="tab-pane show active" id="auth-1" role="tabpanel" aria-labelledby="auth-tab-1">
                     <div class="text-center mb-5">
                        <h3 class="text-center">Informasi Data Profesi</h3>
                     </div>
                     <div class="row my-2">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="form-label required">Profesi</label>
                              <select class="form-control" data-trigger name="profesi_id" id="profesi">
                                 <option value="1">Tenaga Medis</option>
                                 <option value="2">Tenaga Kesehatan</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="form-label required">Kategori Profesi</label>
                              <select class="form-control" data-trigger name="profesi_kategori_id" id="kategori-profesi">
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row my-4">
                        <div class="col-12">
                           <div class="card border border-success">
                              <div class="card-header bg-success">
                                 <h4 class="text-white mb-0"><i class="ti ti-file-certificate me-1"></i>Surat Tanda Registrasi</h4>
                              </div>
                              <div class="card-body">
                                 <div class="row my-2">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label class="form-label required">Nomor STR</label>
                                          <input type="text" class="form-control enambelas" name="str_no" id="nomor-str" placeholder="Masukan nomor STR">
                                       </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                       <div class="form-group form-check">
                                          <input type="checkbox" class="form-check-input" name="str_stat" id="status-str" value="1">
                                          <label for="status-str" class="form-check-label ml-2">STR sudah berlaku seumur hidup</label>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row my-2">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label class="form-label required">Unggah STR</label>
                                          <input type="file" class="form-control" id="unggah-str" accept=".jpg, .jpeg, .png">
                                          <small class="form-text text-muted">Anda hanya dapat mengunggah gambar atau foto dengan format JPG atau PNG.</small>
                                       </div>
                                    </div>
                                    <div class="col-lg-6" id="periode-awal-str-container" style="display: none;">
                                       <div class="form-group">
                                          <label class="form-label required">Periode Awal STR</label>
                                          <div class="input-group date mb-3">
                                             <input type="text" class="form-control datepicker-bs5" placeholder="Masukan periode awal STR" id="periode-awal-str">
                                             <span class="input-group-text">
                                             <i class="feather icon-calendar"></i>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6" id="periode-akhir-str-container">
                                       <div class="form-group">
                                          <label class="form-label required">Periode Akhir STR</label>
                                          <div class="input-group date mb-3">
                                             <input type="text" class="form-control datepicker-bs5" placeholder="Masukan periode akhir STR" id="periode-akhir-str">
                                             <span class="input-group-text">
                                             <i class="feather icon-calendar"></i>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 mt-4">
                           <!-- Perubahan: Hapus class sip-cards-container dari .row -->
                           <div class="row" id="sip-cards-container">
                              <!-- SIP cards will be dynamically added here -->
                           </div>
                           <div class="text-center mt-3">
                              <button type="button" class="btn btn-primary d-inline-flex" id="btn-tambah-sip">
                              <i class="ti ti-plus me-1"></i>Tambah SIP
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="row justify-content-end">
                        <div class="col-sm-6">
                           <div class="d-grid">
                              <button class="btn btn-lg btn-primary change-tab-btn" data-tab="#auth-2" type="button">Selanjutnya</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="auth-2" role="tabpanel" aria-labelledby="auth-tab-2">
                     <div class="text-center mb-5">
                        <h3 class="text-center">Informasi Data Pribadi</h3>
                     </div>
                     <div class="row my-2">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Nama</label>
                              <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan nama">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">NIK</label>
                              <input type="text" class="form-control enambelas" name="nik" id="nik" placeholder="Masukan NIK">
                           </div>
                        </div>
                     </div>
                     <div class="row my-2">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Tempat Lahir</label>
                              <input type="text" class="form-control" name="tempat-lahir" id="tempat-lahir" placeholder="Masukan Tempat Lahir">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Tanggal Lahir</label>
                              <div class="input-group date mb-3">
                                 <input type="text" class="form-control datepicker-bs5" name="tanggal_lahir" placeholder="Masukan tanggal lahir" id="tanggal-lahir">
                                 <span class="input-group-text">
                                 <i class="feather icon-calendar"></i>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row my-2">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Jenis Kelamin</label>
                              <select class="form-control" data-trigger name="jenis_kelamin" id="jenis-kelamin">
                                 <option value="1">Laki-laki</option>
                                 <option value="2">Perempuan</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Nomor Handphone</label>
                              <input type="text" class="form-control mob_no" data-mask="9999-999-999" name="no_hp" id="nomor-handphone" placeholder="Masukan nomor handphone">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="Masukan alamat email" readonly>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Unggah KTP</label>
                              <input type="file" class="form-control" name="fileInputKTP" id="unggah-ktp" accept=".jpg, .jpeg, .png">
                              <a id="file_ktp" class="btn btn-primary mt-2" target="_blank"></a>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">NPWP</label>
                              <input type="text" class="form-control enambelas" name="npwp" id="npwp" placeholder="Masukan NPWP">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Alamat Domisili</label>
                              <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukan alamat tempat tinggal"></textarea>
                           </div>
                        </div>
                     </div>
                     <hr>
                     <div class="text-center mb-5">
                        <h3 class="text-center">Kontak Darurat</h3>
                     </div>
                     <div class="row my-2">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Nama</label>
                              <input type="text" class="form-control" id="nama-kontak-darurat" placeholder="Masukan nama kontak darurat">
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Nomor Handphone</label>
                              <input type="text" class="form-control mobilenumber" id="nomor-kontak-darurat" placeholder="Masukan nomor kontak darurat">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="d-grid">
                              <button class="btn btn-lg btn-outline-secondary mb-4 change-tab-btn" data-tab="#auth-1" type="button">Sebelumnya</button>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="d-grid">
                              <button class="btn btn-lg btn-primary mb-4 change-tab-btn" data-tab="#auth-3" type="button">Selanjutnya</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="auth-3" role="tabpanel" aria-labelledby="auth-tab-3">
                     <div class="text-center mb-5">
                        <h3 class="text-center">Pilih Asuransi dan Plan</h3>
                     </div>
                     <div class="row my-2">
                        <div class="col-lg-12">
                           <div class="text-center">
                              <p class="h4">Asuransi dan Plan</p>
                           </div>
                           <div class="row my-2">
                              <div class="col-lg-12">
                                 <label class="h5 required">Pilih Asuransi</label>
                                 <div class="row my-2" id="daftar-asuransi">
                                 </div>
                              </div>
                           </div>
                           <div class="row my-2" id="div-biaya-kepesertaan" style="display: none">
                              <div class="col-lg-12">
                                 <label class="h5 required">Pilih Plan</label>
                                 <div class="row my-2" id="biaya-kepesertaan">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="d-grid">
                              <button class="btn btn-lg btn-outline-secondary mb-4 change-tab-btn" data-tab="#auth-2" type="button">Sebelumnya</button>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="d-grid">
                              <button class="btn btn-lg btn-primary mb-4" type="submit">Kirim</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="card-footer">
            <div class="row ">
               <div class="col-lg-12">
                  <p class="h5">Keterangan: (<i class=" text-danger">*</i>) Wajib diisi</p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <div class="card bg-light my-5" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body d-flex justify-content-between">
            <div>
               <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-log" id="btn_log">
               <i class="ti ti-eye me-1"></i> Log Status
               </button>
            </div>
            <div class="modal fade" id="modal-log">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header bg-success">
                        <h4 class="modal-title" style=" color: #fff;">Log Status</h4>
                     </div>
                     <div class="modal-body task-card">
                        <ul class="list-unstyled task-list" id="list-log">
                        </ul>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-right" data-bs-dismiss="modal">Tutup</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@push('levelPluginsJsh')
<!-- custom css for multistep -->
<link rel="stylesheet" href="{{ asset('assets/css/multistep.css?v=2') }}" />
@endpush
@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<!-- choices js -->
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<!-- bootstrap-datepicker -->
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js')}}"></script>
<!-- input mask -->
<script src="{{ asset('assets/js/plugins/jquery.inputmask.bundle.min.js')}}"></script>
<script>
   // Pass to JavaScript
   window.reqId = @json($reqId);
</script>
{{-- custom js --}}
@vite(['resources/js/v1/pi/update.js'])
@endpush
