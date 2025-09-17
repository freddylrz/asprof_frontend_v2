@extends('v1.layouts.dashboard')
@section('content')

<style>
   .required {
      color: red;
   }
</style>

<div class="row">
   <div class="col-12">
      <div class="text-center mb-3">
         <p class="h1">Form Pengajuan Awal Klaim</p>
      </div>
   </div>

   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="row">
               <!-- Informasi Polis -->
               <div class="col-lg-6">
                  <h3 class="mb-3"><strong>Informasi Polis</strong></h3>
                  <hr style="border-top: 2px solid #000000;">
                  <div class="row g-3">
                     <div class="col-12">
                        <label class="form-label">No. Sertifikat</label>
                        <input type="text" class="form-control bg-light" id="no-sertifikat" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Periode Polis</label>
                        <input type="text" class="form-control bg-light" id="periode-polis" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Jaminan Pertanggungan</label>
                        <input type="text" class="form-control bg-light" id="jaminan-pertanggungan" disabled>
                     </div>
                     <div class="col-12">
                        <label class="form-label">Nama Peserta</label>
                        <input type="text" class="form-control bg-light" id="nama-peserta" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">No. HP</label>
                        <input type="text" class="form-control bg-light" id="no-hp" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control bg-light" id="email" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Profesi</label>
                        <input type="text" class="form-control bg-light" id="profesi" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">No. STR</label>
                        <input type="text" class="form-control bg-light" id="no-str" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">No. SIP <span class="required">*</span></label>
                        <div class="input-group">
                           <input type="text" class="form-control" id="no-sip" placeholder="Pilih SIP" readonly>
                           <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#sipModal">
                              <i class="ti ti-search"></i>
                           </button>
                        </div>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Tempat Praktik</label>
                        <input type="text" class="form-control bg-light" id="tempat-praktik" disabled>
                     </div>
                  </div>

                  <!-- Dokumen -->
                  <h3 class="mt-4 mb-3">Dokumen</h3>
                  <hr style="border-top: 2px solid #000000;">
                  <div class="row g-3" id="dokumen-container">
                     <div class="col-12">
                        <p><i>Silahkan pilih SIP terlebih dahulu</i></p>
                     </div>
                  </div>
               </div>

               <!-- Informasi Data Pasien & Klaim -->
               <div class="col-lg-6">
                  <h3 class="mb-3"><strong>Informasi Data Pasien</strong></h3>
                  <hr style="border-top: 2px solid #000000;">
                  <div class="row g-3">
                     <div class="col-12">
                        <label class="form-label">Nama Pasien <span class="required">*</span></label>
                        <input type="text" class="form-control" id="nama-pasien">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Usia <span class="required">*</span></label>
                        <div class="input-group">
                           <input type="number" class="form-control" id="usia">
                           <span class="input-group-text">Tahun</span>
                        </div>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                        <select class="form-select" id="jenis-kelamin">
                           <option value="">Pilih</option>
                           <option value="L">Laki-laki</option>
                           <option value="P">Perempuan</option>
                        </select>
                     </div>
                  </div>

                  <h3 class="mt-4 mb-3"><strong>Informasi Awal Klaim</strong></h3>
                  <hr style="border-top: 2px solid #000000;">
                  <div class="row g-3">
                     <div class="col-6">
                        <label class="form-label">Tanggal Pengaduan <span class="required">*</span></label>
                        <input type="text" class="form-control datepicker-bs5" id="tanggal-pengaduan" disabled>
                     </div>
                     <div class="col-6">
                        <label class="form-label">Tanggal Kejadian <span class="required">*</span></label>
                        <input type="text" class="form-control datepicker-bs5" id="tanggal-kejadian">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Lokasi Kejadian <span class="required">*</span></label>
                        <input type="text" class="form-control" id="lokasi-kejadian">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Jenis Tuntutan <span class="required">*</span></label>
                        <input type="text" class="form-control" id="jenis-tuntutan">
                     </div>
                     <div class="col-12">
                        <label class="form-label">Kronologis Kejadian <span class="required">*</span></label>
                        <textarea class="form-control" id="kronologis-kejadian" rows="4"></textarea>
                     </div>
                  </div>

                  <h3 class="mt-4 mb-3"><strong>Informasi Kontak Alternatif</strong></h3>
                  <hr style="border-top: 2px solid #000000;">
                  <div class="row g-3">
                     <div class="col-6">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="kontak-nama">
                     </div>
                     <div class="col-6">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" class="form-control mobilenumber" id="kontak-no-hp">
                     </div>
                     <div class="col-12">
                        <p class="text-muted">Kontak alternatif adalah pihak yang dapat dihubungi jika peserta tidak dapat dihubungi.</p>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Catatan -->
            <div class="row mt-4">
               <div class="col-12">
                  <div class="alert alert-light p-2">
                     <p><em>Catatan: tanda ( <span class="required">*</span>) wajib diisi</em></p>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2"><i class="ti ti-mail-forward me-1"></i> Submit</button>
         </div>
      </div>
   </div>
</div>

<!-- Modal SIP -->
<div class="modal fade" id="sipModal" tabindex="-1" aria-labelledby="sipModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="sipModalLabel">Pilih SIP</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div id="sip-list-container">
               <div class="text-center py-3">
                  <div class="spinner-border text-primary" role="status">
                     <span class="visually-hidden">Loading...</span>
                  </div>
                  <div>Memuat daftar SIP...</div>
               </div>
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
<script src="{{ asset('assets/js/plugins/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js')}}"></script>
@vite(['resources/js/v1/pi/klaim/input.js'])
@endpush
