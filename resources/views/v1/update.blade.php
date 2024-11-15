@extends('v1.layouts..app')
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
            <div class="multisteps-form__progress-btn" id="poin-satu">Pendaftaran <span class="badge d-block badge-bottom" id="status-poin-satu"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-dua">Validasi <span class="badge d-block badge-bottom" id="status-poin-dua"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-tiga">Pembayaran <span class="badge d-block badge-bottom" id="status-poin-tiga"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-empat">Polis <span class="badge d-block badge-bottom" id="status-poin-empat"></span></div>
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
            </ul>
            <form id="updateData" role="form" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="tab-content">
                  <div class="tab-pane show active" id="auth-1" role="tabpanel" aria-labelledby="auth-tab-1">
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
                              {{-- <small class="form-text text-muted d-block">Anda hanya dapat mengunggah gambar atau foto dengan format JPG atau PNG.</small> --}}
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
                        <h3 class="text-center">Informasi Data Profesi</h3>
                     </div>
                     <div class="row my-4">
                        <label class="form-label required">Profesi</label>
                        <div class="col-sm-12 col-md-6">
                           <div class="auth-option">
                              <input type="radio" class="btn-check" name="profesi_id" id="option1" value="1" checked />
                              <label class="auth-megaoption" for="option1">
                              <i class="fas fa-user-md mb-2" style="font-size: 5rem;"></i>
                              <span class="h3">Tenaga Medis</span>
                              </label>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                           <div class="auth-option">
                              <input type="radio" class="btn-check" name="profesi_id" id="option2" value="2" />
                              <label class="auth-megaoption" for="option2">
                              <i class="fas fa-user-nurse mb-2" style="font-size: 5rem;"></i>
                              <span class="h3">Tenaga Kesehatan</span>
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="row my-2">
                        <div class="col-lg-12">
                           <div class="form-group">
                              <label class="form-label required">Kategori Profesi</label>
                              <select
                                 class="form-control"
                                 data-trigger
                                 name="profesi_kategori_id"
                                 id="kategori-profesi"
                                 >
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row my-4">
                        <label class="form-label required m-b-10">Dokumen yang dibutuhkan</label>
                        <div class="col-12 col-sm-6 m-b-25">
                           <div id="strModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="strModalTitle" aria-hidden="true">
                              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                 <div class="modal-content border border-success">
                                    <div class="modal-header bg-success">
                                       <h3 class="modal-title" id="strModalTitle" style="color: #fff"><i class="ti ti-file-certificate me-1"></i>Surat Tanda Registrasi</h3>
                                       <button type="button" class="btn btn-icon btn-lg text-light" data-bs-dismiss="modal" aria-label="Close">
                                       <i class="ti ti-x" style="font-size: 24px; font-weight:500"></i>
                                       </button>
                                    </div>
                                    <div class="modal-body">
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
                                    <div class="modal-footer">
                                       <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="d-grid">
                              <button type="button" class="btn btn-lg btn-success" data-bs-toggle="modal"
                                 data-bs-target="#strModal"><i class="ti ti-file-certificate me-1"></i>Surat Tanda Registrasi</button>
                           </div>
                        </div>
                        <div class="col-12 col-sm-6 m-b-25">
                           <div id="sipModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="sipModalTitle" aria-hidden="true">
                              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                 <div class="modal-content border border-danger">
                                    <div class="modal-header bg-danger">
                                       <h3 class="modal-title" id="sipModalTitle" style="color: #fff"><i class="ti ti-building-hospital me-1"></i>Surat Izin Praktik</h3>
                                       <button type="button" class="btn btn-icon btn-lg text-light" data-bs-dismiss="modal" aria-label="Close">
                                       <i class="ti ti-x" style="font-size: 24px; font-weight:500"></i>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div id="tambahTempatPraktik" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahTempatPraktikTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-title" id="tambahTempatPraktikTitle">Tambah Surat Izin Praktik</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row my-2">
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label class="form-label required">Nomor SIP</label>
                                                            <input type="text" class="form-control" placeholder="Masukan nomor SIP" id="nomor-sip">
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label class="form-label required">Unggah SIP</label>
                                                            <input type="file" class="form-control" id="unggah-sip" accept=".jpg, .jpeg, .png">
                                                            <small class="form-text text-muted">Anda hanya dapat mengunggah gambar atau foto dengan format JPG atau PNG.</small>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6" id="periode-awal-sip-container">
                                                         <div class="form-group">
                                                            <label class="form-label required">Periode Awal SIP</label>
                                                            <div class="input-group date mb-3">
                                                               <input type="text" class="form-control datepicker-bs5" placeholder="Mulai Berlaku" id="periode-awal-sip">
                                                               <span class="input-group-text">
                                                               <i class="feather icon-calendar"></i>
                                                               </span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6" id="periode-akhir-sip-container">
                                                         <div class="form-group">
                                                            <label class="form-label required">Periode Akhir SIP</label>
                                                            <div class="input-group date mb-3">
                                                               <input type="text" class="form-control datepicker-bs5" placeholder="Tanggal Berakhir" id="periode-akhir-sip">
                                                               <span class="input-group-text">
                                                               <i class="feather icon-calendar"></i>
                                                               </span>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label class="form-label required">Penerbit SIP</label>
                                                            <select
                                                               class="form-control"
                                                               data-trigger
                                                               name="daerah-penerbit-sip"
                                                               id="daerah-penerbit-sip"
                                                               >
                                                            </select>
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label class="form-label required">Tempat Praktik</label>
                                                            <input type="text" class="form-control" id="tempat-praktik" placeholder="Masukan Tempat Praktik">
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6" id="div-nama-penerbit" style="display: none">
                                                         <div class="form-group">
                                                            <label class="form-label required">Nama Penerbit SIP</label>
                                                            <input type="text" class="form-control" id="nama-penerbit-sip" placeholder="Masukan Nama Penerbit">
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" id="saveChanges" class="btn btn-primary">Simpan</button>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="d-flex justify-content-between">
                                          <h3>Daftar SIP Anda</h3>
                                          <button type="button" class="btn btn-primary d-inline-flex btntambahTempatPraktik"><i class="ti ti-plus me-1"></i>Tambah Data</button>
                                       </div>
                                       <div class="accordion accordion-flush my-4" id="accordionFlushExample"></div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="d-grid">
                              <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal"
                                 data-bs-target="#sipModal"><i class="ti ti-building-hospital me-1"></i>Surat Izin Praktik</button>
                           </div>
                        </div>
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
                              <button class="btn btn-lg btn-outline-secondary mb-4 change-tab-btn" data-tab="#auth-1" type="button">Sebelumnya</button>
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
