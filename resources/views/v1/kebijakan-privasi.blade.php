@extends('v1.layouts.app')
@section('content')
<div class="container">
   <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12">
      <div class="text-center mb-5">
         <h1 class="text-center">Kebijakan Privasi</h1>
         <p class="text-muted">PT Tugu Insurance Brokers (TuguBro)</p>
         <p class="text-muted"><small>Terakhir diperbarui: 9 September 2025</small></p>
      </div>
      <div class="card bg-light my-5" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
         <div class="card-body">
            <p>PT Tugu Insurance Brokers (“TuguBro”, “kami”) berkomitmen untuk melindungi dan menghormati privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadi Anda ketika menggunakan situs web <strong>pi.tib.co.id</strong> dan layanan terkait.</p>

            <h5 class="mt-4">1. Informasi yang Kami Kumpulkan</h5>
            <ul>
               <li><strong>Data Identitas:</strong> nama, alamat, nomor telepon, alamat email, nomor identitas (KTP, NPWP), serta informasi profesi.</li>
               <li><strong>Data Transaksi:</strong> informasi terkait polis asuransi, klaim, pembayaran premi, atau layanan lain yang Anda gunakan.</li>
               <li><strong>Data Teknis:</strong> alamat IP, jenis browser, sistem operasi, waktu akses, serta aktivitas saat menggunakan situs kami.</li>
               <li><strong>Data Tambahan:</strong> informasi lain yang secara sukarela Anda berikan saat berkomunikasi dengan kami.</li>
            </ul>

            <h5 class="mt-4">2. Cara Kami Menggunakan Informasi Anda</h5>
            <ul>
               <li>Memproses permohonan, polis, dan klaim asuransi.</li>
               <li>Memberikan layanan konsultasi dan informasi terkait produk asuransi.</li>
               <li>Memenuhi kewajiban hukum dan regulasi sesuai ketentuan Otoritas Jasa Keuangan (OJK).</li>
               <li>Meningkatkan pengalaman pengguna pada situs dan layanan kami.</li>
               <li>Mengelola autentikasi, akses akun, serta penyimpanan authorization token untuk keamanan.</li>
               <li>Mengirimkan informasi, pemberitahuan, atau penawaran layanan (dengan persetujuan Anda).</li>
            </ul>

            <h5 class="mt-4">3. Cookie dan Teknologi Pelacakan</h5>
            <p><strong>3.1 Penggunaan Cookie</strong></p>
            <ul>
               <li>Menyimpan preferensi pengguna.</li>
               <li>Menyediakan fungsionalitas login yang aman.</li>
               <li>Menganalisis penggunaan situs guna meningkatkan layanan.</li>
            </ul>
            <p><strong>3.2 Penyimpanan Authorization</strong></p>
            <ul>
               <li>Authorization token disimpan dalam bentuk <em>Secure HttpOnly Cookie</em>.</li>
               <li>Cookie tidak dapat diakses melalui JavaScript, sehingga lebih aman terhadap serangan XSS.</li>
               <li>Cookie hanya dikirim melalui koneksi HTTPS untuk melindungi data dalam transmisi.</li>
               <li>Masa berlaku cookie dibatasi sesuai kebutuhan (misalnya otomatis kadaluarsa setelah logout atau periode tertentu).</li>
            </ul>
            <p><strong>3.3 Hak Pengguna</strong></p>
            <p>Anda dapat menonaktifkan cookie melalui pengaturan browser, namun hal ini dapat membatasi akses terhadap fitur tertentu, seperti login dan transaksi.</p>

            <h5 class="mt-4">4. Pengungkapan Informasi</h5>
            <p>Kami tidak menjual atau menyewakan data pribadi Anda kepada pihak ketiga. Namun, kami dapat membagikan informasi dengan:</p>
            <ul>
               <li><strong>Perusahaan Asuransi Mitra:</strong> untuk keperluan pengajuan polis atau klaim.</li>
               <li><strong>Pihak Ketiga Tepercaya:</strong> penyedia layanan IT, auditor, konsultan hukum, atau regulator.</li>
               <li><strong>Kepatuhan Hukum:</strong> jika diwajibkan oleh undang-undang, termasuk UU Perlindungan Data Pribadi dan ketentuan OJK.</li>
            </ul>

            <h5 class="mt-4">5. Penyimpanan dan Keamanan Data</h5>
            <ul>
               <li>Data Anda disimpan dengan aman menggunakan sistem enkripsi dan kontrol akses terbatas.</li>
               <li>Authorization token dikelola dengan standar keamanan OWASP dan prinsip <em>least privilege access</em>.</li>
               <li>Kami menerapkan <em>best practice</em> keamanan siber untuk mencegah kebocoran, akses ilegal, atau manipulasi data.</li>
               <li>Data hanya disimpan selama diperlukan untuk tujuan pengolahan, kecuali diwajibkan lebih lama oleh hukum.</li>
            </ul>

            <h5 class="mt-4">6. Hak Anda</h5>
            <p>Sesuai UU No. 27 Tahun 2022 tentang Perlindungan Data Pribadi, Anda berhak untuk:</p>
            <ul>
               <li>Mengakses dan meminta salinan data pribadi Anda.</li>
               <li>Meminta koreksi atau pembaruan data yang tidak akurat.</li>
               <li>Meminta penghapusan data (apabila tidak lagi dibutuhkan).</li>
               <li>Menarik persetujuan penggunaan data untuk tujuan tertentu.</li>
               <li>Mengajukan keberatan atas pemrosesan data pribadi Anda.</li>
            </ul>

            <h5 class="mt-4">7. Perubahan Kebijakan</h5>
            <p>Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Versi terbaru akan selalu tersedia di situs web <strong>pi.tib.co.id</strong> dan berlaku sejak tanggal diterbitkan.</p>

            <h5 class="mt-4">8. Kontak Kami</h5>
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
