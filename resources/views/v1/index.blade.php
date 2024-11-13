@extends('v1.layouts.landing')
@section('content')
    <!-- [ dashboard apps ] start -->
    <section class=" overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }}">
        <div class="container mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center uppercase">Apakah yang dimaksud dengan<br>
                        Asuransi prOFESI Tenaga Medis & Tenaga Kesehatan ?</h2>
                </div>
                {{-- <div class="col-2 d-none d-md-block wow fadeInLeft" style="text-align: end" data-wow-delay="0.2s">
                    <img src="{{ asset('assets/images/landing/nakes-1.svg') }}" alt="logo" style="width: 100%" />
                </div> --}}
                <div class="col-12 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="row align-items-center">
                        <div class="col-md-7 wow fadeInLeft" data-wow-delay="0.2s">
                            <p class="m-b-0" style="text-align: justify; font-size: 1.3rem; font-weight:400">Pemerintah sudah menerbitkan <b>Undang-Undang No. 17 tahun 2023</b>, tentang Kesehatan  Salah satu tujuannya untuk memastikan ketika menjalankan praktik, <b>Tenaga Medis</b> dan <b>Tenaga Kesehatan</b> yang memberikan pelayanan kesehatan kepada pasien harus melaksanakan upaya terbaik. Oleh karena itu mereka perlu mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien.</p>
                        </div>
                        <div class="col-md-5 wow fadeInUp" data-wow-delay="0.2s">
                            <iframe style="width: 100%; max-width: inherit" height="215 "src="https://www.youtube.com/embed/ScFFzpX8esY?si=_IYM7kWek2ZrSMKN" title="TuguBro - Asuransi Profesi Tenaga Medis &amp; Tenaga Kesehatan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="col-12 wow fadeInLeft" data-wow-delay="0.2s">
                            <p class="my-2" style="text-align: justify; font-size: 1.3rem; font-weight:400">Bentuk perlindungan yang paling sesuai dengan Undang-Undang tersebut adalah <b>Asuransi Tanggung Gugat Profesi</b> atau <b>Professional Indemnity Insurance</b>, suatu produk asuransi yang menjamin perlindungan bagi para profesional dalam menghadapi tuntutan hukum atau gugatan dari pihak ketiga yang mengalami kerugian, sebagai akibat dari tugas atau profesi yang dilakukan.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col-md-12 wow fadeInUp" data-wow-delay="0.2s">
                    <p class="m-b-30" style="text-align: justify; font-size: 1.3rem; font-weight: 400">
                        Tenaga Medis dan Tenaga Kesehatan, ketika menjalankan praktik perlu mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien. Sedangkan yang dimaksud sebagai tenaga medis dan tenaga kesehatan sesuai Undang-Undang No. 17 tahun 2023 pasal 198 dan 199 sebagai berikut:
                    </p>
                </div>
                <div class="col-12 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                    <h3 class="text-uppercase m-t-20 m-b-30 text-center">Tenaga Medis :</h3>
                    <div class="card">
                        <div class="card-body p-0">
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
                <div class="col-12 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">
                    <h3 class="text-uppercase m-t-20 m-b-30 text-center">Tenaga Kesehatan :</h3>
                    <div class="card">
                        <div class="card-body p-0">
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
        </div>
    </section>
    <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.png') }})">
        <div class="container title mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center text-uppercase">Mengapa
                        <span class="text-primary">asuransi profesi</span> dibutuhkan?</h2>
                </div>
                <div class="col-12" style="text-align: justify">
                    <h4 style="font-size: 1.3rem; font-weight:400">Program Asuransi Profesi memiliki sejumlah manfaat yang secara otomatis akan membuat kerja menjadi aman dan nyaman. Beberapa manfaat bila kita membeli asuransi profesi, antara lain:</h4>
                </div>
                <div class="col-12 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: disc; text-align: justify;">
                                <li style="display: list-item;">Memberikan perlindungan dan jaminan apabila ada tuntutan/gugatan dari pasien atau pihak ketiga lainnya yang mengalami kerugian, sebagai akibat dari tugas profesi yang dilakukan.</li>
                                <li style="display: list-item;">Menjaga kondisi finansial apabila terjadi tuntutan/gugatan.</li>
                                <li style="display: list-item;">Meningkatkan kesadaran hukum, etika profesi, dan good practice profesi.</li>
                                <li style="display: list-item;">Menjaga reputasi nama baik tenaga medis dan tenaga kesehatan.</li>
                                <li style="display: list-item;">Sebagai salah satu bentuk tanggung jawab moral dan material atas profesi yang dilakukanya.</li>
                                <li style="display: list-item;">Memperoleh ketenangan dan kenyamanan dalam bekerja dan menjalankan profesinya.</li>
                                <li style="display: list-item;">Mendapatkan perlindungan hukum sepanjang melaksanakan tugas sesuai dengan standar pelayanan profesi, etika profesi, standar prosedur operasional serta kebutuhan pasien, sesuai dengan UU No. 17 Tahun 2023 tentang Kesehatan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }})">
        <div class="container title mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center text-uppercase">Apa Kelebihan
                        <span class="text-primary">asuransi profesi</span> dari TuguBro?</h2>
                </div>
                <div class="col-12 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: disc; text-align: justify;">
                                <li style="display: list-item;"><b>Free</b> konsultasi dan diskusi.</li>
                                <li style="display: list-item;"><b>Free</b> Sosialisasi & Edukasi untuk FASYANKES (Pelatihan <b>“Handling Complaint”</b> khusus untuk Fasyankes)<span class="text-danger">*</span>.</li>
                                <li style="display: list-item;">Pendampingan oleh team medikolegal pada saat terindikasi akan ada gugatan maupun gugatan yang sudah masuk/diterima.</li>
                                <li style="display: list-item;">Memiliki team Medikolegal & Mediator yang sudah berpengalaman dan bersertifikasi.</li>
                                <li style="display: list-item;">Mengutamakan penyelesaian klaim/gugatan secara <b>NON LITIGASI</b>.</li>
                                <li style="display: list-item;">Proses pendaftaran peserta dan cara pembayaran yang mudah dan praktis.</li>
                                <li style="display: list-item;">Menggunakan sistem IT terkini dengan sistem keamanan berlapis sehingga semua data tersimpan aman dan terpercaya.</li>
                                <li style="display: list-item;">Didukung oleh perusahaan asuransi terpercaya.</li>
                                <li style="display: list-item;">Sesuai dengan amanat UU No. 17 Tahun 2023 tentang Kesehatan.</li>
                                <li style="display: list-item;">Besarnya premi asuransi berdasarkan limit liability/nilai pertanggungan yang disetujui, tidak membedakan kategori risiko pekerjaan, sebagai berikut:
                                    <ul style="list-style: circle; margin-left: 1.5rem;">
                                        <li><b>Named</b>: mulai dari Rp. 900 ribuan dengan limit liability Rp. 500 juta/tahun dan berlaku kelipatannya.</li>
                                        <li><b>Nakes</b>: mulai dari Rp. 450 ribuan dengan limit liability Rp. 250 juta/tahun dan berlaku kelipatannya.</li>
                                    </ul>
                                </li>
                            </ul>
                            <p style="font-size: 1rem; font-weight:400; text-align: justify; margin-top: 1rem;"><span class="text-danger">*</span> <a href="/syarat-ketentuan"> Syarat dan Ketentuan Berlaku</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard apps ] End -->
@endsection
