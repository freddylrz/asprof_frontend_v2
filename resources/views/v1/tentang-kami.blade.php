@extends('v1.layouts.landing')

@section('content')
<section class="bg-white overflow-hidden">
    <div class="container title mb-0">
        <div class="row align-items-center">
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
        </div>
    </div>
</section>
@endsection
