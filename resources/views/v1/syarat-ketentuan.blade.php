@extends('v1.layouts.app')
@section('content')
<div class="container">
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <div class="text-center mb-5">
         <h1 class="text-center">Syarat & Ketentuan</h1>
         <p class="text-muted">PT Tugu Insurance Brokers (TuguBro)</p>
         <p class="text-muted"><small>Terakhir diperbarui: 9 September 2025</small></p>
      </div>
      <div class="card bg-light my-5" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <p>Selamat datang di situs <strong>pi.tib.co.id</strong>. Dengan mengakses dan menggunakan situs ini, Anda dianggap telah membaca, memahami, dan menyetujui Syarat &amp; Ketentuan berikut. Jika Anda tidak menyetujui sebagian atau seluruh isi, mohon untuk tidak menggunakan layanan kami.</p>

            <h5 class="mt-4">1. Definisi</h5>
            <ul>
               <li><strong>“TuguBro”</strong> berarti PT Tugu Insurance Brokers selaku pemilik dan pengelola situs ini.</li>
               <li><strong>“Pengguna”</strong> berarti setiap orang yang mengakses, menggunakan, atau mendaftar melalui situs pi.tib.co.id.</li>
               <li><strong>“Layanan”</strong> berarti seluruh informasi, produk, sistem pendaftaran, konsultasi, maupun fasilitas terkait asuransi profesi yang tersedia di situs ini.</li>
            </ul>

            <h5 class="mt-4">2. Ruang Lingkup Layanan</h5>
            <ul>
               <li>Situs ini menyediakan informasi mengenai produk dan layanan pialang asuransi profesi.</li>
               <li>Pendaftaran polis, pengajuan klaim, maupun permintaan informasi lain hanya dapat dilakukan sesuai prosedur yang ditentukan.</li>
               <li>TuguBro bertindak sebagai pialang asuransi yang menjembatani Pengguna dengan perusahaan asuransi rekanan, sesuai ketentuan Otoritas Jasa Keuangan (OJK).</li>
            </ul>

            <h5 class="mt-4">3. Kewajiban Pengguna</h5>
            <ul>
               <li>Memberikan data yang benar, akurat, dan sah.</li>
               <li>Menjaga kerahasiaan akun, password, dan authorization token yang digunakan.</li>
               <li>Tidak menggunakan situs untuk tujuan yang melanggar hukum, merugikan pihak lain, atau merusak sistem.</li>
            </ul>

            <h5 class="mt-4">4. Hak &amp; Kewajiban TuguBro</h5>
            <ul>
               <li>TuguBro berhak menolak, menunda, atau membatalkan layanan jika data yang diberikan tidak valid atau terindikasi penyalahgunaan.</li>
               <li>TuguBro berkewajiban menjaga kerahasiaan dan keamanan data pribadi Pengguna sesuai UU No. 27 Tahun 2022 tentang Perlindungan Data Pribadi.</li>
               <li>TuguBro tidak bertanggung jawab atas kerugian yang timbul akibat kelalaian Pengguna dalam menjaga akun atau informasi login.</li>
            </ul>

            <h5 class="mt-4">5. Informasi &amp; Konten</h5>
            <ul>
               <li>Seluruh informasi di situs ini bersifat informatif.</li>
               <li>TuguBro berusaha memastikan informasi akurat, namun tidak menjamin sepenuhnya terbebas dari kesalahan penulisan, pembaruan, atau teknis.</li>
               <li>Pengguna dianjurkan untuk menghubungi tim TuguBro guna memperoleh konfirmasi resmi sebelum mengambil keputusan.</li>
            </ul>

            <h5 class="mt-4">6. Hak Kekayaan Intelektual</h5>
            <ul>
               <li>Seluruh logo, desain, teks, gambar, dan konten lain yang ada di situs ini adalah milik TuguBro dan dilindungi oleh hukum.</li>
               <li>Pengguna dilarang memperbanyak, mendistribusikan, atau menggunakan tanpa izin tertulis dari TuguBro.</li>
            </ul>

            <h5 class="mt-4">7. Keamanan &amp; Cookie Authorization</h5>
            <ul>
               <li>Situs ini menggunakan <em>Secure HttpOnly Cookie</em> untuk menyimpan authorization token demi menjaga keamanan autentikasi.</li>
               <li>Pengguna dilarang mencoba mengakses, mengubah, atau menyalahgunakan token dan sistem keamanan.</li>
               <li>Segala bentuk pelanggaran akan diproses sesuai ketentuan hukum yang berlaku.</li>
            </ul>

            <h5 class="mt-4">8. Batasan Tanggung Jawab</h5>
            <ul>
               <li>TuguBro tidak bertanggung jawab atas kerugian langsung maupun tidak langsung akibat penggunaan situs ini, kecuali jika terbukti merupakan kelalaian serius TuguBro.</li>
               <li>TuguBro tidak menjamin ketersediaan layanan setiap saat karena adanya kemungkinan perawatan sistem, gangguan teknis, atau faktor eksternal.</li>
            </ul>

            <h5 class="mt-4">9. Hukum yang Berlaku</h5>
            <p>Syarat &amp; Ketentuan ini tunduk pada hukum yang berlaku di Republik Indonesia. Setiap sengketa yang timbul akan diselesaikan terlebih dahulu melalui musyawarah, dan bila diperlukan melalui jalur hukum sesuai yurisdiksi Indonesia.</p>

            <h5 class="mt-4">10. Perubahan</h5>
            <p>TuguBro berhak mengubah atau memperbarui Syarat &amp; Ketentuan ini sewaktu-waktu. Perubahan akan diumumkan melalui situs <strong>pi.tib.co.id</strong> dan berlaku sejak tanggal dipublikasikan.</p>

            <h5 class="mt-4">11. Kontak</h5>
            <address>
               PT Tugu Insurance Brokers<br>
               Graha Pratama 3rd Floor A<br>
               Jl. M.T. Haryono Kav. 15, Jakarta<br>
               Telp: (021) 8379 0789<br>
               Email: <a href="mailto:asprof@tib.co.id">asprof@tib.co.id</a>
            </address>

            <p class="text-muted small mt-4">Dokumen ini disediakan untuk tujuan informasi. Jika terdapat perbedaan interpretasi, kebijakan internal TuguBro dan peraturan perundang-undangan yang berlaku menjadi acuan utama.</p>
            <p class="text-muted small">Versi: 1.0</p>
         </div>
      </div>
   </div>
</div>
@endsection
