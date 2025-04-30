@extends('v1.layouts.dashboard')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="text-center mb-3">
         <p class="h1">Detail Klaim</p>
         <h1 id="nomor-klaim"></h1>
      </div>
   </div>
   <div class="col-12">
      <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="row">
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
                           <h5 class="mb-0" id="nama-peserta"></h5>
                        </div>
                     </li>
                  </ul>
               </div>
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
                           <h5 class="mb-0" id="nomor-polis-peserta"></h5>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                   <div class="form-group">
                      <label class="form-label">Nomor SIP</label>
                      <h5 id="nomor-sip"></h5>
                   </div>
                </div>
                <div class="col-lg-6">
                   <div class="form-group">
                      <label class="form-label">Tempat Praktik</label>
                      <h5 id="tempat-praktik"></h5>
                   </div>
                </div>
                <div class="col-lg-6">
                   <div class="form-group">
                      <label class="form-label">Tanggal Awal SIP</label>
                      <h5 id="tanggal-awal-sip"></h5>
                   </div>
                </div>
                <div class="col-lg-6">
                   <div class="form-group">
                      <label class="form-label">Tanggal Akhir SIP</label>
                      <h5 id="tanggal-akhir-sip"></h5>
                   </div>
                </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Tanggal Lapor</label>
                     <h5 id="tanggal-lapor"></h5>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Tanggal Kejadian</label>
                     <h5 id="tanggal-kejadian"></h5>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Nama PIC</label>
                     <h5 id="nama-pic"></h5>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Nomor Telpon PIC</label>
                     <h5 id="nomor-telpon-pic"></h5>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Keterangan Kejadian</label>
                     <h5 id="keterangan-kejadian"></h5>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group">
                     <label class="form-label">Status</label>
                     <h5 id="klaim-status-desc"></h5>
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
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
{{-- custom js --}}
@vite(['resources/js/v1/pi/klaim/detail.js'])
@endpush
