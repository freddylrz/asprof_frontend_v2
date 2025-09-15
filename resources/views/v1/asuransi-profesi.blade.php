@extends('v1.layouts.landing')
@section('content-fullpage')
<div id="pureFullPage" class="pure-fullpage px-3 px-sm-4 px-md-5">
   <div class="page-section page">
      <section class=" overflow-hidden" >
         <div class="container mb-0">
            <div class="row align-items-center">
                  <div class="col-md-12 m-t-30 text-center">
                     <h1 class="h1 my-4 wow fadeInUp" data-wow-delay="0.2s">
                        ASURANSI PROFESI <br />
                        <span style="font-weight: 900">TENAGA MEDIS & TENAGA KESEHATAN</span>
                     </h1>
                     <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="col-md-12">
                           <img src="{{ asset('assets/images/landing/tenaga-kesehatan.svg') }}" alt="img" class="img-fluid rounded" />
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </section>
   </div>
   <div class="page-section page">
      <section class=" overflow-hidden" >
         <div class="container mb-0">
            <div class="row align-items-center">
               <div class="col-12 m-b-30">
                  <h2 class="text-center uppercase">Apakah yang dimaksud dengan<br>
                     Asuransi prOFESI Tenaga Medis & Tenaga Kesehatan ?
                  </h2>
               </div>
               <div class="col-12">
                  <div class="row align-items-center">
                     <div class="col-md-7">
                        <p class="m-b-0" style="text-align: justify; font-size: 1.3rem; font-weight:400">Pemerintah sudah menerbitkan <b>Undang-Undang No. 17 tahun 2023</b>, tentang Kesehatan  Salah satu tujuannya untuk memastikan ketika menjalankan praktik, <b>Tenaga Medis</b> dan <b>Tenaga Kesehatan</b> yang memberikan pelayanan kesehatan kepada pasien harus melaksanakan upaya terbaik. Oleh karena itu mereka perlu mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien.</p>
                     </div>
                     <div class="col-md-5">
                        <iframe style="width: 100%; max-width: inherit" height="215" src="https://www.youtube.com/embed/Nkid6VOtndM  " title="TuguBro - Asuransi Profesi Tenaga Medis &amp; Tenaga Kesehatan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                     </div>
                     <div class="col-12">
                        <p class="my-2" style="text-align: justify; font-size: 1.3rem; font-weight:400">Bentuk perlindungan yang paling sesuai dengan Undang-Undang tersebut adalah <b>Asuransi Tanggung Gugat Profesi</b> atau <b>Professional Indemnity Insurance</b>, suatu produk asuransi yang menjamin perlindungan bagi para profesional dalam menghadapi tuntutan hukum atau gugatan dari pihak ketiga yang mengalami kerugian, sebagai akibat dari tugas atau profesi yang dilakukan.</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <p class="m-b-30" style="text-align: justify; font-size: 1.3rem; font-weight: 400">
                     Tenaga Medis dan Tenaga Kesehatan, ketika menjalankan praktik perlu mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien. Sedangkan yang dimaksud sebagai tenaga medis dan tenaga kesehatan sesuai Undang-Undang No. 17 tahun 2023 pasal 198 dan 199 sebagai berikut:
                  </p>
               </div>
            </div>
         </div>
      </section>
   </div>
   <div class="page-section page">
      <section class=" overflow-hidden" >
         <div class="container mb-0">
            <style>
               .list-body:hover{
               box-shadow: #fbb461 2px 5px 0px 0px;
               }
               .list-body{
               background-color: #fdf3e7 !important;
               border: 1px #fbb461 solid;
               }
            </style>
            <div class="row align-items-start d-none d-md-flex">
               <div class="col-12 col-xl-6" style="padding-left: 0px !important;">
                  <h3 class="text-uppercase m-t-20 m-b-30 text-center">Tenaga Medis :</h3>
                  <div class="card list-body">
                     <div class="card-body" style=" padding-inline: 0px !important;">
                        <ul style="list-style-type: disc; font-size: 1.3rem; font-weight: 500; margin: 0">
                           <li class="px-1 py-2">Dokter</li>
                           <li class="px-1 py-2">Dokter Spesialis</li>
                           <li class="px-1 py-2">Dokter Subspesialis</li>
                           <li class="px-1 py-2">Dokter Gigi</li>
                           <li class="px-1 py-2">Dokter Gigi Spesialis</li>
                           <li class="px-1 py-2">Dokter Gigi Subspesialis</li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-xl-6" style="padding-right: 0px !important;">
                  <h3 class="text-uppercase m-t-20 m-b-30 text-center">Tenaga Kesehatan :</h3>
                  <div class="card list-body">
                     <div class="card-body"  style=" padding-inline: 0px !important;">
                        <div class="d-flex flex-wrap justify-content-between align-items-start">
                           <div class="flex-item">
                              <ul style="list-style-type: disc; font-size: 1.3rem; font-weight: 500; margin: 0">
                                 <li class="px-1 py-2">Tenaga Psikologi Klinis</li>
                                 <li class="px-1 py-2">Tenaga Keperawatan</li>
                                 <li class="px-1 py-2">Tenaga Kebidanan</li>
                                 <li class="px-1 py-2">Tenaga Kefarmasian</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan Masyarakat</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan Lingkungan</li>
                              </ul>
                           </div>
                           <div class="flex-item">
                              <ul style="list-style-type: disc; font-size: 1.3rem; font-weight: 500; margin: 0">
                                 <li class="px-1 py-2">Tenaga Gizi</li>
                                 <li class="px-1 py-2">Tenaga Keterapian Fisik</li>
                                 <li class="px-1 py-2">Tenaga Keteknisian Medis</li>
                                 <li class="px-1 py-2">Tenaga Teknik Biomedika</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan Tradisional</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan lain yang ditetapkan oleh Menteri</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row align-items-start d-block d-md-none"> <!-- Hanya untuk mobile -->
               <!-- Tenaga Medis -->
               <div class="col-12">
                  <div class="accordion card" id="accordionExample">
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                           <button  style="background-color: #aecaff !important;" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <h4>Tenaga Medis</h4>
                           </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                           <div class="accordion-body list-body">
                              <ul style="list-style-type: disc; font-size: 1rem; font-weight: 500; margin: 0">
                                 <li class="px-1 py-2">Dokter</li>
                                 <li class="px-1 py-2">Dokter Spesialis</li>
                                 <li class="px-1 py-2">Dokter Subspesialis</li>
                                 <li class="px-1 py-2">Dokter Gigi</li>
                                 <li class="px-1 py-2">Dokter Gigi Spesialis</li>
                                 <li class="px-1 py-2">Dokter Gigi Subspesialis</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo" >
                           <button  style="background-color: #aecaff !important;" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <h4>Tenaga Kesehatan</h4>
                           </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                           <div class="accordion-body list-body">
                              <ul style="list-style-type: disc; font-size: 1rem; font-weight: 500; margin: 0">
                                 <li class="px-1 py-2">Tenaga Psikologi Klinis</li>
                                 <li class="px-1 py-2">Tenaga Keperawatan</li>
                                 <li class="px-1 py-2">Tenaga Kebidanan</li>
                                 <li class="px-1 py-2">Tenaga Kefarmasian</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan Masyarakat</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan Lingkungan</li>
                                 <li class="px-1 py-2">Tenaga Gizi</li>
                                 <li class="px-1 py-2">Tenaga Keterapian Fisik</li>
                                 <li class="px-1 py-2">Tenaga Keteknisian Medis</li>
                                 <li class="px-1 py-2">Tenaga Teknik Biomedika</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan Tradisional</li>
                                 <li class="px-1 py-2">Tenaga Kesehatan lain yang ditetapkan oleh Menteri</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Tenaga Kesehatan -->
            </div>
         </div>
      </section>
   </div>

   <div class="page-section page">
      <section class="overflow-hidden">
         <div class="container title mb-0">
            <div class="row align-items-center">
               <div class="col-12 m-b-30">
                  <h2 class="text-center text-uppercase">Mengapa
                     <span class="text-primary">asuransi profesi</span> dibutuhkan?
                  </h2>
               </div>
               <div class="col-12" style="text-align: justify">
                  <h4 style="font-size: 1.3rem; font-weight:400">Program Asuransi Profesi memiliki sejumlah manfaat yang secara otomatis akan membuat kerja menjadi aman dan nyaman. Beberapa manfaat bila kita membeli asuransi profesi, antara lain:</h4>
               </div>
               <div class="col-md-12 app_dotsContainer mt-20">
                  <style>
                     .app-link{
                     border: 2px solid #aecaff;
                     background-color: white; !important;
                     padding-block: 0px !important;
                     min-height: 85px !important;
                     display: flex;
                     cursor: unset;
                     align-items: center;
                     }
                     .app-link:hover{
                     background-color: white !important;
                     box-shadow: #93B4FF 2px 5px 0px 0px;
                     }
                     h5{
                     margin-top : 0px !important;
                     margin-bottom : 0px !important;
                     }
                  </style>
                  <div class="app-link" style="padding-block: 10px !important;">
                     <i class="ti ti-caret-right f-30"></i><h5 class="text-black">Memberikan perlindungan dan jaminan apabila ada tuntutan/gugatan dari pasien atau pihak ketiga lainnya yang
                        mengalami kerugian, sebagai akibat dari tugas profesi yang dilakukan.
                     </h5>
                  </div>
                  <div class="app-link">
                     <i class="ti ti-caret-right f-30"></i><h5 class=" text-black">Menjaga kondisi finansial apabila terjadi tuntutan/gugatan.</h5>
                  </div>
                  <div class="app-link">
                     <i class="ti ti-caret-right f-30"></i><h5 class=" text-black f-w-500">Meningkatkan kesadaran hukum, etika profesi, dan good practice profesi.</h5>
                  </div>
                  <div class="app-link">
                     <i class="ti ti-caret-right f-30"></i> <h5 class=" text-black f-w-500">Menjaga reputasi nama baik tenaga medis dan tenaga kesehatan.</h5>
                  </div>
                  <div class="app-link">
                     <i class="ti ti-caret-right f-30"></i> <h5 class=" text-black f-w-500">Sebagai salah satu bentuk tanggung jawab moral dan material atas profesi yang dilakukanya.</h5>
                  </div>
                  <div class="app-link">
                     <i class="ti ti-caret-right f-30"></i><h5 class="  text-black f-w-500">Memperoleh ketenangan dan kenyamanan dalam bekerja dan menjalankan profesinya.</h5>
                  </div>
                  <div class="app-link" style="padding-block: 10px !important;">
                     <i class="ti ti-caret-right f-30"></i><h5 class=" text-black f-w-500">Mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi,
                        standar prosedur operasional serta kebutuhan pasien, sesuai dengan UU No. 17 Tahun 2023 tentang Kesehatan.
                     </h5>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>

   <div class="page-section page">
      <section class="overflow-hidden">
         <div class="container title mb-0">
            <div class="row align-items-center">
               <div class="col-12 m-b-30">
                  <h2 class="text-center text-uppercase">Apa Kelebihan
                     <span class="text-primary">asuransi profesi</span> dari TuguBro?
                  </h2>
               </div>
               <style>
                  .txt:hover{
                  background-color: #edf2ff !important;
                  }
                  .txt{
                  border: 2px solid #aecaff;
                  height: 130px !important;
                  text-align: center;
                  background-color: #edf2ff !important;
                  }
                  .text-desc{
                  width: 100% !important;
                  color: black !important;
                  font-size: 17px !important;
                  }
               </style>
               <div class="col-md-4">
                  <div class="app-link txt" style="text-align: center !important;">
                     <p class="text-desc mb-0"><b>Free</b> konsultasi dan diskusi.</p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0"><b>Free</b> Sosialisasi & Edukasi untuk FASYANKES (Pelatihan <b>“Handling
                        Complaint”</b> khusus untuk Fasyankes)<span class="text-danger">*</span>.
                     </p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0">Pendampingan oleh team medikolegal pada saat terindikasi akan ada
                        gugatan maupun gugatan yang sudah masuk/diterima.
                     </p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0">Memiliki team Medikolegal & Mediator yang sudah berpengalaman dan
                        bersertifikasi.
                     </p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0">Mengutamakan penyelesaian klaim/gugatan secara <b>NON LITIGASI</b>.
                     </p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0">Proses pendaftaran peserta dan cara pembayaran yang mudah dan
                        praktis.
                     </p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0">Menggunakan sistem IT terkini dengan sistem keamanan berlapis
                        sehingga semua data tersimpan aman dan terpercaya.
                     </p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0">Didukung oleh perusahaan asuransi terpercaya.</p>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="app-link txt">
                     <p class="text-desc mb-0">Sesuai dengan amanat UU No. 17 Tahun 2023 tentang Kesehatan.</p>
                  </div>
               </div>
               <style>
                  .premi:hover{
                  background-color: #FDF3E7 !important;
                  box-shadow: #fbb461 2px 5px 5px 0px;
                  }
                  .premi{
                  padding-top: 10px !important;
                  height: max-content !important;
                  border: #fbb461 3px dashed !important;
                  }
               </style>
               <div class="col-md-12">
                  <div class="app-link premi" style="background-color: #FDF3E7">
                     <div class="row">
                        <div class="col-md-2" style="text-align: center">
                           <i class="ti ti-info-circle" style="font-size: 100px; color: seagreen"></i>
                        </div>
                        <div class="col-md-10">
                           <li class="text-desc" style="list-style: none">Besarnya premi asuransi berdasarkan limit liability/nilai pertanggungan yang disetujui, tidak membedakan kategori risiko pekerjaan, sebagai berikut:
                              <ul style="list-style: circle; margin-left: 1.5rem;">
                                 <li><b>Named</b>: mulai dari Rp. 900 ribuan dengan limit liability Rp. 500 juta/tahun dan berlaku kelipatannya.</li>
                                 <li><b>Nakes</b>: mulai dari Rp. 450 ribuan dengan limit liability Rp. 250 juta/tahun dan berlaku kelipatannya.</li>
                              </ul>
                           </li>
                        </div>
                     </div>
                  </div>
               </div>
               <p style="font-size: 1rem; font-weight:400; text-align: justify; margin-top: 1rem;"><span class="text-danger">*</span> <a href="/syarat-ketentuan"> Syarat dan Ketentuan Berlaku</a></p>
            </div>
         </div>
      </section>
   </div>

   <div class="page-section page">
      <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.png') }}">
         <div class="container title mb-0">
            <div class="row justify-content-center">
               <div class="col-md-12 m-t-30 text-center">
                  <h1 class="h1 my-4">
                     Tata Cara
                  </h1>
                  <style>
                     .nav-pills .nav-link{
                     background-color: white !important;
                     color: black !important;
                     border: #fbb461 2px solid !important;
                     }
                     .nav-pills .nav-link.active{
                     background-color: #fdf3e7 !important;;
                     /*box-shadow: #fbb461 2px 5px 5px 0px;*/
                     }
                     .nav-link {
                     display: flex;
                     align-items: center; /* Tengah secara vertikal */
                     }
                     .nav-link h4 {
                     margin: 0;
                     line-height: 1;
                     width: 100%;
                     }
                  </style>
                  <div class="row">
                     <div class="col-md-3 col-sm-12" style="margin-bottom: 20px !important;">
                        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                           aria-orientation="vertical">
                           <li style="margin-bottom: 10px">
                              <a class="nav-link active d-flex text-start" id="v-pills-home-tab"
                                 data-bs-toggle="pill" href="#v-pills-home" role="tab"
                                 aria-controls="v-pills-home" aria-selected="true">
                                 <div class="avtar avtar-s bg-light-warning m-r-10 p-3">
                                    <i class="ti ti-user-plus f-30" style="color:#fbb461"></i>
                                 </div>
                                 <h4>Menjadi Peserta
                                 </h4>
                              </a>
                           </li>
                           <li>
                              <a class="nav-link d-flex text-start" id="v-pills-profile-tab" data-bs-toggle="pill"
                                 href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                 aria-selected="false">
                                 <div class="avtar avtar-s bg-light-warning m-r-10 p-3">
                                    <i class="ti ti-file-text f-30" style="color:#fbb461"></i>
                                 </div>
                                 <h4>Melaporkan Kasus Klaim
                                 </h4>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-9 col-sm-12">
                        <div class="tab-content" id="v-pills-tabContent">
                           <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                              <ol class="list-group list-group-numbered text-start" style="font-size: 1.3rem; font-weight: 500; margin: 0; border: #fbb461 2px solid !important;">
                                 <li class="list-group-item">Persiapkan dokumen Anda seperti KTP, STR dan SIP. Setelah itu isi form dan unggah dokumen tersebut pada menu <a href="/pendaftaran" class="btn btn-sm  btn-primary" target="blank"> <i class="ti ti-forms me-1"></i> Daftar</a></li>
                                 <li class="list-group-item">Data yang telah disubmit akan divalidasi oleh tim TuguBro, selanjutnya akan diinformasikan untuk melakukan konfirmasi pendaftaran melalui email</li>
                                 <li class="list-group-item">Peserta dapat melakukan pembayaran dengan memilih metode pembayaran yang kami sediakan setelah melakukan konfirmasi pendaftaran</li>
                                 <li class="list-group-item">E-sertifikat dapat diunduh pada dashboard peserta dengan melakukan login menggunakan nomor STR dan alamat email yang terdaftar melalui tombol <a class="btn btn-sm btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a></li>
                              </ol>
                           </div>
                           <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                              <ol class="list-group text-start" style="font-size: 1.3rem; font-weight: 500; margin: 0; border: #fbb461 2px solid !important;">
                                 <li class="list-group-item" style="list-style-type: none !important;">
                                    <p style="font-size: 20px;">Laporkan klaim kepada pihak TuguBro melalui :</p>
                                    <span style="font-size: 20px; line-height: 1rem">1. Telephone / Whatsapp <a href="https://wa.me/6281268691976  " target="_blank">0812-6869-1976</a></span><br>
                                    <span style="font-size: 20px;line-height: 1rem">2. Email <a href="mailto:asprof@tib.co.id" target="_blank">asprof@tib.co.id</a></span><br>
                                    <span style="font-size: 20px;line-height: 1rem">3. Login dengan tombol <a class="btn btn-sm btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a> dan laporkan melalui Dashboard peserta</span>
                                 </li>
                              </ol>
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
