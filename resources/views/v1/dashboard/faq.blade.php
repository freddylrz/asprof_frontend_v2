@extends('v1.layouts.dashboard')
@section('content')
<div class="row">
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <div class="text-center mb-5">
         <h1 class="text-center">Pertanyaan yang Sering Diajukan</h1>
      </div>
      <div class="card bg-light my-5" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <div class="accordion accordion-flush" id="accordionFlushExample">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                     Apa saja risiko yang ditanggung oleh polis asuransi ini?
                     </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                     <div class="accordion-body">
                        Memberikan pertanggungan atas kerugian yang diderita pasien sebagai akibat dari kelalaian tindakan medis dan/atau kelalaian upaya kesehatan yang dilakukan oleh Tertanggung dalam hal ini tenaga medis dan/atau tenaga kesehatan sehingga menyebabkan pasien mengalami cidera badan, cacat atau meninggal dunia.
                     </div>
                  </div>
                  <div class="accordion-item">
                     <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Apa saja risiko yang&nbsp;<b>tidak</b>&nbsp;ditanggung oleh polis asuransi ini?
                        </button>
                     </h2>
                     <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                           <ul>
                              <li>Kejadian atau peristiwa yang timbul sebelum atau sesudah tanggal periode polis.</li>
                              <li>Kerugian yang diharapkan atau diinginkan oleh Tertanggung.</li>
                              <li>Kerugian yang disebabkan oleh ketidakjujuran, kecurangan, tindakan kriminal atau dendam, atau segala tindakan/kelalaian yang melanggar hukum pidana atau peraturan administratif atau kelalaian lain yang bukan termasuk kelalaian medis.</li>
                              <li>Segala jasa yang diberikan berdasarkan perjanjian atas hasil (resultaat verbintennis) atau segala jasa yang diberikan dalam kondisi gangguan jiwa.</li>
                              <li>Jasa medis yang diberikan bukan untuk alasan diagnosis, terapi, rehabilitasi medis, prevensi dan proteksi medis (misalnya tindakan untuk tujuan kosmetik/estetik).</li>
                              <li>Kerusakan/manipulasi/rekayasa genetik.</li>
                              <li>Klaim yang timbul dari atau diakibatkan dari jaminan atau garansi.</li>
                              <li>Penggunaan obat-obatan untuk penurun berat badan.</li>
                              <li>Klaim yang timbul dari kerugian atau kerusakan barang-barang milik pasien yang berada dalam perawatan, penjagaan atau kendali pihak Tertanggung, atau kerusakan atau salah meletakan atau kehilangan dokumen (dalam bentuk apapun), apakah itu tertulis, cetakan atau reproduksi dengan cara apapun atau informasi yang disimpan secara elektronik atau dengan komputer, atau materi yang dipercayakan kepada atau dalam perawatan, penjagaan atau kontrol pihak Tertanggung.</li>
                              <li>Kerugian yang timbul dari jasa profesional yang diberikan oleh pihak Tertanggung kepada pasangan/istri pihak Tertanggung dan/atau kepada anggota keluarga langsung dari pihak Tertanggung.</li>
                              <li>Segala pertanggungjawaban yang semata-mata timbul dari status pihak Tertanggung (sebagai petugas, direktur, rekanan, pemegang dari posisi manajemen).</li>
                              <li>Tertanggung selama melakukan prakteknya tidak memiliki Surat Ijin Praktek atau Surat Ijin Praktek telah habis masa berlakunya.</li>
                              <li>Klaim oleh salah satu pihak Tertanggung terhadap pihak Tertanggung lainnya kecuali antara kedua pihak Tertanggung tersebut dalam hubungan Dokter dan Pasien.</li>
                              <li>Denda, hukuman (baik perkara pidana maupun berdasarkan perjanjian), ganti rugi hukuman dan exemplary damages (kerugian tambahan, sebagai hukuman, diberikan kepada penggugat di luar atau di atas kompensasi kerugian yang seharusnya).</li>
                              <li>Tindak pidana yang disengaja sebagaimana diatur dan dikecualikan dalam Pasal 308 ayat (9) UU 17/2023 tentang Kesehatan.</li>
                              <li>Tertanggung tidak memiliki Surat Tanda Registrasi (STR) atau Surat Tanda Registrasi (STR) yang telah habis masa berlakunya.</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="accordion-item">
                     <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Bagaimana proses klaim dan penyelesaian dalam polis asuransi tanggung gugat tenaga medis?
                        </button>
                     </h2>
                     <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                           <h4 class="mb-4">Polis Asuransi Tanggung Gugat Tenaga Medis dan Tenaga Kesehatan</h4>
                           <div class="mb-4">
                              <h5 class="mb-0">Informasi Polis</h5>
                              <ul class="list-group list-group-flush">
                                 <li class="list-group-item d-flex justify-content-between">
                                    <span>Nama</span>
                                    <strong>dr. A</strong>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between">
                                    <span>Limit Jaminan</span>
                                    <strong>Rp. 1.000.000.000</strong>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between">
                                    <span>Nilai Premi</span>
                                    <strong>Rp. 1.800.000</strong>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between">
                                    <span>Resiko Sendiri</span>
                                    <strong>Rp. 500.000 per kejadian</strong>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between">
                                    <span>Periode Asuransi</span>
                                    <strong>01 Januari 2025 - 01 Januari 2026</strong>
                                 </li>
                              </ul>
                           </div>
                           <div class="mb-4">
                              <h5>1. Kasus:</h5>
                              <p>
                                 Dokter Spesialis Jantung melakukan operasi, namun setelah dilakukan operasi kondisi pasien tidak membaik, pihak keluarga pasien menanyakan perihal kondisi pasien yang tidak membaik pasca dilakukan operasi. Setelah dilakukan penyelidikan lebih lanjut ditemukan adanya kelalaian tindakan medis sehingga dinyatakan malpraktek ketika operasi dilakukan. Pihak keluarga pasien menuntut ganti rugi atas tindakan malpraktek yang dilakukan oleh dokter tersebut.
                              </p>
                           </div>
                           <div class="mb-4">
                              <h5>2. Klaim:</h5>
                              <p>
                                 Pasien/Penggugat/Ahli Waris mengajukan tuntutan kepada Dokter dan atau Rumah Sakit atas kerugian yang mungkin diderita oleh pasien akibat dari adanya dugaan kelalaian atas tindakan medis yang dilakukan oleh Dokter di Rumah Sakit tersebut. Berdasarkan hal tersebut, Dokter dan atau Rumah Sakit melaporkan adanya klaim kepada Pialang Asuransi (TuguBro).
                              </p>
                           </div>
                           <div class="mb-4">
                              <h5>3. Penanganan oleh Pialang Asuransi:</h5>
                              <p>
                                 Pihak Pialang Asuransi menerima laporan dari Dokter atau rumah sakit atas adanya tuntutan dari pasien/keluarga pasien. Pihak Pialang Asuransi menginformasikan kepada asuransi adanya indikasi kelalaian tindakan yang dilakukan oleh dokter, sehingga pialang asuransi merekomendasikan ke asuransi untuk penunjukan medikolegal yang bertugas melakukan pendampingan, negosiasi, mediasi dan menyelesaikan tuntutan yang dilakukan pasien atau keluarga pasien.
                              </p>
                           </div>
                           <div class="mb-4">
                              <h5>4. Penyelesaian:</h5>
                              <p>
                                 Setelah serangkaian investigasi, mediasi serta negosiasi yang dilakukan oleh Medikolegal kepada Pasien/Penggugat/Ahli Waris dicapai kesepakatan damai dengan nilai tertentu. Maka hasil kesepakatan damai tersebut berupa perjanjian damai akan disampaikan kepada Asuransi untuk ditindaklanjuti oleh Asuransi untuk dilakukan proses pembayaran klaim sejumlah nilai yang disepakati dan dikurangi dengan nilai risiko sendiri (IDR 500.000) ke Nomor Rekening Dokter/Rumah Sakit.
                              </p>
                           </div>
                           <div class="mb-4">
                              <h5>5. Besaran Ganti Rugi:</h5>
                              <p>Berdasarkan kesepakatan perjanjian damai maka disepakati nilai ganti rugi sebesar Rp. 500.000.000 maka asuransi akan membayarkan klaim kepada dokter/rumah sakit dengan rincian sebagai berikut:</p>
                              <table class="table table-bordered w-auto">
                                 <tbody>
                                    <tr>
                                       <td>1. Kesepakatan Damai</td>
                                       <td>Rp. 500.000.000</td>
                                    </tr>
                                    <tr>
                                       <td>2. Deductible</td>
                                       <td>Rp. 500.000</td>
                                    </tr>
                                    <tr>
                                       <td>3. Nilai Klaim</td>
                                       <td><strong>Rp. 499.500.000</strong></td>
                                    </tr>
                                 </tbody>
                              </table>
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
@endsection
@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
{{-- custom js --}}
@vite(['resources/js/v1/pi/dashboard.js', 'resources/js/v1/pi/count-message.js'])
@endpush
