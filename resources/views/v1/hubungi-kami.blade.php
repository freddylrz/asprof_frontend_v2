@extends('v1.layouts.landing')

@section('content-fullpage')
            <div class="container">
               <div class="row justify-content-center" style="margin-top: 80px">
                  <div class="text-center my-5">
                     <h1 class="text-center">PT. TUGU INSURANCE BROKERS</h1>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-2">
                     <div class="card">
                        <div class="card-body">
                           <h3 class="card-title">Kantor Pusat</h3>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-building f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0">
                                    Gedung Graha Pratama, Lantai 3<br>
                                    Jl. Letjen M.T. Haryono Kav. 15, Tebet Barat,
                                    Kecamatan Tebet, Kota Jakarta Selatan,
                                    DKI Jakarta 12810
                                 </h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-phone-call f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0"><a href="tel:02183790789" class=" link-primary"> 021 - 83790789</a></h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center justify-content-between mt-4">
                              <a href="https://goo.gl/maps/rrF9oGzxiRNYk7fd9" class="btn btn-primary" target="blank">
                              <i class="ti ti-location f-20 me-1"></i> view on map
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-body">
                           <h3 class="card-title">Kantor Perwakilan</h3>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-building f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0">
                                    Gedung Graha Pena, Lantai 5 Unit 518<br>
                                    Jl. A. Yani No. 88, Ketintang, Kecamatan Gayungan,
                                    Surabaya, Jawa Timur 60231
                                 </h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center my-2">
                              <div class="flex-shrink-0">
                                 <div class="avtar avtar-s bg-light-primary">
                                    <i class="ti ti-phone-call f-20"></i>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0"><a href="tel:03133601233" class=" link-primary"> 031-33601233</a></h5>
                              </div>
                           </div>
                           <div class="d-flex align-items-center justify-content-between mt-4">
                              <a href="https://maps.app.goo.gl/9F7QDk5r3S5Kz6zP8" class="btn btn-primary" target="blank">
                              <i class="ti ti-location f-20 me-1"></i> view on map
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 my-2">
                     <div class="card">
                        <div class="card-body">
                           <div class="row">
                              <h2 class=" text-uppercase">hubungi kami</h2>
                              <div class="col-12">
                                 <div class="form-group">
                                    <label class="form-label">Email id</label>
                                    <input type="email" class="form-control" placeholder="Email" />
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form-group">
                                    <label class="form-label">Pesan anda</label>
                                    <textarea rows="3" class="form-control" placeholder="Pesan" ></textarea>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="mt-4 d-grid">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
@endsection
