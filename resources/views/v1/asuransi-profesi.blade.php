@extends('v1.layouts.landing')
@section('content-fullpage')
<div id="pureFullPage" class="pure-fullpage px-3 px-sm-4 px-md-5">

   <!-- Section 1: Hero Header -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12 col-md-12 text-center m-t-20">
                  <h1 class="h1 mb-4"
                      style="font-size: clamp(1.3rem, 3.5vw, 2.2rem); font-weight: 900;">
                     ASURANSI PROFESI <br />
                     <span style="font-weight: 900">TENAGA MEDIS & TENAGA KESEHATAN</span>
                  </h1>
                  <img src="{{ asset('assets/images/landing/tenaga-kesehatan.svg') }}"
                       alt="Ilustrasi Tenaga Kesehatan"
                       class="img-fluid rounded mt-4"
                       style="max-width: min(480px, 80vw); height: auto;" />
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Section 2: Apa itu Asuransi Profesi -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <div class="row align-items-center">
                     <div class="col-12 m-b-30">
                        <h2 class="text-center text-uppercase"
                            style="font-size: clamp(1.15rem, 3vw, 1.7rem);">
                           Apakah yang dimaksud dengan<br>
                           Asuransi Profesi Tenaga Medis & Tenaga Kesehatan?
                        </h2>
                     </div>

                     <div class="col-md-7">
                        <p class="m-b-0"
                           style="text-align: justify; font-size: clamp(0.9rem, 2.2vw, 1.15rem); font-weight: 400;">
                           Pemerintah sudah menerbitkan <b>Undang-Undang No. 17 tahun 2023</b>, tentang Kesehatan. Salah satu tujuannya untuk memastikan ketika menjalankan praktik, <b>Tenaga Medis</b> dan <b>Tenaga Kesehatan</b> yang memberikan pelayanan kesehatan kepada pasien harus melaksanakan upaya terbaik. Oleh karena itu mereka perlu mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien.
                        </p>
                        <p class="my-2"
                           style="text-align: justify; font-size: clamp(0.9rem, 2.2vw, 1.15rem); font-weight: 400;">
                           Bentuk perlindungan yang paling sesuai dengan Undang-Undang tersebut adalah <b>Asuransi Tanggung Gugat Profesi</b> atau <b>Professional Indemnity Insurance</b>, suatu produk asuransi yang menjamin perlindungan bagi para profesional dalam menghadapi tuntutan hukum atau gugatan dari pihak ketiga yang mengalami kerugian, sebagai akibat dari tugas atau profesi yang dilakukan.
                        </p>
                        <p class="m-b-30"
                           style="text-align: justify; font-size: clamp(0.9rem, 2.2vw, 1.15rem); font-weight: 400;">
                           Tenaga Medis dan Tenaga Kesehatan, ketika menjalankan praktik perlu mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien. Sedangkan yang dimaksud sebagai tenaga medis dan tenaga kesehatan sesuai Undang-Undang No. 17 tahun 2023 pasal 198 dan 199 sebagai berikut:
                        </p>
                     </div>

                     <div class="col-md-5 mt-4 mt-md-0">
                        <iframe style="width: 100%; aspect-ratio: 16/9;"
                                src="https://www.youtube.com/embed/Nkid6VOtndM"
                                title="TuguBro - Asuransi Profesi Tenaga Medis &amp; Tenaga Kesehatan"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Section 3: Daftar Tenaga Medis & Kesehatan -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <style>
                     .list-body {
                        background-color: #fdf3e7 !important;
                        border: 1px #fbb461 solid;
                        transition: box-shadow 0.3s ease;
                     }
                     .list-body:hover {
                        box-shadow: #fbb461 2px 5px 0px 0px;
                     }
                  </style>

                  <!-- Desktop: 2 Kolom -->
                  <div class="row align-items-start d-none d-md-flex">
                     <div class="col-12 col-xl-6" style="padding-left: 0px !important;">
                        <h3 class="text-uppercase m-t-20 m-b-30 text-center"
                            style="font-size: clamp(1.05rem, 2.7vw, 1.4rem);">
                           Tenaga Medis
                        </h3>
                        <div class="card list-body">
                           <div class="card-body" style="padding-inline: 0px !important;">
                              <ul style="list-style-type: disc; font-size: clamp(0.9rem, 2.2vw, 1.15rem); font-weight: 500; margin: 0;">
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
                        <h3 class="text-uppercase m-t-20 m-b-30 text-center"
                            style="font-size: clamp(1.05rem, 2.7vw, 1.4rem);">
                           Tenaga Kesehatan
                        </h3>
                        <div class="card list-body">
                           <div class="card-body" style="padding-inline: 0px !important;">
                              <div class="d-flex flex-wrap justify-content-between align-items-start">
                                 <div class="flex-item">
                                    <ul style="list-style-type: disc; font-size: clamp(0.9rem, 2.2vw, 1.15rem); font-weight: 500; margin: 0;">
                                       <li class="px-1 py-2">Tenaga Psikologi Klinis</li>
                                       <li class="px-1 py-2">Tenaga Keperawatan</li>
                                       <li class="px-1 py-2">Tenaga Kebidanan</li>
                                       <li class="px-1 py-2">Tenaga Kefarmasian</li>
                                       <li class="px-1 py-2">Tenaga Kesehatan Masyarakat</li>
                                       <li class="px-1 py-2">Tenaga Kesehatan Lingkungan</li>
                                    </ul>
                                 </div>
                                 <div class="flex-item">
                                    <ul style="list-style-type: disc; font-size: clamp(0.9rem, 2.2vw, 1.15rem); font-weight: 500; margin: 0;">
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

                  <!-- Mobile: Accordion -->
                  <div class="row align-items-start d-block d-md-none">
                     <div class="col-12">
                        <div class="accordion card" id="accordionExample">
                           <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                 <button style="background-color: #aecaff !important;"
                                         class="accordion-button collapsed"
                                         type="button"
                                         data-bs-toggle="collapse"
                                         data-bs-target="#collapseOne"
                                         aria-expanded="false"
                                         aria-controls="collapseOne">
                                    <h4 class="m-0" style="font-size: clamp(1rem, 2.7vw, 1.3rem);">Tenaga Medis</h4>
                                 </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                 <div class="accordion-body list-body">
                                    <ul style="list-style-type: disc; font-size: clamp(0.85rem, 2vw, 1rem); font-weight: 500; margin: 0;">
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
                              <h2 class="accordion-header" id="headingTwo">
                                 <button style="background-color: #aecaff !important;"
                                         class="accordion-button collapsed"
                                         type="button"
                                         data-bs-toggle="collapse"
                                         data-bs-target="#collapseTwo"
                                         aria-expanded="false"
                                         aria-controls="collapseTwo">
                                    <h4 class="m-0" style="font-size: clamp(1rem, 2.7vw, 1.3rem);">Tenaga Kesehatan</h4>
                                 </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                 <div class="accordion-body list-body">
                                    <ul style="list-style-type: disc; font-size: clamp(0.85rem, 2vw, 1rem); font-weight: 500; margin: 0;">
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
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Section 4: Mengapa Dibutuhkan -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <div class="row align-items-center">
                     <div class="col-12 m-b-30">
                        <h2 class="text-center text-uppercase"
                            style="font-size: clamp(1.15rem, 3vw, 1.7rem);">
                           Mengapa
                           <span class="text-primary">asuransi profesi</span> dibutuhkan?
                        </h2>
                     </div>

                     <div class="col-12" style="text-align: justify">
                        <h4 style="font-size: clamp(0.9rem, 2.2vw, 1.15rem); font-weight: 400;">
                           Program Asuransi Profesi memiliki sejumlah manfaat yang secara otomatis akan membuat kerja menjadi aman dan nyaman. Beberapa manfaat bila kita membeli asuransi profesi, antara lain:
                        </h4>
                     </div>

                     <div class="col-md-12 app_dotsContainer mt-20">
                        <style>
                           .app-link {
                              border: 2px solid #aecaff;
                              background-color: white !important;
                              padding-block: 10px;
                              min-height: 80px;
                              display: flex;
                              align-items: center;
                              cursor: default;
                              transition: box-shadow 0.3s ease;
                           }
                           .app-link:hover {
                              background-color: white !important;
                              box-shadow: #93B4FF 2px 5px 0px 0px;
                           }
                           .app-link h5 {
                              margin: 0;
                              font-size: clamp(0.85rem, 2vw, 1.1rem);
                              font-weight: 500;
                           }
                        </style>

                        <div class="app-link">
                           <i class="ti ti-caret-right f-28 me-3"></i>
                           <h5 class="text-black">Memberikan perlindungan dan jaminan apabila ada tuntutan/gugatan dari pasien atau pihak ketiga lainnya yang mengalami kerugian, sebagai akibat dari tugas profesi yang dilakukan.</h5>
                        </div>
                        <div class="app-link">
                           <i class="ti ti-caret-right f-28 me-3"></i>
                           <h5 class="text-black">Menjaga kondisi finansial apabila terjadi tuntutan/gugatan.</h5>
                        </div>
                        <div class="app-link">
                           <i class="ti ti-caret-right f-28 me-3"></i>
                           <h5 class="text-black">Meningkatkan kesadaran hukum, etika profesi, dan good practice profesi.</h5>
                        </div>
                        <div class="app-link">
                           <i class="ti ti-caret-right f-28 me-3"></i>
                           <h5 class="text-black">Menjaga reputasi nama baik tenaga medis dan tenaga kesehatan.</h5>
                        </div>
                        <div class="app-link">
                           <i class="ti ti-caret-right f-28 me-3"></i>
                           <h5 class="text-black">Sebagai salah satu bentuk tanggung jawab moral dan material atas profesi yang dilakukanya.</h5>
                        </div>
                        <div class="app-link">
                           <i class="ti ti-caret-right f-28 me-3"></i>
                           <h5 class="text-black">Memperoleh ketenangan dan kenyamanan dalam bekerja dan menjalankan profesinya.</h5>
                        </div>
                        <div class="app-link">
                           <i class="ti ti-caret-right f-28 me-3"></i>
                           <h5 class="text-black">Mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien, sesuai dengan UU No. 17 Tahun 2023 tentang Kesehatan.</h5>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Section 5: Kelebihan TuguBro -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <div class="row align-items-center">
                     <div class="col-12 m-b-30">
                        <h2 class="text-center text-uppercase"
                            style="font-size: clamp(1.15rem, 3vw, 1.7rem);">
                           Apa Kelebihan
                           <span class="text-primary">asuransi profesi</span> dari TuguBro?
                        </h2>
                     </div>

                     <style>
                        .txt {
                           border: 2px solid #aecaff;
                           height: 120px;
                           text-align: center;
                           background-color: #edf2ff !important;
                           display: flex;
                           align-items: center;
                           justify-content: center;
                           transition: background-color 0.3s ease, box-shadow 0.3s ease;
                        }
                        .txt:hover {
                           background-color: #edf2ff !important;
                           box-shadow: #93B4FF 0 4px 8px;
                        }
                        .text-desc {
                           color: black !important;
                           font-size: clamp(0.85rem, 2vw, 1rem) !important;
                           margin: 0;
                           font-weight: 500;
                        }
                        .premi {
                           border: #fbb461 3px dashed !important;
                           background-color: #FDF3E7 !important;
                           padding: 20px;
                           transition: box-shadow 0.3s ease;
                        }
                        .premi:hover {
                           box-shadow: #fbb461 2px 5px 5px 0px;
                        }
                     </style>

                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc"><b>Free</b> konsultasi dan diskusi.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc"><b>Free</b> Sosialisasi & Edukasi untuk FASYANKES (Pelatihan <b>“Handling Complaint”</b> khusus untuk Fasyankes)<span class="text-danger">*</span>.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc">Pendampingan oleh team medikolegal pada saat terindikasi akan ada gugatan maupun gugatan yang sudah masuk/diterima.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc">Memiliki team Medikolegal & Mediator yang sudah berpengalaman dan bersertifikasi.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc">Mengutamakan penyelesaian klaim/gugatan secara <b>NON LITIGASI</b>.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc">Proses pendaftaran peserta dan cara pembayaran yang mudah dan praktis.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc">Menggunakan sistem IT terkini dengan sistem keamanan berlapis sehingga semua data tersimpan aman dan terpercaya.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc">Didukung oleh perusahaan asuransi terpercaya.</p>
                        </div>
                     </div>
                     <div class="col-md-4 mb-4">
                        <div class="txt">
                           <p class="text-desc">Sesuai dengan amanat UU No. 17 Tahun 2023 tentang Kesehatan.</p>
                        </div>
                     </div>

                     <div class="col-md-12 mt-4">
                        <div class="premi">
                           <div class="row align-items-center">
                              <div class="col-md-2 text-center">
                                 <i class="ti ti-info-circle" style="font-size: 70px; color: seagreen;"></i>
                              </div>
                              <div class="col-md-10">
                                 <p class="text-desc mb-0">Besarnya premi asuransi berdasarkan limit liability/nilai pertanggungan yang disetujui, tidak membedakan kategori risiko pekerjaan, sebagai berikut:</p>
                                 <ul style="list-style: circle; margin-left: 1.5rem; font-size: clamp(0.85rem, 2vw, 1rem);">
                                    <li><b>Named</b>: mulai dari Rp. 900 ribuan dengan limit liability Rp. 500 juta/tahun dan berlaku kelipatannya.</li>
                                    <li><b>Nakes</b>: mulai dari Rp. 450 ribuan dengan limit liability Rp. 250 juta/tahun dan berlaku kelipatannya.</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-12 mt-3">
                        <p style="font-size: clamp(0.8rem, 1.8vw, 0.95rem); font-weight: 400; text-align: justify;">
                           <span class="text-danger">*</span> <a href="/syarat-ketentuan">Syarat dan Ketentuan Berlaku</a>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Section 6: Tata Cara -->
   <div class="page-section page">
      <div class="overflow-hidden">
         <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100">
               <div class="col-12">
                  <div class="row justify-content-center">
                     <div class="col-md-12 m-t-30 text-center">
                        <h1 class="h1 my-4"
                            style="font-size: clamp(1.3rem, 3.5vw, 2.2rem);">
                           Tata Cara
                        </h1>

                        <style>
                           .nav-pills .nav-link {
                              background-color: white !important;
                              color: black !important;
                              border: #fbb461 2px solid !important;
                              display: flex;
                              align-items: center;
                              transition: background-color 0.3s ease;
                              padding: 10px 15px;
                           }
                           .nav-pills .nav-link.active {
                              background-color: #fdf3e7 !important;
                           }
                           .nav-link h4 {
                              margin: 0;
                              font-size: clamp(0.9rem, 2vw, 1.1rem);
                           }
                           .list-group-item {
                              font-size: clamp(0.9rem, 2vw, 1.1rem);
                              font-weight: 500;
                           }
                        </style>

                        <div class="row">
                           <div class="col-md-3 col-sm-12 mb-4">
                              <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                 <li class="mb-2">
                                    <a class="nav-link active d-flex text-start" id="v-pills-home-tab"
                                       data-bs-toggle="pill" href="#v-pills-home" role="tab"
                                       aria-controls="v-pills-home" aria-selected="true">
                                       <div class="avtar avtar-s bg-light-warning me-3 p-2">
                                          <i class="ti ti-user-plus f-22" style="color:#fbb461"></i>
                                       </div>
                                       <h4>Menjadi Peserta</h4>
                                    </a>
                                 </li>
                                 <li>
                                    <a class="nav-link d-flex text-start" id="v-pills-profile-tab" data-bs-toggle="pill"
                                       href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                       aria-selected="false">
                                       <div class="avtar avtar-s bg-light-warning me-3 p-2">
                                          <i class="ti ti-file-text f-22" style="color:#fbb461"></i>
                                       </div>
                                       <h4>Melaporkan Kasus Klaim</h4>
                                    </a>
                                 </li>
                              </ul>
                           </div>

                           <div class="col-md-9 col-sm-12">
                              <div class="tab-content" id="v-pills-tabContent">
                                 <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <ol class="list-group list-group-numbered text-start"
                                        style="font-size: clamp(0.9rem, 2vw, 1.1rem); font-weight: 500; border: #fbb461 2px solid !important;">
                                       <li class="list-group-item">Persiapkan dokumen Anda seperti KTP, STR dan SIP. Setelah itu isi form dan unggah dokumen tersebut pada menu <a href="/pendaftaran" class="btn btn-sm btn-primary" target="_blank"> <i class="ti ti-forms me-1"></i> Daftar</a></li>
                                       <li class="list-group-item">Data yang telah disubmit akan divalidasi oleh tim TuguBro, selanjutnya akan diinformasikan untuk melakukan konfirmasi pendaftaran melalui email</li>
                                       <li class="list-group-item">Peserta dapat melakukan pembayaran dengan memilih metode pembayaran yang kami sediakan setelah melakukan konfirmasi pendaftaran</li>
                                       <li class="list-group-item">E-sertifikat dapat diunduh pada dashboard peserta dengan melakukan login menggunakan nomor STR dan alamat email yang terdaftar melalui tombol <a class="btn btn-sm btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a></li>
                                    </ol>
                                 </div>
                                 <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <div class="list-group text-start"
                                         style="font-size: clamp(0.9rem, 2vw, 1.1rem); font-weight: 500; border: #fbb461 2px solid !important;">
                                       <div class="list-group-item" style="list-style-type: none !important;">
                                          <p style="font-size: clamp(0.95rem, 2.2vw, 1.15rem); margin-bottom: 1rem;">Laporkan klaim kepada pihak TuguBro melalui :</p>
                                          <p style="font-size: clamp(0.9rem, 2vw, 1.1rem);">
                                             1. Telephone / Whatsapp <a href="https://wa.me/6281268691976" target="_blank">0812-6869-1976</a>
                                          </p>
                                          <p style="font-size: clamp(0.9rem, 2vw, 1.1rem);">
                                             2. Email <a href="mailto:asprof@tib.co.id" target="_blank">asprof@tib.co.id</a>
                                          </p>
                                          <p style="font-size: clamp(0.9rem, 2vw, 1.1rem);">
                                             3. Login dengan tombol <a class="btn btn-sm btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a> dan laporkan melalui Dashboard peserta
                                          </p>
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
   </div>

</div>

<!-- Tombol Navigasi Bawah Tengah -->
<div class="navigation-buttons text-center" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; display: flex; gap: 20px;">
   <button id="prev-btn" class="btn btn-primary rounded-circle p-3 animate__animated animate__bounce">
      <i class="ti ti-arrow-big-top" style="font-size: clamp(0.9rem, 1.8vw, 1.3rem);"></i>
   </button>
   <button id="next-btn" class="btn btn-primary rounded-circle p-3 animate__animated animate__bounce">
      <i class="ti ti-arrow-big-down" style="font-size: clamp(0.9rem, 1.8vw, 1.3rem);"></i>
   </button>
</div>
@endsection

@push('levelPluginHeader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@push('levelPluginsJs')
@vite(['resources/js/v1/pi/index.js'])
@endpush
