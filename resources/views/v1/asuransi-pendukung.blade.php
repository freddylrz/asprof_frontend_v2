@extends('v1.layouts.landing')
<script>
    // Fungsi untuk membuat kartu asuransi secara dinamis dari data API
    function generateInsuranceCards(apiUrl) {
        // Bersihkan konten lama di dalam container sebelum menambahkan konten baru
        $('#asuransi-pendukung-section .row').empty();

        // Lakukan request AJAX ke URL API yang diberikan
        $.ajax({
            url: apiUrl,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                // Pastikan response memiliki properti 'data' berupa array
                if (response && response.data && Array.isArray(response.data)) {
                    response.data.forEach(function(item) {
                        // Cek apakah semua field penting tersedia pada item
                        if (item.image && item.link && item.insured_name) {
                            // Buat struktur HTML kartu sesuai contoh styling Anda
                            var cardHtml = `
                                <div class="col-12 col-md-4">
                                    <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                                        <img class="img-fluid hei-150 d-block mx-auto" src="${item.image}" alt="${item.insured_name} image" style="object-fit: contain;">
                                        <div class="card-body text-center d-grid p-0">
                                            <a href="${item.link}" target="_blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
                                                Lihat lebih lengkap <i class="ti ti-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            // Tambahkan kartu ke dalam container row
                            $('#asuransi-pendukung-section .row').append(cardHtml);
                        } else {
                            console.warn('Data tidak lengkap pada salah satu item:', item);
                        }
                    });
                } else {
                    console.error('Format respons tidak valid atau data kosong:', response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Gagal memanggil API:', textStatus, errorThrown);
                $('#asuransi-pendukung-section .row').append('<div class="col-12 text-center"><p class="text-danger">Gagal memuat data asuransi. Silakan coba lagi nanti.</p></div>');
            }
        });
    }

</script>
@section('content-fullpage')
            <div class="container title mb-0" id="asuransi-pendukung-section">
               <div class="row align-items-center">
                  <div class="col-12 text-center m-b-30 wow fadeInLeft" data-wow-delay="0.2s" style="margin-top: 80px">
                     <h2 class="text-center uppercase m-b-20">asuransi pendukung</h2>
                  </div>
                  <!-- First Card -->
                  <div class="col-12 col-md-4">
                     <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                        <img class="img-fluid hei-150 d-block mx-auto" src="{{ asset('assets/images/landing/asuransi-asei.png') }}" alt="Card image" style="object-fit: contain;">
                        <div class="card-body text-center d-grid p-0">
                           <a href="https://www.asei.co.id/" target="blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
                           Lihat lebih lengkap <i class="ti ti-chevron-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- Second Card -->
                  <div class="col-12 col-md-4">
                     <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                        <img class="img-fluid hei-150 d-block mx-auto" src="{{ asset('assets/images/landing/asuransi-bgu.png') }}" alt="Card image" style="object-fit: contain;">
                        <div class="card-body text-center d-grid p-0">
                           <a href="https://asuransibinagriya.com/" target="blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
                           Lihat lebih lengkap <i class="ti ti-chevron-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- Third Card -->
                  <div class="col-12 col-md-4">
                     <div class="card" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                        <img class="img-fluid hei-150 d-block mx-auto" src="{{ asset('assets/images/landing/asuransi-fpg.png') }}" alt="Card image" style="object-fit: contain;">
                        <div class="card-body text-center d-grid p-0">
                           <a href="https://id.fpgins.com/" target="blank" class="btn btn-primary btn-lg" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; border-top-right-radius: 0px; border-top-left-radius: 0px;">
                           Lihat lebih lengkap <i class="ti ti-chevron-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
@endsection
