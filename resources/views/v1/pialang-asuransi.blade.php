~@extends('v1.layouts.landing')

@section('content-fullpage')
<div id="pureFullPage" class="pure-fullpage px-3 px-sm-4 px-md-5">
   <!-- Page 1 -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <section class="overflow-hidden">
                     <div class="container title mb-0">
                        <div class="col-12 m-t-50 m-b-25 wow fadeInLeft" data-wow-delay="0.2s">
                           <h2 class="text-center uppercase">apa yang dimaksud dengan pialang asuransi?</h2>
                        </div>
                        <div class="col-12 col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12">
                           <p style="text-align: justify; font-size: 1.3rem; font-weight:400">Menurut <b>Undang Undang RI nomor 40 tahun 2014</b> tentang Perasuransian, <b>Usaha Pialang Asuransi</b> adalah usaha jasa konsultasi dan/atau keperantaraan dalam penutupan asuransi atau asuransi  syariah serta penanganan penyelesaian klaimnya dengan <b>bertindak untuk dan atas  nama pemegang polis, tertanggung, atau peserta</b></p>
                        </div>
                        <div class="col-12 m-t-50 m-b-25 wow fadeInLeft" data-wow-delay="0.2s">
                           <h2 class="text-center uppercase">mengapa pialang asuransi diperlukan?</h2>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                           <div class="row">
                              <div class="col-12 col-lg-6">
                                 <div class="card custom-card bg-light-primary" style="border: 2px solid #000">
                                    <div class="card-body p-3">
                                       <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400; color: #000">
                                          Seiring berkembangnya usaha, risiko<br> menjadi semakin kompleks dan beragam.
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                 <div class="card custom-card bg-light-primary" style="border: 2px solid #000">
                                    <div class="card-body p-3">
                                       <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400; color: #000">
                                          Diperlukannya keahlian khusus<br> (Ilmu Perasuransian)
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                 <div class="card custom-card bg-light-primary" style="border: 2px solid #000">
                                    <div class="card-body p-3">
                                       <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400; color: #000">
                                          Tidak semua perusahaan memiliki<br> manajemen risiko
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                 <div class="card custom-card bg-light-primary" style="border: 2px solid #000">
                                    <div class="card-body p-3">
                                       <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400; color: #000">
                                          Pialang asuransi khusus didirikan dan<br> memiliki keahlian tersebut
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                 <div class="card custom-card bg-light-primary" style="border: 2px solid #000">
                                    <div class="card-body p-3">
                                       <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400; color: #000">
                                          Teman diskusi dan konsultasi<br> mengenai perasuransian
                                       </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                 <div class="card custom-card bg-light-primary" style="border: 2px solid #000">
                                    <div class="card-body p-3">
                                       <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400; color: #000">
                                          Gratis / free of charge, selain premi yang<br> harus dibayarkan
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <style>
                           /* Add this CSS for hover effect */
                           .custom-card {
                              transition: transform 0.3s ease, box-shadow 0.3s ease;
                           }

                           .custom-card:hover {
                              transform: scale(1.05);
                              box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                              border-color: #007bff; /* Optional: changes border color on hover */
                           }
                        </style>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Page 2 -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <section class="overflow-hidden">
                     <div class="container title mb-0">
                        <div class="row align-items-start">
                           <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                              <h2 class="text-center text-uppercase">Keuntungan menggunakan pialang asuransi</h2>
                           </div>
                           <style>
                              /* Custom animation CSS */
                              .list-group-item {
                                 position: relative;
                                 transition: transform 0.3s ease, box-shadow 0.3s ease;
                              }

                              .list-group-item:hover {
                                 transform: translateY(-10px);
                                 box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
                                 z-index: 10; /* Ensure the hovered item is above others */
                              }

                              .list-group-item:hover ~ .list-group-item {
                                 transform: translateY(20px);
                              }
                           </style>
                           <div class="col-12 col-lg-6">
                              <ul class="list-group list-group-flush">
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 2px solid #000;border-top: 4px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-check-circle f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">HEMAT BIAYA PREMI.</p>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 2px solid #000;border-top: 2px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-hands-helping f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">ADANYA BANTUAN TEKNIS DAN CLAIM</p>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 2px solid #000;border-top: 2px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-bullseye f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">TERTANGGUNG LEBIH FOCUS PADA CORE BISNISNYA</p>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 4px solid #000;border-top: 2px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-certificate f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">ADANYA STANDARISASI MUTU PROGRAM ASURANSI</p>
                                       </div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                           <div class="col-12 col-lg-6">
                              <ul class="list-group list-group-flush">
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 2px solid #000;border-top: 4px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-door-open f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">KONTROL ADMINISTRASI SATU PINTU</p>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 2px solid #000;border-top: 2px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-retweet f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">FREE EDUKASI TRANSFER OF KNOWLEDGE</p>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 2px solid #000;border-top: 2px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-hand-holding-heart f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">LAYANAN FREE OF CHARGE <br> (KECUALI NILAI PREMI)</p>
                                       </div>
                                    </div>
                                 </li>
                                 <li class="list-group-item bg-light-primary" style="border-bottom: 4px solid #000;border-top: 2px solid #000">
                                    <div class="d-flex align-items-center">
                                       <div class="flex-shrink-0">
                                          <div class="avtar avtar-s bg-light-secondary">
                                             <i class="fa fa-user-shield f-42"></i>
                                          </div>
                                       </div>
                                       <div class="flex-grow-1 ms-3">
                                          <p class="mb-1" style="font-size: 1.3rem; font-weight: 400;color: #000">SYARAT & KONDISI POLIS OPTIMAL SESUAI RISIKO</p>
                                       </div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Page 3 -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <section class="overflow-hidden">
                     <div class="container title mb-0">
                        <div class="row align-items-start">
                           <div class="col-12 text-center m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                              <h2 class="text-center uppercase">TuguBro</h2>
                           </div>
                           <div class="col-12">
                              <div class="card bg-light">
                                 <div class="card-body p-3">
                                    <div class="row">
                                       <div class="col-12 col-md-6">
                                          <iframe style="width: 100%; max-width: inherit; height: 540px; border-radius: 12px;" height="215" src="https://www.youtube.com/embed/ScFFzpX8esY?si=_IYM7kWek2ZrSMKN" title="TuguBro - Company Profile 2024" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                       </div>
                                       <div class="col-12 col-md-6">
                                          <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">PT. Tugu Insurance Brokers atau dikenal dengan Tugu-Bro, merupakan Perusahaan Pialang Asuransi yang didirikan sejak tahun 1976 dan menjadi salah satu pelopor berdirinya industri Pialang Asuransi di Indonesia.</h4>
                                          <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Tugu-Bro terdaftar dan diawasi oleh Otoritas Jasa Keuangan. Dengan pengalaman lebih dari 48 tahun, Tugu-Bro selalu berinovasi menghadirkan program-program asuransi yang tepat dengan mengedepankan Profesionalitas, Intelektualitas dan Kepuasan Pelanggan yang didukung teknologi Informasi modern, serta tenaga profesional yang bersertifikasi.</h4>
                                          <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Tugu-Bro menggunakan aplikasi digital yang memudahkan nasabah dalam melakukan proses berasuransi, dimana saja dan kapan saja.</h4>
                                       </div>
                                       <div class="col-12">
                                          <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Tugu-Bro memiliki tim Medikolegal dan Mediator berpengalaman serta bersertifikasi, yang akan menjadi sahabat diskusi anda selama berasuransi, kapanpun, mulai dari pemilihan dan penutupan asuransi sampai pendampingan proses klaim, termasuk memberikan layanan Konsultasi, Negosiasi, Mediasi, Konsiliasi, sampai Penilaian atau pendapat para Ahli dibidangnya.</h4>
                                          <h4 class="m-b-30" style="text-align: justify; line-height:2rem; font-size: 1.3rem; font-weight:400;">Kabar baiknya, semua layanan yang kami berikan Free of charge! Kecuali biaya Premi yang harus anda bayarkan.</h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Tombol Navigasi Bawah Tengah -->
<div class="navigation-buttons text-center" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; display: flex; gap: 20px;">
   <button id="prev-btn" class="btn btn-primary rounded-circle p-3 animate__animated animate__bounce">
      <i class="ti ti-arrow-big-top" style="font-size: 28px"></i>
   </button>
   <button id="next-btn" class="btn btn-primary rounded-circle p-3 animate__animated animate__bounce">
      <i class="ti ti-arrow-big-down" style="font-size: 28px"></i>
   </button>
</div>
@endsection

@push('levelPluginHeader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@push('levelPluginsJs')
@vite(['resources/js/v1/pi/index.js'])
@endpush
