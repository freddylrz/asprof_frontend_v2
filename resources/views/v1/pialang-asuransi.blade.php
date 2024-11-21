@extends('v1.layouts.landing')

@section('content')
<section class="bg-white overflow-hidden">
    <div class="container title mb-0">
        <div class="col-12 m-t-50 m-b-25 wow fadeInLeft" data-wow-delay="0.2s">
            <h2 class="text-center uppercase">apa yang dimaksud dengan pialang asuransi?</h2>
        </div>
        <div class="col-12 col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12">
            <p  style="text-align: justify; font-size: 1.3rem; font-weight:400">Menurut <b>Undang Undang RI nomor 40 tahun 2014</b> tentang Perasuransian, <b>Usaha Pialang Asuransi</b> adalah usaha jasa konsultasi dan/atau keperantaraan dalam penutupan asuransi atau asuransi  syariah serta penanganan penyelesaian klaimnya dengan <b>bertindak untuk dan atas  nama pemegang polis, tertanggung, atau peserta</b></p>
        </div>
        <div class="col-12 m-t-50 m-b-25 wow fadeInLeft" data-wow-delay="0.2s">
            <h2 class="text-center uppercase">mengapa pialang asuransi diperlukan?</h2>
        </div>
        <div class="col-12 col-sm-12 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card custom-card bg-light">
                        <div class="card-body p-3">
                            <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400">
                                Seiring berkembangnya usaha, risiko<br> menjadi semakin kompleks dan beragam.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card custom-card bg-light">
                        <div class="card-body p-3">
                            <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400">
                                Diperlukannya keahlian khusus<br> (Ilmu Perasuransian)
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card custom-card bg-light">
                        <div class="card-body p-3">
                            <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400">
                                Tidak semua perusahaan memiliki<br> manajemen risiko
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card custom-card bg-light">
                        <div class="card-body p-3">
                            <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400">
                                Pialang asuransi khusus didirikan dan<br> memiliki keahlian tersebut
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card custom-card bg-light">
                        <div class="card-body p-3">
                            <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400">
                                Teman diskusi dan konsultasi<br> mengenai perasuransian
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card custom-card bg-light">
                        <div class="card-body p-3">
                            <p class="text-center m-b-0" style="font-size: 1.3rem; font-weight:400">
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
        <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-12 text-center m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
               <h2 class="text-center uppercase">Benefit</h2>
            </div>
            <div class="col-md-12 p-4">
                <img src="{{ asset('assets/images/landing/benefit.svg') }}" alt="img" class="img-fluid rounded" />
            </div>
        </div>
        <div class="row align-items-center">
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
@endsection
