@extends('v1.layouts.landing')
@section('content')
<section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }})">
    <div class="container title mb-0">
      <div class="row align-items-center">
        <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
          <h2 class="text-center text-uppercase">Momen Penting
            <span class="text-primary">Dalam Berasuransi</span></h2>
        </div>

        <!-- Card Start -->
        <div class="col-12 col-md-6 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
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
        <div class="col-12 col-md-6 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
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

        <div class="col-12 col-md-6 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
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

        <div class="col-12 col-md-6 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
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
        <!-- Card End -->

      </div>
    </div>
  </section>

  <style>
    /* Card hover effect */
    .custom-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Icon animation on hover */
    .custom-icon {
      width: 130px;
      height: 130px;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .custom-card:hover .custom-icon {
      transform: rotate(15deg);
      color: #007bff;
    }

    /* Light primary background */
    .bg-light-primary {
      background-color: #f8f9fa; /* Adjust this to a lighter shade of your primary color */
    }

    /* Base styles for tapered divider */
    .tapered-divider {
        border: none;
        height: 5px;
        margin: 20px auto;
        position: relative;
        width: 100%;
    }

    .tapered-divider::after {
        content: '';
        position: absolute;
        top: 50%; /* Center vertically */
        left: 50%; /* Center horizontally */
        transform: translate(-50%, -50%);
        width: 15px; /* Diameter of the dot */
        height: 15px; /* Diameter of the dot */
        border-radius: 50%; /* Makes it a circle */
        border: 3px solid #000;
        background: #fff; /* Optional: Adjust the dot color for contrast */
    }

    /* Red divider */
    .tapered-divider-red {
        background: #ff0000;
    }

    /* Blue divider */
    .tapered-divider-blue {
        background: #0000ff;
    }
  </style>

    <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.png') }})">
        <div class="container title mb-0">
            <div class="row align-items-start">
                <div class="col-12 col-xl-6 wow fadeInUp" data-wow-delay="0.2s"><div class="header-container">
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
                <div class="col-12 col-xl-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="header-container">
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
    </section>
    <!-- [ dashboard apps ] End -->
@endsection
