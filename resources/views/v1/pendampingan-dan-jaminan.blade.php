@extends('v1.layouts.landing')
@section('content')
    <!-- [ dashboard apps ] start -->
    <section class=" overflow-hidden" id="tata-cara" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }}">
        <div class="container mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center uppercase">Detail pendampingan dan jaminan<br>
                        yang diberikan dalam Asuransi Proteksi Profesi Kesehatan:</h2>
                </div>
                <div class="col-12 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="row align-items-center">
                        <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <li><a class="nav-link active f-18" id="v-pills-satu-tab" data-bs-toggle="pill" href="#v-pills-satu" role="tab" aria-controls="v-pills-satu" aria-selected="true">Tahap penyelidikan</a></li>
                            <li><a class="nav-link f-18" id="v-pills-dua-tab" data-bs-toggle="pill" href="#v-pills-dua" role="tab" aria-controls="v-pills-dua" aria-selected="false">Persiapan persidangan Perdata</a></li>
                            <li><a class="nav-link f-18" id="v-pills-tiga-tab" data-bs-toggle="pill" href="#v-pills-tiga" role="tab" aria-controls="v-pills-tiga" aria-selected="false">Kegiatan pembelaan</a></li>
                            <li><a class="nav-link f-18" id="v-pills-empat-tab" data-bs-toggle="pill" href="#v-pills-empat" role="tab" aria-controls="v-pills-empat" aria-selected="false">Pendampingan poses mediasi</a></li>
                            <li><a class="nav-link f-18" id="v-pills-lima-tab" data-bs-toggle="pill" href="#v-pills-lima" role="tab" aria-controls="v-pills-lima" aria-selected="false">Membayar ganti rugi</a></li>
                            <li><a class="nav-link f-18" id="v-pills-enam-tab" data-bs-toggle="pill" href="#v-pills-enam" role="tab" aria-controls="v-pills-enam" aria-selected="false">Membayar biaya perkara</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-satu" role="tabpanel" aria-labelledby="v-pills-satu-tab">
                                <h3>Tahap penyelidikan</h3>
                                <p class="mb-0" style="text-align: justify; font-size: 1.3rem; font-weight: 400">Menyiapkan seluruh pendampingan dalam tahap penyelidikan, penyidikan di kantor polisi maupun tahap-tahap berikutnya dalam proses peradilan dan pendampingan dilakukan oleh ahli yang ditunjuk.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-dua" role="tabpanel" aria-labelledby="v-pills-dua-tab">
                                <h3>Persiapan persidangan Perdata</h3>
                                <p class="mb-0" style="text-align: justify; font-size: 1.3rem; font-weight: 400">Menyiapkan seluruh replik, duplik, dan jawaban dalam persidangan Perdata dan menyusun keterangan pembelaan dalam persidangan Pidana, persidangan sela, banding, kasasi, serta keterangan saksi bila diperlukan dalam semua persidangan Perdata dan Pidana.</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-tiga" role="tabpanel" aria-labelledby="v-pills-tiga-tab">
                                <h3>Kegiatan pembelaan</h3>
                                <p class="mb-0" style="text-align: justify; font-size: 1.3rem; font-weight: 400">Membantu semua kegiatan pembelaan dan pendampingan dalam perkara di PTUN atau membantu dan mendampingi penyelesaian secara Hukum Administrasi Negara atau Admnistrasi Pemerintahan.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-empat" role="tabpanel" aria-labelledby="v-pills-empat-tab">
                                <h3>Pendampingan poses mediasi</h3>
                                <p class="mb-0" style="text-align: justify; font-size: 1.3rem; font-weight: 400">Melakukan usaha pendampingan dalam seluruh poses mediasi didalam dan diluar pengadilan serta membayar mediator yang bekerja dan kesepakatan perdamaian sesuai ketentuan.</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-lima" role="tabpanel" aria-labelledby="v-pills-lima-tab">
                                <h3>Membayar ganti rugi</h3>
                                <p class="mb-0" style="text-align: justify; font-size: 1.3rem; font-weight: 400">Membayar ganti rugi dan denda pidana atau denda administrasi.</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-enam" role="tabpanel" aria-labelledby="v-pills-enam-tab">
                                <h3>Membayar biaya perkara</h3>
                                <p class="mb-0" style="text-align: justify; font-size: 1.3rem; font-weight: 400">Membayar biaya perkara dan biaya denda yang dinyatakan Pengadilan, membayar kesepakatan mediasi, dan membayar jasa Penasehat Hukum Medik untuk semua kasus perdata, pidana, administrasi, etik, dan disiplin profesi.</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.png') }}">
        <div class="container title mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center text-uppercase">Apa lagi kelebihan
                        <span class="text-primary">Asuransi Proteksi Profesi Kesehatan?</span></h2>
                </div>
                <div class="col-12 m-b-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: disc; text-align: justify;">
                                <li style="display: list-item;">Nilai Premi mulai dari Rp. 250.000,- dengan Limit Pertanggungan Rp. 250.000.000,-.</li>
                                <li style="display: list-item;">Mekanisme klaim dengan prosedur yang mudah dan pendek (cukup dengan mengisi formulir, menuliskan kronologis, dan melengkapi data rekam medik).</li>
                                <li style="display: list-item;">Pembayaran juga mudah dengan menggunakan Payment Gateway.</li>
                                <li style="display: list-item;">Semua proses pendampingan akan diberikan secara cepat, dipermudah, full attention, dan kolektif.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center text-uppercase">Apa resiko yang tidak ditanggung
                        <span class="text-primary">Asuransi Proteksi Profesi Kesehatan?</span></h2>
                </div>
                <div class="col-12 m-b-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: disc; text-align: justify;">
                                <li style="display: list-item;">Peristiwa yang timbul sebelum tanggal periode polis.</li>
                                <li style="display: list-item;">Force Majeur yang terjadi seperti bencana, huru-hara, dan bentuk lain.</li>
                                <li style="display: list-item;">Segala jasa yang diberikan ketika berada di bawah pengaruh minuman keras, narkoba, atau layanan medik yang diberikan dalam kondisi gangguan jiwa.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }}">
        <div class="container title mb-0">
            <div class="row align-items-center">
                <div class="col-12 m-b-30 wow fadeInLeft" data-wow-delay="0.2s">
                    <h2 class="text-center text-uppercase">kenapa membutuhkan
                        <span class="text-primary">asuransi profesi?</span></h2>
                </div>
                <div class="col-12" style="text-align: justify">
                    <h4 style="font-size: 1.3rem; font-weight:400">Produk asuransi profesi memiliki sejumlah manfaat yang secara otomatis akan membuat kerja menjadi aman dan nyaman. Berikut ini beberapa manfaat asuransi profesi:</h4>
                </div>
                <div class="col-12 mt-20 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="card bg-light">
                        <div class="card-body p-3">
                            <ul class="pl-0" style="font-size: 1.3rem; font-weight:400; list-style: disc; text-align: justify;">
                                <li style="display: list-item;">Memberikan jaminan atas tuntutan dari pasien atau pihak ketiga lainnya yang mengalami kerugian, sebagai akibat dari tugas profesi yang dilakukan.</li>
                                <li style="display: list-item;">Mendapatkan fasilitas konsultasi dari mediator bersertifikasi.</li>
                                <li style="display: list-item;">Mendapatkan pendampingan medikolegal bersertifikasi.</li>
                                <li style="display: list-item;">Menjaga kondisi finansial apabila tuntutan dari pasien atau pihak ketiga lainnya.</li>
                                <li style="display: list-item;">Meningkatkan kesadaran hukum, etik, dan good practice profesi.</li>
                                <li style="display: list-item;">Menjaga reputasi nama baik tenaga medis dan tenaga kesehatan.</li>
                                <li style="display: list-item;">Memberi perlindungan maksimal ganti rugi yang disesuaikan dengan plan yang dipilih.</li>
                                <li style="display: list-item;">Memperoleh ketenangan dalam bekerja dan menjalankan profesinya.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard apps ] End -->
@endsection
