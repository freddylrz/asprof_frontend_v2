@extends('v1.layouts.dashboard')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="text-center mb-3">
         <p class="h1">Detail Klaim</p>
         <h1>PI/KLAIM/202503/00004</h1>
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
                  <div class="form-group">
                     <label class="form-label">Tanggal Lapor</label>
                     <h5>17 March 2025</h5>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Tanggal Kejadian</label>
                     <h5>15 March 2025</h5>
                     <!-- Example date -->
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Surat Izin Praktik (SIP)</label>
                     <h5>12498057202543595 - Primaya Hospital Depok</h5>
                     <!-- Example SIP -->
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Nilai Pengajuan Klaim</label>
                     <h5>Rp 10.000.000</h5>
                     <!-- Example amount -->
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Keterangan</label>
                     <h5>Klaim atas perawatan pasien yang tidak sesuai dengan standar.</h5>
                     <!-- Example description -->
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Nilai Klaim Disetujui</label>
                     <h5>Rp 0</h5>
                     <!-- Example amount -->
                  </div>
               </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-12">
                  <h4 class="mb-3">Dokumen</h4>
                  <div class="table-responsive">
                     <table id="tab" class="table table-bordered table-striped table-hover nowrap display" style="width: 100%">
                        <thead class="bg-gray-400">
                           <tr>
                              <th style="text-transform: uppercase; text-align: center;">No.</th>
                              <th style="text-transform: uppercase; text-align: center;">Nama Dokumen</th>
                              <th style="text-transform: uppercase; text-align: center;" id="tabHeadFile">File</th>
                           </tr>
                        </thead>
                        <tbody id="tabFileBody">
                           <tr>
                              <td class="text-center">1</td>
                              <td>Copy Polis</td>
                              <td><a href="{{ asset('storage/documents/copy_polis.jpg') }}" target="_blank">copy_polis.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">2</td>
                              <td>Formulir Klaim</td>
                              <td><a href="{{ asset('storage/documents/formulir_klaim.jpg') }}" target="_blank">formulir_klaim.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">3</td>
                              <td>Copy KTP</td>
                              <td><a href="{{ asset('storage/documents/copy_ktp.jpg') }}" target="_blank">copy_ktp.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">4</td>
                              <td>Copy Surat Izin Praktik (SIP) atau Copy tanda terima</td>
                              <td><a href="{{ asset('storage/documents/copy_sip.jpg') }}" target="_blank">copy_sip.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">5</td>
                              <td>Pengurusan SIP</td>
                              <td><a href="{{ asset('storage/documents/pengurusan_sip.jpg') }}" target="_blank">pengurusan_sip.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">6</td>
                              <td>Copy Surat Tanda Regisrasi (STR) atau Copy tanda terima pengurusan STR</td>
                              <td><a href="{{ asset('storage/documents/copy_str.jpg') }}" target="_blank">copy_str.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">7</td>
                              <td>Copy resume medis atas penanganan pasien dari RS</td>
                              <td><a href="{{ asset('storage/documents/resume_medis.jpg') }}" target="_blank">resume_medis.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">8</td>
                              <td>Copy identitas pihak ketiga (pasien/penuntut)</td>
                              <td><a href="{{ asset('storage/documents/identitas_pihak_ketiga.jpg') }}" target="_blank">identitas_pihak_ketiga.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">9</td>
                              <td>Laporan kerugian atau tuntutan</td>
                              <td><a href="{{ asset('storage/documents/laporan_kerugian.jpg') }}" target="_blank">laporan_kerugian.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">10</td>
                              <td>Kuitansi asli atas bukti penyelesaian tuntutan</td>
                              <td><a href="{{ asset('storage/documents/kuitansi.jpg') }}" target="_blank">kuitansi.jpg</a></td>
                           </tr>
                           <tr>
                              <td class="text-center">11</td>
                              <td>Foto, dokumen atau bukti pendukung lainnya</td>
                              <td><a href="{{ asset('storage/documents/bukti_pendukung.jpg') }}" target="_blank">bukti_pendukung.jpg</a></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-12">
                <div class="table-responsive">
                   <table id="tab" class="table table-striped table-hover nowrap display" style="width: 100%">
                      <tbody id="tabFileBody">
                         <tr>
                            <td>Surat Informasi Pembayaran Klaim</td>
                            <td class="text-end"><a href="{{ asset('storage/documents/copy_polis.jpg') }}" target="_blank">surat_informasi_pembayaran_klaim.jpg</a></td>
                         </tr>
                         <tr>
                            <td>Bukti Pembayaran Klaim</td>
                            <td class="text-end"><a href="{{ asset('storage/documents/formulir_klaim.jpg') }}" target="_blank">bukti_pembayaran .jpg</a></td>
                         </tr>
                      </tbody>
                   </table>
                </div>
             </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-footer">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalLong"><i class="ti ti-list-check me-2"></i>Log Status </button>
         </div>
      </div>
   </div>
   <div id="exampleModalLong" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLogStatus" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLogStatus">Log Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body task-card" style="border-top: 2px solid #2ca87f">
            <ul class="list-unstyled task-list">
                <li>
                  <i class="ti ti-check f-w-600 task-icon bg-success"></i>
                  <p class="m-b-5">17 March 2025 11:23</p>
                  <h5 class="text-muted">Pengajuan klaim</h5>
                </li>
                <li>
                  <i class="ti ti-clock f-w-600 task-icon bg-primary"></i>
                  <p class="m-b-5">18 March 2025 14:06</p>
                  <h5 class="text-muted">Proses verifikasi data pengajuan klaim</h5>
                </li>
              </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
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
@endpush
