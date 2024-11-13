@extends('v1.layouts.landing')

@section('content')
<section class="bg-white overflow-hidden" style="background-image: url({{ asset('assets/images/landing/img-headerbg.jpg') }}" id="tata-cara">
    <div class="container title mb-0">
        <div class="row align-items-center">
            <div class="col-md-8 wow fadeInLeft" data-wow-delay="0.2s">
                <h2 class="mb-3" style="text-align: justify">Tata cara dalam melaporkan kasus klaim:</h2>
                <ol class="list-group" style="font-size: 1.3rem; font-weight: 500; margin: 0"><br>
                    <li class="list-group-item" style="list-style-type: none !important;">
                        <p style="font-size: 20px;">Laporkan klaim kepada pihak TuguBro melalui :</p>
                    <span style="font-size: 20px; line-height: 1rem">1. Telephone / Whatsapp <a href="https://wa.me/6281268691976" target="_blank">0812-6869-1976</a></span><br>
                        <span style="font-size: 20px;line-height: 1rem">2. Email <a href="mailto:asprof@tib.co.id" target="_blank">asprof@tib.co.id</a></span><br>
                    <span style="font-size: 20px;line-height: 1rem">3. Login dengan tombol <a class="btn btn-sm btn-success" href="/login"><i class="ti ti-login"></i> Masuk</a> dan laporkan melalui Dashboard peserta</span>
                    </li>
                </ol>
            </div>
            <style>
                @media (max-width: 768px) {
                    .imgKlaim{
                        display: none;
                    }
                }
            </style>
            <div class="col-md-4 wow fadeInUp imgKlaim" data-wow-delay="0.2s">
                <img src="{{ asset('assets/images/landing/tata-cara-2.svg') }}" alt="img" class="img-fluid mb-4" />
            </div>
        </div>
    </div>
</section>
@endsection
