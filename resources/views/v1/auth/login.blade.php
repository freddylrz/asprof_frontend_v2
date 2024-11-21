@extends('v1.layouts.app')
@section('content')
<div class="container">
    <div class="col-12 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-12 col-sm-12">
        <div class="text-center mb-5">
            <h1 class="text-center">Login</h1>
        </div>
        <div class="card bg-light my-5" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
            <div class="card-body">
                <ul class="nav nav-tabs d-none" id="authTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="auth-tab-1" data-bs-toggle="tab" href="#auth-1" role="tab" data-slide-index="1" aria-controls="auth-1" aria-selected="true"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="auth-tab-2" data-bs-toggle="tab" href="#auth-2" role="tab" data-slide-index="2" aria-controls="auth-2" aria-selected="true"></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Tab for login with email and STR -->
                    <div class="tab-pane show active" id="auth-1" role="tabpanel" aria-labelledby="auth-tab-1">
                        <div class="text-center mb-4">
                            <p class="h4">Masuk dengan email dan STR anda</p>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg-12">
                                <!-- Login form -->
                                <form id="loginForm" role="form" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group mb-3">
                                        <label class="form-label required">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukan alamat email">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label required">Nomor STR</label>
                                        <input type="text" class="form-control enambelas" name="str_no" id="strNo" placeholder="Masukan nomor STR">
                                    </div>
                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-lg btn-primary" id="loginButton">Masuk <i class="ti ti-login"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Tab for OTP input -->
                    <div class="tab-pane" id="auth-2" role="tabpanel" aria-labelledby="auth-tab-2">
                        <div class="text-center mb-4">
                            <h3 class="h3">Masukan kode OTP</h3>
                            <p class="text-muted mb-4">Kami telah mengirim kode OTP ke email anda.</p>
                        </div>
                        <!-- OTP form -->
                        <form id="otpForm" role="form" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row my-4 text-center">
                                <div class="col"><input type="text" class="form-control text-center otpInput enam" style="font-size: 28px;font-weight: 900;letter-spacing:0.3em" autofocus/></div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg btn-primary mb-4" id="otpButton">Lanjutkan <i class="ti ti-login"></i></button>
                            </div>
                        </form>
                        <div class="d-flex justify-content-start align-items-end mt-3">
                            <p class="mb-0">Tidak menerima email?<a href="#" class="link-primary d-block" id="resendCode">Kirim kembali kode otp</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container d-sm-none bg-primary">
    <div class="p-3 px-lg-5 text-center">
        <h2 class="text-light">Jika anda belum memiliki asuransi profesi silahkan </h2>
        <a href="/pendaftaran" class="btn btn-light my-2">Daftar Sekarang</a>
       </div>
</div>
@endsection
@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<!-- choices js -->
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<!-- bootstrap-datepicker -->
<script src="{{ asset('assets/js/plugins/datepicker-full.min.js')}}"></script>
<!-- input mask -->
<script src="{{ asset('assets/js/plugins/jquery.inputmask.bundle.min.js')}}"></script>
{{-- custom js --}}
@vite(['resources/js/v1/pi/login.js'])
@endpush
