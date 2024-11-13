@extends('v1.layouts.app')

@section('content')
<div class="container">
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
                        Apa itu Asuransi Profesi Tenaga Medis & Tenaga Kesehatan?
                    </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        Asuransi Profesi Tenaga Medis & Tenaga Kesehatan adalah jenis asuransi yang dirancang khusus untuk melindungi tenaga medis dan tenaga kesehatan dari risiko yang mungkin timbul selama menjalankan tugas profesional mereka, termasuk tuntutan hukum, malpraktik, dan kesalahan medis</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Apa saja manfaat yang diperoleh dari asuransi ini?
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Manfaat asuransi ini meliputi perlindungan terhadap tuntutan hukum terkait malpraktik, biaya pengacara, kompensasi kerugian akibat kesalahan atau kelalaian medis, dan perlindungan terhadap risiko profesional lainnya.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Berapa biaya premi asuransi ini?
                    </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Biaya premi bervariasi tergantung pada jenis profesi, tingkat risiko, dan cakupan yang dipilih. Anda bisa mendapatkan perkiraan biaya premi dengan menggunakan kalkulator premi di website kami atau menghubungi tim kami.</div>
                  </div>
                </div>
              </div>
         </div>
      </div>
   </div>
</div>
@endsection
