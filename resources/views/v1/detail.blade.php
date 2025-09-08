@extends('v1.layouts.app')
@section('content')
<div class="container" id="container-detail">
   <div class="col-12">
      <div class="text-center mb-5">
         <p class="h1">NO REGISTRASI</p>
         <p class="h1" id="nomor-register"></p>
      </div>
      <div class="text-center mb-5">
         <div class="multisteps-form__progress">
            <div class="multisteps-form__progress-btn" id="poin-satu">Proses<br>Pendaftaran <span class="badge d-inline-block badge-bottom" id="status-poin-satu"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-dua">Proses<br>Persetujuan <span class="badge d-inline-block badge-bottom" id="status-poin-dua"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-lima">Proses<br>Konfirmasi <span class="badge d-inline-block badge-bottom" id="status-poin-lima"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-tiga">Proses<br>Pembayaran <span class="badge d-inline-block badge-bottom" id="status-poin-tiga"></span></div>
            <div class="multisteps-form__progress-btn" id="poin-empat">Polis <span class="badge d-inline-block badge-bottom" id="status-poin-empat"></span></div>
         </div>
      </div>
   </div>
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-12">
      <div class="alert alert-warning" role="alert" style="display: flex; align-items: middle" id="div-revision-alert">
         <i class="ti ti-info-circle mx-2 my-auto" style="font-size: 1.5rem; font-weight: 900; flex-shrink: 0; color: #050505"></i>
         <span id="revision-alert" class="text-wrap h4 my-auto" style="flex: 1;"></span>
         <div class="pull-right">
            <a href="/edit/{{ $reqId }}" class="btn btn-primary" id="btn_edit">
            <i class="ti ti-edit"></i> <span class="d-none d-lg-inline-block my-1">Memperbaiki Data</span>
            </a>
         </div>
      </div>
      <div class="card bg-light my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="text-center mb-5">
               <p class="h3">Informasi Data Pribadi</p>
            </div>
            <div class="p-3" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Nama</label>
                        <p class="h5" id="nama"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group">
                           <label class="form-label">NIK</label>
                           <p class="h5" id="nik"></p>
                        </div>
                        <div>
                           <a id="file_ktp" class="btn btn-primary" target="_blank"></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Tempat Tanggal Lahir</label>
                        <p class="h5" id="ttl"></p>
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <p class="h5" id="jenis-kelamin"></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Nomor Handphone</label>
                        <p class="h5" id="nomor-handphone"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Email</label>
                        <p class="h5" id="email"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">NPWP</label>
                        <p class="h5" id="npwp"></p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <p class="h5" id="alamat"></p>
                     </div>
                  </div>
               </div>
               <div id="div-kontak-darurat">
                  <hr>
                  <div class="text-center mb-5">
                     <h3 class="text-center">Kontak Darurat</h3>
                  </div>
                  <div class="row my-2">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label">Nama</label>
                           <p class="h5" id="kontak-darurat"></p>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="form-label">Nomor Handphone</label>
                           <p class="h5" id="nomor-darurat"></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <div class="card bg-light my-5" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="text-center mb-5">
               <p class="h3">Informasi Data Profesi</p>
            </div>
            <div class="row my-4">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="p-3 mb-4" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Profesi</label>
                              <div class="col-sm-12 col-md-12 d-none" id="div-tenaga-medis">
                                 <i class="fas fa-user-md mx-2" style="font-size: 1.5rem;"></i>
                                 <span class="h4">Tenaga Medis</span>
                              </div>
                              <div class="col-sm-12 col-md-12 d-none" id="div-tenaga-kesehatan">
                                 <i class="fas fa-user-nurse mx-2" style="font-size: 1.5rem;"></i>
                                 <span class="h4">Tenaga Kesehatan</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label">Kategori Profesi</label>
                              <p class="h4" id="ketegori-profesi"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row my-4">
               <div class="col-12 col-md-6">
                  <div class="text-center mb-3">
                     <p class="h4">Surat Tanda Registrasi</p>
                  </div>
                  <div class="p-3 mb-4" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
                     <div class="row">
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">Nomor STR</label>
                              <p class="h5" id="nomor-str"></p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">Status STR</label>
                              <p class="h5" id="status-str"></p>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 col-xl-6">
                           <div class="form-group">
                              <label class="form-label">File STR</label>
                              <p>
                                 <a id="file_str" class="btn btn-primary" target="_blank"></a>
                              </p>
                           </div>
                        </div>
                        <div class="col-12 col-xl-6" id="periode-akhir-str-container">
                           <div class="form-group">
                              <label class="form-label" id="label-str"></label>
                              <p class="h5" id="periode-str"></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="text-center mb-3">
                     <p class="h4">Surat Izin Praktik</p>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
                           <div class="">
                              <ul class="list-group" id="list-sip">
                              </ul>
                           </div>
                           <div id="viewDetailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewDetailModalTitle" aria-hidden="true">
                              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="viewDetailModalTitle">Detail Surat Izin Praktik</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="row my-2">
                                          <div class="col-lg-12">
                                             <div class="form-group">
                                                <label class="form-label">Nomor SIP</label>
                                                <p class="h5" id="detailNomorSIP"></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label class="form-label">Periode Awal SIP</label>
                                                <p class="h5" id="detailPeriodeAwalSIP"></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label class="form-label">Periode Akhir SIP</label>
                                                <p class="h5" id="detailPeriodeAkhirSIP"></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label class="form-label">Penerbit SIP</label>
                                                <p class="h5" id="detailDaerahPenerbitSIP"></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label class="form-label">Tempat Praktik</label>
                                                <p class="h5" id="detailTempatPraktik"></p>
                                             </div>
                                          </div>
                                          <div class="col-lg-6" id="div-nama-penerbit" style="display: none">
                                             <div class="form-group">
                                                <label class="form-label">Nama Penerbit SIP</label>
                                                <p class="h5" id="namaPenerbitSIP"></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                       <a id="file_sip" class="btn btn-primary" target="_blank"><i class="ti ti-file"></i> <span class="d-none d-md-inline">SIP</span></a>
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <div class="card bg-light my-5" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="text-center mb-5">
               <p class="h3">Informasi Plan</p>
            </div>
            <div class="p-3" style="background: #fff; box-shadow: 0 0.3rem 0.3rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #505050;border-radius:8px">
               <div class="row">
                  <div class="col-12 col-md-7" id="div-asuransi">
                  </div>
                  <div class="col-12 col-md-5">
                     <div class="form-group">
                        <label class="form-label">Plan:</label>
                        <p class="h5" id="plan"></p>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Premi Tahunan:</label>
                        <p class="h4" id="premi-tahunan"></p>
                     </div>
                     <div class="form-group">
                        <label class="form-label">Jaminan Pertanggungan:</label>
                        <p class="h4" id="jaminan-pertanggungan"></p>
                     </div>
                  </div>
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
               <i class="ti ti-eye me-1"></i> <span class="d-none d-lg-inline"> Log Status</span>
               </button>
            </div>
            <div>
               <button class="btn bg-info text-light" data-bs-toggle="modal" data-bs-target="#modal-payment" id="btn_info">
               <i class="ti ti-info-circle me-1"></i><span class="d-none d-lg-inline"> Informasi Pembayaran</span>
               </button>
               <button class="btn btn-danger" id="btn_nota">
               <i class="ti ti-download me-1"></i> Nota
               </button>
            </div>
            <div class="modal fade" id="modal-payment">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header bg-info" >
                        <h4 class="modal-title" style=" color: #fff;">Info Pembayaran</h4>
                     </div>
                     <div class="modal-body" id="divPay">
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-right"
                           data-bs-dismiss="modal">Tutup</button>
                     </div>
                  </div>
               </div>
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
<!-- [ footer apps ] start -->
<footer class="footer fixed-bottom d-none" style="border-top: 2px solid #4680ff;" id="payment-footer">
   <div class="border-top border-bottom footer-center p-4" style="background-image: url({{ asset('assets/images/landing/img-headerbg.png') }}">
      <div class="container">
         <div class="row">
            <div class="col-md-8 p-4 text-center">
               <p class="h2">Silahkan lanjutkan proses pembayaran</p>
            </div>
            <div class="col-md-4 text-center">
               {{-- <button type="button" id="paid-now" class="btn btn-warning btn-lg" style="font-size: 28px">Bayar Sekarang <i class="ti ti-wallet" style="font-size: 28px"></i></button> --}}
               <button data-pc-animate="slide-in-bottom" type="button" id="paid-now" class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#paymentModal" style="font-size: 28px"> Bayar Sekarang <i class="ti ti-wallet" style="font-size: 28px"></i>
               </button>
            </div>
         </div>
      </div>
   </div>
</footer>
<footer class="footer fixed-bottom d-none" style="border-top: 2px solid #4680ff;" id="confirm-footer">
    <div class="border-top border-bottom footer-center p-4" style="background-image: url({{ asset('assets/images/landing/img-headerbg.png') }})">
       <div class="container">
          <div class="row">
             <div class="col-md-8 p-3">
                <p class="h2">Silahkan periksa kembali data anda sebelum melanjutkan ke proses pembayaran</p>
             </div>
             <div class="col-md-4 d-flex align-items-center justify-content-center text-center gap-2">
                <button type="button" id="update-confirm" class="btn btn-secondary btn-lg" style="font-size: 28px"> Revisi Data <i class="ti ti-edit" style="font-size: 28px"></i>
                </button>
                <button type="button" id="confirm-now" class="btn btn-success btn-lg" style="font-size: 28px"> Konfirmasi <i class="ti ti-checkbox" style="font-size: 28px"></i>
                </button>
             </div>
          </div>
       </div>
    </div>
 </footer>
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true" role="dialog">
   <div class="modal-dialog modal-fullscreen-sm-down" role="document">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <h3 class="modal-title" style="color: #fff">Pembayaran</h3>
            <button type="button" class="btn btn-icon btn-lg text-light tutup-pembayaran" id="closePaymentModal">
            <i class="ti ti-x" style="font-size: 28px"></i>
            </button>
         </div>
         <div class="modal-body overflow-payment">
            <style>
                .custom-list-group .custom-list-item {
                   border-bottom: 1px dashed #dee2e6 !important; /* Garis putus-putus */
                }
                .custom-list-group .custom-list-item:last-child {
                   border-bottom: none !important; /* Hilangkan garis bawah untuk item terakhir */
                }
                .custom-list-group .custom-list-item:nth-last-child(2) {
                   border-bottom: 2px solid #000 !important; /* Garis tebal dan solid di atas Total Tagihan */
                }
             </style>

             <div class="row">
                <div class="col-12">
                   <ul class="list-group list-group-flush custom-list-group">
                      <li class="list-group-item px-0 pb-2 pt-0 custom-list-item">
                         <h5 class="mb-0">Ringkasan Pembayaran</h5>
                      </li>
                      <li class="list-group-item px-0 py-1 custom-list-item">
                         <div class="float-end">
                            <h5 class="mb-0" id="premi-tahunan-pembayaran">-</h5>
                         </div>
                         <span class="text-muted">Premi</span>
                      </li>
                      <li class="list-group-item px-0 py-1 custom-list-item">
                         <div class="float-end">
                            <h5 class="mb-0" id="biaya-polis">-</h5>
                         </div>
                         <span class="text-muted">Biaya Polis</span>
                      </li>
                      <li class="list-group-item px-0 py-1 custom-list-item">
                         <div class="float-end">
                            <h5 class="mb-0" id="biaya-materai">-</h5>
                         </div>
                         <span class="text-muted">Biaya Materai</span>
                      </li>
                      <li class="list-group-item px-0 py-1 custom-list-item">
                         <div class="float-end">
                            <h4 class="mb-0 text-primary" id="total-tagihan">-</h4>
                         </div>
                         <span class="text-muted f-16">Total tagihan</span>
                      </li>
                   </ul>
                </div>
             </div>
            <hr style="border: 1px solid; margin: 15px 0"/>
            <ul class="nav nav-tabs d-none" id="paymentTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="main-tab" data-bs-toggle="tab" href="#main" role="tab" data-slide-index="1" aria-controls="main" aria-selected="true"></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="payment-tab-1" data-bs-toggle="tab" href="#payment-1" role="tab" data-slide-index="2" aria-controls="payment-1" aria-selected="true"></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="payment-tab-2" data-bs-toggle="tab" href="#payment-2" role="tab" data-slide-index="3" aria-controls="payment-2" aria-selected="true"></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="payment-tab-3" data-bs-toggle="tab" href="#payment-3" role="tab" data-slide-index="4" aria-controls="payment-3" aria-selected="true"></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="payment-tab-4" data-bs-toggle="tab" href="#payment-4" role="tab" data-slide-index="5" aria-controls="payment-4" aria-selected="true"></a>
               </li>
            </ul>
            <div class="tab-content">
               <!-- Tab for select payment -->
               <div class="tab-pane show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                  <div class="d-flex justify-start">
                     <p class="h5">Pilih Metode Pembayaran</p>
                  </div>
                  <div class="row my-2" id="payment-list"></div>
               </div>
               <!-- Tab for Bank Transfer -->
               <div class="tab-pane" id="payment-1" role="tabpanel" aria-labelledby="payment-tab-1">
                  <div class="d-flex align-items-center w-100">
                     <div class="alert alert-warning d-flex justify-content-center align-items-center w-100 mb-3 text-center" role="alert" id="div-countdown-payment-bt">
                        <i class="ti ti-clock mx-2 my-auto" style="font-size: 1.5rem; font-weight: 900; color: #050505;"></i>
                        <span id="countdown-payment-bt" class="text-wrap h4 my-auto text-danger"></span>
                     </div>
                  </div>
                  <div id="va-output" style="display: none;">
                     <div class="d-flex justify-content-center">
                        <img id="va-logo" class="img-fluid" src="" alt="payment logo">
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Nomor Virtual Account:</p>
                           <h5 class="h5" id="va-number"></h5>
                           <input type="text" id="hidden-va-number" style="position: absolute; left: -9999px;">
                        </div>
                        <a href="#" class="avtar avtar-s btn-link-success btn-pc-default flex-shrink-0 my-auto copyVirtualAccount">
                        <i class="ti ti-copy f-28"></i>
                        </a>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Status Pembayaran:</p>
                           <h5 class="badge bg-light-warning border border-warning" id="va-payment-status" style="font-size: 1rem"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Kadaluwarsa:</p>
                           <h5 class="h5 text-danger" id="va-expiry-time"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Transaksi:</p>
                           <h5 class="h5" id="va-transaction-time"></h5>
                        </div>
                     </div>
                  </div>
                  <div id="bill-payment-output" style="display: none;">
                     <div class="d-flex justify-content-center">
                        <img id="bill-logo" class="img-fluid" src="" alt="payment logo">
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Company Biller:</p>
                           <h5 class="mb-1" id="company-biller"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Code Bill:</p>
                           <h5 class="mb-1" id="code-bill"></h5>
                           <input type="text" id="hidden-code-bill" style="position: absolute; left: -9999px;">
                        </div>
                        <a href="#" class="avtar avtar-s btn-link-success btn-pc-default flex-shrink-0 my-auto copyVirtualAccount">
                        <i class="ti ti-copy f-28"></i>
                        </a>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Key Bill:</p>
                           <h5 class="mb-1" id="key-bill"></h5>
                           <input type="text" id="hidden-key-bill" style="position: absolute; left: -9999px;">
                        </div>
                        <a href="#" class="avtar avtar-s btn-link-success btn-pc-default flex-shrink-0 my-auto copyVirtualAccount">
                        <i class="ti ti-copy f-28"></i>
                        </a>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Status Pembayaran:</p>
                           <h5 class="badge bg-light-warning border border-warning" id="bill-payment-status" style="font-size: 1rem"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Kadaluwarsa:</p>
                           <h5 class="h5 text-danger" id="bill-expiry-time"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Transaksi:</p>
                           <h5 class="h5" id="bill-transaction-time"></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Tab for E-wallet -->
               <div class="tab-pane" id="payment-2" role="tabpanel" aria-labelledby="payment-tab-2">
                  <div class="d-flex align-items-center w-100">
                     <div class="alert alert-warning d-flex justify-content-center align-items-center w-100 mb-3 text-center" role="alert" id="div-countdown-payment-ew">
                        <i class="ti ti-clock mx-2 my-auto" style="font-size: 1.5rem; font-weight: 900; color: #050505;"></i>
                        <span id="countdown-payment-ew" class="text-wrap h4 my-auto text-danger"></span>
                     </div>
                  </div>
                  <div id="qr-output" style="display: none;">
                     <div class="d-flex justify-content-center align-items-center mb-3 text-center">
                        <img id="qr-logo" class="img-fluid" src="" alt="payment logo" style="width: 50px; height: auto;">
                        <span class="h5 ms-2">Scan this QR Code:</span>
                     </div>
                     <img id="qr-code" src="" alt="QR Code" style="max-width: 100%; height: auto;"/>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Status Pembayaran:</p>
                           <h5 class="badge bg-light-warning border border-warning" id="qr-payment-status" style="font-size: 1rem"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Kadaluwarsa:</p>
                           <h5 class="h5 text-danger" id="qr-expiry-time"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Transaksi:</p>
                           <h5 class="h5" id="qr-transaction-time"></h5>
                        </div>
                     </div>
                  </div>
                  <div id="gopay-output" style="display: none;">
                     <div class="d-flex justify-content-center align-items-center mb-3 text-center">
                        <img id="gopay-logo" class="img-fluid" src="" alt="payment logo" style="width: 50px; height: auto;">
                        <span class="h5 ms-2">Pindai Kode QR ini atau klik tombol di bawah untuk mengalihkan:</span>
                     </div>
                     <div class="d-flex justify-content-center mb-3">
                        <img id="gopay-qr-code" src="" alt="QR Code" style="max-width: 100%; height: auto;">
                     </div>
                     <div class="text-center">
                        <a id="gopay-redirect" href="#" class="btn btn-primary mt-3">Buka GO-JEK/GO-PAY</a>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Status Pembayaran:</p>
                           <h5 class="badge bg-light-warning border border-warning" id="gopay-payment-status" style="font-size: 1rem"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Kadaluwarsa:</p>
                           <h5 class="h5 text-danger" id="gopay-expiry-time"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Transaksi:</p>
                           <h5 class="h5" id="gopay-transaction-time"></h5>
                        </div>
                     </div>
                  </div>
                  <div id="shopeepay-output" style="display: none;">
                     <div class="d-flex justify-content-center align-items-center mb-3 text-center">
                        <img id="shopeepay-logo" class="img-fluid" src="" alt="payment logo" style="width: 50px; height: auto;">
                        <span class="h5 ms-2">klik tombol di bawah untuk mengalihkan:</span>
                     </div>
                     <div class="text-center">
                        <a id="shopeepay-redirect" href="#" class="btn btn-primary mt-3">Buka Shopee Pay</a>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Status Pembayaran:</p>
                           <h5 class="badge bg-light-warning border border-warning" id="shopeepay-payment-status" style="font-size: 1rem"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Kadaluwarsa:</p>
                           <h5 class="h5" id="shopeepay-expiry-time"></h5>
                        </div>
                     </div>
                     <div class="media align-items-start my-3">
                        <div class="media-body my-auto">
                           <p class="text-muted text-sm mb-2">Waktu Transaksi:</p>
                           <h5 class="h5 text-danger" id="shopeepay-transaction-time"></h5>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Tab for Kartu kredit/debit -->
               <div class="tab-pane" id="payment-3" role="tabpanel" aria-labelledby="payment-tab-3">
                  <div class="d-flex align-items-center w-100">
                     <button type="button" class="btn btn-secondary btn-icon back-to-main mb-3 me-3">
                     <i class="ti ti-arrow-back mx-2 my-auto"></i>
                     </button>
                  </div>
                  <div id="cc-dc-form" style="display: none;">
                     <form id="ccdcForm" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row my-2">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label class="form-label required">Card Number</label>
                                 <input type="text" class="form-control enambelas" name="card-number" id="card-number" placeholder="1234 1234 1234 1234">
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <label class="form-label required">Card Month</label>
                                 <input type="text" class="form-control dua" name="expiry-month" id="expiry-month" placeholder="MM">
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <label class="form-label required">Card Year</label>
                                 <input type="text" class="form-control dua" name="expiry-year" id="expiry-year" placeholder="YY">
                              </div>
                           </div>
                           <div class="col-4">
                              <div class="form-group">
                                 <label class="form-label required">Card CVV</label>
                                 <input type="text" class="form-control tiga" name="cvv-number" id="cvv-number" placeholder="123">
                              </div>
                           </div>
                        </div>
                        <div class="d-grid mt-4">
                           <button type="submit" class="btn btn-lg btn-primary mb-4" id="ccdcButton">Submit <i class="ti ti-login"></i></button>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- Tab for Payment Success -->
               <div class="tab-pane" id="payment-4" role="tabpanel" aria-labelledby="payment-tab-4">
                  <div class="d-flex justify-content-center align-items-center mt-4">
                     <div class="text-center">
                        <i class="ti ti-circle-check" style="font-size: 5rem; color: #28a745;"></i>
                        <p class="h4 mt-3">Pembayaran Berhasil!</p>
                        <p class="timer-text mt-3">Anda akan dialihkan ke halaman berikutnya dalam <b id="countdown-success-payment">3</b> detik</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer justify-content-end" id="footer-main" style="border-top: 2px solid #4680ff;">
            <button type="button" class="btn btn-primary shadow-2" style="font-size: 18px" id="konfirmasi-pembayaran">Bayar <i class="ti ti-shield-check"></i></button>
         </div>
         <div class="modal-footer justify-content-center" id="footer-payment" style="border-top: 2px solid #4680ff; display:none">
            <button type="button" class="btn btn-primary btn-block shadow-2" style="font-size: 18px" id="cek-status-bayar">Cek Status Pembayaran <i class="ti ti-refresh"></i></button>
         </div>
      </div>
   </div>
</div>
<!-- [ footer apps ] End -->
@endsection
@push('levelPluginsJsh')
<!-- custom css for multistep -->
<link rel="stylesheet" href="{{ asset('assets/css/multistep.css?v=3') }}" />
@endpush
@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<!-- bootstrap-datepicker -->
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js')}}"></script>
<!-- input mask -->
<script src="{{ asset('assets/js/plugins/jquery.inputmask.bundle.min.js')}}"></script>
<script>
   // Pass to JavaScript
   window.reqId = @json($reqId);
</script>
@vite(['resources/js/v1/pi/detail.js'])
@endpush
