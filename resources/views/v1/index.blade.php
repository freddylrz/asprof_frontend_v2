@extends('v1.layouts.landing')
@section('content-fullpage')
<div id="pureFullPage" class="pure-fullpage px-3 px-sm-4 px-md-5">
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid">
            <div class="row justify-content-center align-items-center" style="margin-top: 80px; min-height: 60vh;">
               <!-- Left Column for Image -->
               <div class="col-12 col-md-6 text-center m-t-20">
                  <img
                     src="{{ asset('assets/images/landing/beranda.png') }}"
                     alt="img"
                     class="animated-image"
                     style="max-width: 650px"
                     />
               </div>
               <!-- Right Column for Text -->
               <div class="col-12 col-md-6 d-flex align-items-center m-t-20">
                  <div>
                     <h1 class="h1 my-4 fw-bold">
                        Apakah Anda sudah membaca dan paham isi
                        <span class="text-primary">polis asuransi</span> yang Anda beli?
                     </h1>
                     <h2 class="h2 my-4">
                        Jika tidak, mungkin produk asuransi yang Anda beli
                        <span class="text-danger fw-bold">tidak seperti yang Anda inginkan.</span>
                     </h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
               <div class="col-12 m-b-30">
                  <h2 class="text-center text-uppercase">Momen Penting
                     <span class="text-primary">Dalam Berasuransi</span>
                  </h2>
               </div>
               <!-- Card Start -->
               <div class="col-12 col-md-6 mt-20">
                  <div class="card custom-card border border-dark bg-light-primary">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                              <i class="ti ti-device-analytics f-66"></i>
                           </div>
                           <div class="flex-grow-1 mx-2">
                              <h4 class="mb-1 text-center">Melakukan Analisa atas obyek pertanggungan & kemungkinan Risiko yang akan di hadapi.</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Card End -->
               <!-- Repeat similar structure for other cards -->
               <div class="col-12 col-md-6 mt-20">
                  <div class="card custom-card border border-dark bg-light-primary">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                              <i class="ti ti-dashboard f-66"></i>
                           </div>
                           <div class="flex-grow-1 mx-2">
                              <h4 class="mb-1 text-center">Memilih jaminan asuransi yang sesuai dan kondisi jaminan yang optimal.</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-md-6 mt-20">
                  <div class="card custom-card border border-dark bg-light-primary">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                              <i class="ti ti-trending-down f-66"></i>
                           </div>
                           <div class="flex-grow-1 mx-2">
                              <h4 class="mb-1 text-center">Mengalami Kerugian/Klaim atau dituntut oleh pihak ke 3.</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-md-6 mt-20">
                  <div class="card custom-card border border-dark bg-light-primary">
                     <div class="card-body">
                        <div class="d-flex align-items-center">
                           <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                              <i class="ti ti-calculator f-66"></i>
                           </div>
                           <div class="flex-grow-1 mx-2">
                              <h4 class="mb-1 text-center">Menghitung nilai kerugian. (apakah sesuai dengan syarat & kondisi polis?)</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
               <div class="col-12 col-xl-6">
                  <div class="header-container-fluid">
                     <h3 class="text-uppercase text-center py-4" style="border: 2px solid #000; border-radius: 15px">
                        PERILAKU TERTANGGUNG
                     </h3>
                  </div>
                  <hr class="tapered-divider tapered-divider-blue">
                  <div class="card">
                     <div class="card-body">
                        <ul class="pl-0" style="font-size: 1.3rem; font-weight:400">
                           <li>
                              Awam dan sibuk dengan aktifitas utama.<br>
                              <small class="text-danger">Dapat polis, dilirik sebentar, taruh lemari atau jadi bantal</small>
                           </li>
                           <li>
                              Tidak teliti – tidak tertarik – tidak berminat.<br>
                              <small class="text-danger">Malas membaca/sulit memahami isi polis. (Tulisan kecil, berbahasa hukum, berpotensi mis-interprestasi). Terima polis, bayar premi, simpan dilaci.</small>
                           </li>
                           <li>
                              Membeli Asuransi   :  Pertimbangan premi murah.<br>
                              <small class="text-danger">Tanpa memahami mengapa bisa murah ?</small>
                           </li>
                           <li>
                              Membeli asuransi karena terpaksa/terikat, bukan kesadaran.<br>
                              <small class="text-danger">Karena keterikatan (kontrak, leasing, bank), ditawarin saudara, teman, dll</small>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-xl-6">
                  <div class="header-container-fluid">
                     <h3 class="text-uppercase text-center py-4" style="border: 2px solid #000; border-radius: 15px">
                        PERILAKU Penanggung
                     </h3>
                  </div>
                  <hr class="tapered-divider tapered-divider-red">
                  <div class="card">
                     <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-start">
                           <ul class="pl-0" style="font-size: 1.3rem; font-weight:400">
                              <li>
                                 Menawarkan polis standar.<br>
                                 <small class="text-danger">(Apakah sesuai dengan risiko yang ada, luas jaminan berpotensi dispute karena under/over covered, dll)</small>
                              </li>
                              <li>
                                 Menjual paket produk yang ada.<br>
                                 <small class="text-danger">(Tidak/Belum Customise sesuai risiko yang ada).</small>
                              </li>
                              <li>
                                 Premi relatif standard.<br>
                                 <small class="text-danger">(Kurang optimal, terjadi Over/Under Charge premium)</small>
                              </li>
                              <li>
                                 Proses klaim yang kurang optimal.<br>
                                 <small class="text-danger">(Permintaan dokumen yang berbelit/rigid, tatacara pelaporan klaim)</small>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="navigation-buttons text-center" style="position: fixed; bottom: 20px; width: 100%;">
   <button id="prev-btn" class="btn btn-primary mr-2">Previous</button>
   <button id="next-btn" class="btn btn-primary">Next</button>
</div>
@endsection
@push('levelPluginHeader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush
@push('levelPluginsJs')
@vite(['resources/js/v1/pi/index.js'])
@endpush
