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
         <p class="h1">Form Pengajuan Awal Klaim<br> <b id="klaim-profesi"></b></p>
      </div>
   </div>

   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <form id="form-pengajuan-klaim" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="row">

                  <!-- Bagian Kiri: Informasi Polis & Dokumen & Kontak Alternatif Peserta -->
                  <div class="col-lg-6" style="border-right: 2px solid #dddddd;">

                     <!-- Informasi Polis -->
                     <h3 class="mb-3"><strong>Informasi Polis</strong></h3>
                     <hr style="border-top: 2px solid #000000;">
                     <div class="row g-3">
                        <div class="col-12">
                           <label for="nama-peserta" class="form-label">Nama Peserta</label>
                           <input type="text" class="form-control bg-light" id="nama-peserta" name="nama_peserta" disabled>
                        </div>
                        <div class="col-6">
                           <label for="no-sertifikat" class="form-label">No. Sertifikat</label>
                           <input type="text" class="form-control bg-light" id="no-sertifikat" name="no_sertifikat" disabled>
                        </div>
                        <div class="col-6">
                           <label for="asuransi" class="form-label">Asuransi</label>
                           <input type="text" class="form-control bg-light" id="asuransi" name="asuransi" disabled>
                        </div>
                        <div class="col-6">
                           <label for="periode-polis" class="form-label">Periode Polis</label>
                           <input type="text" class="form-control bg-light" id="periode-polis" name="periode_polis" disabled>
                        </div>
                        <div class="col-6">
                           <label for="jaminan-pertanggungan" class="form-label">Jaminan Pertanggungan</label>
                           <input type="text" class="form-control bg-light" id="jaminan-pertanggungan" name="jaminan_pertanggungan" disabled>
                        </div>
                        <div class="col-6">
                           <label for="no-hp" class="form-label">No. HP</label>
                           <input type="text" class="form-control bg-light" id="no-hp" name="no_hp" disabled>
                        </div>
                        <div class="col-6">
                           <label for="email" class="form-label">Email</label>
                           <input type="email" class="form-control bg-light" id="email" name="email_peserta" disabled>
                        </div>
                        <div class="col-6">
                           <label for="profesi" class="form-label">Profesi</label>
                           <input type="text" class="form-control bg-light" id="profesi" name="profesi" disabled>
                        </div>
                        <div class="col-6">
                           <label for="no-str" class="form-label">No. STR</label>
                           <input type="text" class="form-control bg-light" id="no-str" name="no_str" disabled>
                        </div>
                        <div class="col-6">
                           <label for="no-sip" class="form-label">No. SIP <span class="required">*</span></label>
                           <div class="input-group">
                              <input type="text" class="form-control" id="no-sip" name="no_sip" placeholder="Pilih SIP" readonly>
                              <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#sipModal">
                                 <i class="ti ti-search"></i>
                              </button>
                           </div>
                        </div>
                        <div class="col-6">
                           <label for="tempat-praktik" class="form-label">Tempat Praktik</label>
                           <textarea class="form-control" id="tempat-praktik" name="tempat_praktik" disabled rows="2"></textarea>
                        </div>
                     </div>

                     <!-- Kontak Alternatif Peserta -->
                     <h3 class="mt-4 mb-3"><strong>Informasi Kontak Alternatif Peserta</strong></h3>
                     <hr style="border-top: 2px solid #000000;">
                     <div class="row g-3">
                        <div class="col-6">
                           <label for="peserta-kontak-nama" class="form-label">Nama Kontak Alternatif</label>
                           <input type="text" class="form-control" id="peserta-kontak-nama" name="peserta_kontak_nama" placeholder="Nama kontak alternatif">
                        </div>
                        <div class="col-6">
                           <label for="peserta-kontak-no-hp" class="form-label">Nomor HP</label>
                           <input type="text" class="form-control mobilenumber" id="peserta-kontak-no-hp" name="peserta_kontak_no_hp" placeholder="Nomor HP kontak">
                        </div>
                        <div class="col-12">
                           <p class="text-muted small">Kontak alternatif adalah pihak yang dapat dihubungi jika peserta tidak dapat dihubungi.</p>
                        </div>
                     </div>

                     <!-- Dokumen -->
                     <h3 class="mt-4 mb-3">Dokumen</h3>
                     <hr style="border-top: 2px solid #000000;">
                     <div class="row g-3" id="dokumen-container">
                        <div class="col-12">
                           <p class="text-muted"><i>Silahkan pilih SIP terlebih dahulu</i></p>
                        </div>
                     </div>

                  </div> <!-- End col-lg-6 kiri -->

                  <!-- Bagian Kanan: Informasi Pasien & Klaim & Kontak Alternatif Pasien -->
                  <div class="col-lg-6">

                     <!-- Informasi Data Pasien -->
                     <h3 class="mb-3"><strong>Informasi Data Pasien</strong></h3>
                     <hr style="border-top: 2px solid #000000;">
                     <div class="row g-3">
                        <div class="col-12">
                           <label for="nama-pasien" class="form-label">Nama Pasien <span class="required">*</span></label>
                           <input type="text" class="form-control" id="nama-pasien" name="nama_pasien" placeholder="Masukkan nama pasien">
                        </div>
                        <div class="col-6">
                           <label for="usia-pasien" class="form-label">Usia <span class="required">*</span></label>
                           <div class="input-group">
                              <input type="number" class="form-control" id="usia-pasien" name="usia_pasien" min="0" max="150" placeholder="Usia">
                              <span class="input-group-text">Tahun</span>
                           </div>
                        </div>
                        <div class="col-6">
                           <label for="jenis-kelamin-pasien" class="form-label">Jenis Kelamin <span class="required">*</span></label>
                           <select class="form-select" id="jenis-kelamin-pasien" name="jenis_kelamin_pasien">
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="1">Laki-laki</option>
                              <option value="2">Perempuan</option>
                           </select>
                        </div>
                        <div class="col-6">
                           <label for="email-pasien" class="form-label">Email<span class="required">*</span></label>
                           <input type="email" class="form-control" id="email-pasien" name="email_pasien" placeholder="Email pasien">
                        </div>
                        <div class="col-6">
                           <label for="no-hp-pasien" class="form-label">Nomor HP<span class="required">*</span></label>
                           <input type="text" class="form-control mobilenumber" id="no-hp-pasien" name="no_hp_pasien" placeholder="Nomor HP pasien">
                        </div>
                     </div>

                     <!-- Informasi Awal Klaim -->
                     <h3 class="mt-4 mb-3"><strong>Informasi Awal Klaim</strong></h3>
                     <hr style="border-top: 2px solid #000000;">
                     <div class="row g-3">
                        <div class="col-6">
                           <label for="tanggal-pengaduan" class="form-label">Tanggal Pengaduan <span class="required">*</span></label>
                           <input type="text" class="form-control datepicker-bs5" id="tanggal-pengaduan" name="tanggal_pengaduan" disabled >
                        </div>
                        <div class="col-6">
                           <label for="tanggal-kejadian" class="form-label">Tanggal Kejadian <span class="required">*</span></label>
                           <input type="text" class="form-control datepicker-bs5" id="tanggal-kejadian" name="tanggal_kejadian" placeholder="Pilih tanggal kejadian" >
                        </div>
                        <div class="col-6">
                           <label for="lokasi-kejadian" class="form-label">Lokasi Kejadian <span class="required">*</span></label>
                           <input type="text" class="form-control" id="lokasi-kejadian" name="lokasi_kejadian" placeholder="Lokasi kejadian" >
                        </div>
                        <div class="col-6">
                           <label for="jenis-tuntutan" class="form-label">Jenis Tuntutan / Gugatan<span class="required">*</span></label>
                           <input type="text" class="form-control" id="jenis-tuntutan" name="jenis_tuntutan" placeholder="Jenis tuntutan hukum" >
                        </div>
                        <div class="col-12">
                           <label for="kronologis-kejadian" class="form-label">Kronologis Kejadian <span class="required">*</span></label>
                           <textarea class="form-control" id="kronologis-kejadian" name="kronologis_kejadian" rows="4" placeholder="Jelaskan kronologis kejadian secara lengkap" ></textarea>
                        </div>
                     </div>

                     <!-- Kontak Wali Pasien -->
                     <h3 class="mt-4 mb-3"><strong>Informasi Wali Pasien</strong></h3>
                     <hr style="border-top: 2px solid #000000;">
                     <div class="row g-3">
                        <div class="col-12">
                           <label for="pasien-wali-nama" class="form-label">Nama Wali Pasien</label>
                           <input type="text" class="form-control" id="pasien-wali-nama" name="pasien_wali_nama" placeholder="Nama kontak wali pasien">
                        </div>
                        <div class="col-6">
                           <label for="pasien-wali-hubungan" class="form-label">Hubungan dengan Pasien</label>
                           <input type="text" class="form-control" id="pasien-wali-hubungan" name="pasien_wali_hubungan" placeholder="Misal: Istri, Anak, Saudara">
                        </div>
                        <div class="col-6">
                           <label for="pasien-wali-no-hp" class="form-label">Nomor HP</label>
                           <input type="text" class="form-control mobilenumber" id="pasien-wali-no-hp" name="pasien_wali_no_hp" placeholder="Nomor HP kontak">
                        </div>
                        <div class="col-12">
                           <p class="text-muted small">Kontak wali adalah pihak yang dapat dihubungi jika pasien tidak dapat dihubungi.</p>
                        </div>
                     </div>

                  </div> <!-- End col-lg-6 kanan -->

               </div> <!-- End row utama dalam card-body -->
            </form>
         </div> <!-- End card-body -->

         <div class="card-footer d-flex justify-content-between align-items-center">
            <p class="mb-0"><em>Catatan: tanda ( <span class="required">*</span> ) wajib diisi</em></p>
            <button type="submit" form="form-pengajuan-klaim" class="btn btn-primary me-2">
               <i class="ti ti-mail-forward me-1"></i> Submit
            </button>
         </div>

      </div> <!-- End card -->
   </div> <!-- End col-12 -->
</div> <!-- End row utama -->

<!-- Modal Pilih SIP -->
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
                  <div class="mt-2">Memuat daftar SIP...</div>
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
<script src="{{ asset('assets/js/plugins/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js') }}"></script>
@vite(['resources/js/v1/pi/klaim/input.js'])
@endpush
