@extends('v1.layouts.dashboard')

@section('content')
    <div class="row" id="div-cancellation">
        <div class="col-12">
            <div class="text-center mb-5">
               <p class="h1">Cancellation</p>
               <p class="h1" id="nomor-register"></p>
            </div>
            <div class="alert alert-danger" role="alert" style="display: flex; align-items: middle" id="div-polis-alert">
               <i class="ti ti-info-circle me-3 my-auto" style="font-size: 2.5rem; font-weight: 900; flex-shrink: 0; color: #050505"></i>
               <span id="polis-alert" class="text-wrap h4 my-auto" style="flex: 1;">
                Kami memahami bahwa keputusan untuk membatalkan polis bukanlah hal yang mudah. Jika Anda yakin ingin melanjutkan proses pembatalan, harap tinjau kembali informasi di bawah ini.
            </span>
            </div>
        </div>
        <div class="col-12">
            <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                <div class="card-body px-0">
                   <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-5">
                           <h3 class="text-center">Detail Pembatalan</h3>
                        </div>
                    </div>
                      <div class="col-12 col-lg-6">
                         <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                               <div class="d-flex align-items-center">
                                  <div class="flex-shrink-0">
                                     <div class="avtar avtar-s bg-light-secondary">
                                        <i class="ti ti-user-check f-32"></i>
                                     </div>
                                  </div>
                                  <div class="flex-grow-1 ms-3">
                                     <div class="row g-1">
                                        <div class="col-12">
                                           <p class="text-muted mb-1">Nama</p>
                                           <h5 class="mb-0" id="periode-polis">test daftar tio</h5>
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
                                           <p class="text-muted mb-1">Periode Polis Berjalan</p>
                                           <h5 class="mb-0" id="periode-polis">9 bulan</h5>
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
                                        <i class="ti ti-list-numbers f-32"></i>
                                     </div>
                                  </div>
                                  <div class="flex-grow-1 ms-3">
                                     <div class="row g-1">
                                        <div class="col-12">
                                           <p class="text-muted mb-1">Nomor STR</p>
                                           <h5 class="mb-0" id="periode-polis">AS35535355335346</h5>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </li>
                            <li class="list-group-item">
                               <div class="d-flex align-items-center">
                                  <div class="flex-shrink-0">
                                     <div class="avtar avtar-s bg-light-secondary">
                                        <i class="ti ti-receipt-refund f-32"></i>
                                     </div>
                                  </div>
                                  <div class="flex-grow-1 ms-3">
                                     <div class="row g-1">
                                        <div class="col-12">
                                           <p class="text-muted mb-1">Refund</p>
                                           <h5 class="mb-0" id="periode-polis">Hak pengembalian premi akan disesuaikan dengan ketentuan polis.</h5>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </li>
                         </ul>
                      </div>
                   </div>
                </div>
                <div class="card-footer text-end">
                  <button type="button" id="submit-button" class="btn btn-primary me-2">Submit</button>
                </div>
             </div>
        </div>
    </div>
    <div class="row" id="div-cancellation-success" style="display: none">
       <div class="col-12">
          <div class="text-center mb-5">
             <p class="h1">Cancellation</p>
             <p class="h1" id="nomor-register"></p>
          </div>
       <div class="alert alert-success" role="alert" style="display: flex; align-items: middle" id="div-polis-alert">
        <i class="ti ti-info-circle me-3 my-auto" style="font-size: 2.5rem; font-weight: 900; flex-shrink: 0; color: #050505"></i>
        <span id="polis-alert" class="text-wrap h4 my-auto" style="flex: 1;">
         Polis Anda telah berhasil dibatalkan. Silakan unduh e-sertifikat dan nota Anda di bawah ini.
        </span>
     </div>
       </div>
       <div class="col-12">
          <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
             <div class="card-body">
                <div class="p-3" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
                   <div class="row">
                    <div class="col-12 col-xl-6">
                         <div class="form-group">
                            <label class="form-label">Nama</label>
                            <p class="h5" id="nama-renewal">test daftar tio
                            </p>
                         </div>
                      </div>
                      <div class="col-12 col-xl-6">
                         <div class="form-group">
                            <label class="form-label">NIK</label>
                            <p class="h5" id="nik-renewal">3321110110030029
                            </p>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                    <div class="col-12 col-xl-6">
                        <div class="form-group">
                            <label class="form-label">Nomor STR</label>
                            <p class="h5" id="nomor-str-renewal">AS35535355335346</p>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                       <div class="form-group">
                          <label class="form-label">NPWP</label>
                          <p class="h5" id="npwp-renewal">4363666346545555
                          </p>
                       </div>
                    </div>
                </div>
             </div>
          </div>
       </div>
       <div class="col-12">
        <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
           <div class="card-body px-0">
              <div class="row">
                 <div class="col-12 col-lg-6">
                    <ul class="list-group list-group-flush">
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
                                     <div class="mb-0" id="div-e-sertifikat"><a href="/" target="blank_" class="btn btn-primary" id="btn-download-polis">
                                        E-Sertifikat
                                    </a></div>
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
                                   <i class="ti ti-download f-32"></i>
                                </div>
                             </div>
                             <div class="flex-grow-1 ms-3">
                                <div class="row g-1">
                                   <div class="col-12">
                                      <p class="text-muted mb-1">Unduh Nota</p>
                                      <div class="mb-0" id="div-nota"><a href="/" target="blank_" class="btn btn-primary" id="btn-download-polis">
                                        Nota
                                    </a></div>
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
@endsection

@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script>
    document.getElementById('submit-button').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Pembatalan',
            text: 'Apakah Anda yakin ingin membatalkan polis ini? Tindakan ini dapat mengakhiri polis asuransi Anda.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Pembatalan Berhasil!',
                    'Polis Anda telah berhasil dibatalkan.',
                    'success'
                );
                document.getElementById('div-cancellation').style.display = 'none';
                document.getElementById('div-cancellation-success').style.display = 'block';
            }
        });
    });
</script>
@endpush
