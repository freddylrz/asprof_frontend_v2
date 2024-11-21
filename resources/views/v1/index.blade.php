@extends('v1.layouts.landing')
@section('content')
    <!-- [ dashboard apps ] start -->
    <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }})">
        <div class="container title mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center text-uppercase">Momen Penting <br>
                        <span class="text-primary">( Dalam Berasuransi )</span></h2>
                </div>
                <div class="col-12 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: decimal; text-align: justify;">
                                <li>Melakukan Analisa atas obyek pertanggungan  & kemungkinan Risiko yang akan di hadapi.</li>
                                <li>Memilih jaminan asuransi yang sesuai dan kondisi jaminan yang optimal.</li>
                                <li>Mengalami Kerugian/Klaim atau dituntut oleh pihak ke 3.</li>
                                <li>Menghitung nilai kerugian.  (apakah sesuai dengan syarat & kondisi polis ?)</li>
                            </ul>
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
                    <h2 class="text-center text-uppercase"> PERILAKU TERTANGGUNG</h2>
                </div>
                <div class="col-12 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: decimal; text-align: justify;">
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
            </div>
        </div>
    </section>
    <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }})">
        <div class="container title mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center text-uppercase">PERILAKU PENANGGUNG</h2>
                </div>
                <div class="col-12 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: decimal; text-align: justify;">
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
    </section>
    <!-- [ dashboard apps ] End -->
@endsection
