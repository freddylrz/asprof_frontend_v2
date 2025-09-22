@extends('v1.layouts.landing')

@section('content-fullpage')
<div id="pureFullPage" class="pure-fullpage px-3 px-sm-4 px-md-5">
    <div class="page-section page">
        <div class="overflow-hidden">
            <div class="container-fluid h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <!-- Left Column for Image -->
                    <div class="col-12 col-md-6 text-center m-t-20">
                        <img
                            src="{{ asset('assets/images/landing/beranda.png') }}"
                            alt="Ilustrasi Asuransi"
                            class="img-fluid animated-image"
                            style="max-width: min(580px, 90vw); height: auto;"
                        />
                    </div>
                    <!-- Right Column for Text -->
                    <div class="col-12 col-md-6 d-flex align-items-center m-t-20">
                        <div>
                            <h1 class="my-4 fw-bold text-center text-md-start"
                                style="font-size: clamp(1.4rem, 3.8vw, 2.3rem);">
                                Apakah Anda sudah membaca dan paham isi
                                <span class="text-primary">polis asuransi</span> yang Anda beli?
                            </h1>
                            <h2 class="my-4 text-center text-md-start"
                                style="font-size: clamp(1.05rem, 2.8vw, 1.6rem);">
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
            <div class="container-fluid h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 m-b-30">
                        <h2 class="text-center text-uppercase"
                            style="font-size: clamp(1.2rem, 3.3vw, 1.8rem);">
                            Momen Penting
                            <span class="text-primary">Dalam Berasuransi</span>
                        </h2>
                    </div>

                    <!-- Card 1 -->
                    <div class="col-12 col-md-6 mt-20">
                        <div class="card custom-card border border-dark bg-light-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                                        <i class="ti ti-device-analytics f-66"></i>
                                    </div>
                                    <div class="flex-grow-1 mx-2">
                                        <h4 class="mb-1 text-center"
                                            style="font-size: clamp(0.9rem, 2.1vw, 1.25rem);">
                                            Melakukan Analisa atas obyek pertanggungan & kemungkinan Risiko yang akan di hadapi.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-12 col-md-6 mt-20">
                        <div class="card custom-card border border-dark bg-light-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                                        <i class="ti ti-dashboard f-66"></i>
                                    </div>
                                    <div class="flex-grow-1 mx-2">
                                        <h4 class="mb-1 text-center"
                                            style="font-size: clamp(0.9rem, 2.1vw, 1.25rem);">
                                            Memilih jaminan asuransi yang sesuai dan kondisi jaminan yang optimal.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-12 col-md-6 mt-20">
                        <div class="card custom-card border border-dark bg-light-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                                        <i class="ti ti-trending-down f-66"></i>
                                    </div>
                                    <div class="flex-grow-1 mx-2">
                                        <h4 class="mb-1 text-center"
                                            style="font-size: clamp(0.9rem, 2.1vw, 1.25rem);">
                                            Mengalami Kerugian/Klaim atau dituntut oleh pihak ke 3.
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-12 col-md-6 mt-20">
                        <div class="card custom-card border border-dark bg-light-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 d-flex justify-content-center align-items-center custom-icon">
                                        <i class="ti ti-calculator f-66"></i>
                                    </div>
                                    <div class="flex-grow-1 mx-2">
                                        <h4 class="mb-1 text-center"
                                            style="font-size: clamp(0.9rem, 2.1vw, 1.25rem);">
                                            Menghitung nilai kerugian. (apakah sesuai dengan syarat & kondisi polis?)
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION: Perilaku Tertanggung & Penanggung — DENGAN TAB BOOTSTRAP -->
    <div class="page-section page">
        <div class="overflow-hidden">
            <div class="container-fluid h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12">

                        <!-- DESKTOP VERSION (2 Kolom) -->
                        <div class="desktop-two-column d-none d-xl-block">
                            <div class="row">
                                <!-- Kolom Kiri: Perilaku Tertanggung -->
                                <div class="col-12 col-xl-12">
                                    <div class="header-container-fluid">
                                        <h3 class="text-uppercase text-center py-3 py-md-4"
                                            style="font-size: clamp(1rem, 2.4vw, 1.4rem); border: 2px solid #000; border-radius: 15px">
                                            PERILAKU TERTANGGUNG
                                        </h3>
                                    </div>
                                    <hr class="tapered-divider tapered-divider-blue">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="pl-0" style="font-size: clamp(0.8rem, 1.7vw, 1.1rem); font-weight: 400; line-height: 1.6;">
                                                <li>
                                                    Awam dan sibuk dengan aktifitas utama.<br>
                                                    <small class="text-danger">Dapat polis, dilirik sebentar, taruh lemari atau jadi bantal</small>
                                                </li>
                                                <li class="mt-3">
                                                    Tidak teliti – tidak tertarik – tidak berminat.<br>
                                                    <small class="text-danger">Malas membaca/sulit memahami isi polis. (Tulisan kecil, berbahasa hukum, berpotensi mis-interprestasi). Terima polis, bayar premi, simpan dilaci.</small>
                                                </li>
                                                <li class="mt-3">
                                                    Membeli Asuransi : Pertimbangan premi murah.<br>
                                                    <small class="text-danger">Tanpa memahami mengapa bisa murah ?</small>
                                                </li>
                                                <li class="mt-3">
                                                    Membeli asuransi karena terpaksa/terikat, bukan kesadaran.<br>
                                                    <small class="text-danger">Karena keterikatan (kontrak, leasing, bank), ditawarin saudara, teman, dll</small>
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
    </div>
</div>

<!-- Tombol Navigasi Bawah Tengah -->
<div class="navigation-buttons text-center"
    style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; display: flex; gap: 20px;">
    <button id="prev-btn" class="btn btn-primary rounded-circle p-3 animate__animated animate__bounce">
        <i class="ti ti-arrow-big-top" style="font-size: clamp(0.95rem, 1.8vw, 1.4rem);"></i>
    </button>
    <button id="next-btn" class="btn btn-primary rounded-circle p-3 animate__animated animate__bounce">
        <i class="ti ti-arrow-big-down" style="font-size: clamp(0.95rem, 1.8vw, 1.4rem);"></i>
    </button>
</div>
@endsection

@push('levelPluginHeader')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endpush

@push('levelPluginsJs')
@vite(['resources/js/v1/pi/index.js'])
@endpush
