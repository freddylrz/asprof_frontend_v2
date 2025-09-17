@extends('v1.layouts.app')
@section('content')
    <div class="container">
        <div class="col-12 col-xl-4 offset-xl-4 col-lg-8 offset-lg-2 col-md-12 col-sm-12">
            <div class="card bg-light my-5"
                style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                <div class="card-body">
                    <ul class="nav nav-tabs d-none" id="authTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="auth-tab-1" data-bs-toggle="tab" href="#auth-1" role="tab"
                                data-slide-index="1" aria-controls="auth-1" aria-selected="true"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="auth-tab-2" data-bs-toggle="tab" href="#auth-2" role="tab"
                                data-slide-index="2" aria-controls="auth-2" aria-selected="true"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="auth-tab-3" data-bs-toggle="tab" href="#auth-3" role="tab"
                                data-slide-index="3" aria-controls="auth-3" aria-selected="true"></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Tab for login with email and STR -->
                        <div class="tab-pane show active" id="auth-1" role="tabpanel" aria-labelledby="auth-tab-1">
                            <div class="text-center mb-4">
                                <h4>Masuk ke Akun Anda</h4>
                                <p>Harap login menggunakan email terdaftar dan nomor STR.</p>
                            </div>
                            <div class="row my-2">
                                <div class="col-lg-12">
                                    <!-- Login form -->
                                    <form id="loginForm" role="form" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                                <div class="form-group mb-3">
                                                    <div class="input-group">
                                                        <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="Masukan alamat email">
                                                        <span class="input-group-text"><i class="ti ti-mail f-20"></i></span>
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group mb-3">
                                                    <div class="input-group">
                                                    <input type="text" class="form-control enambelas" name="str_no"
                                                        id="strNo" placeholder="Masukan nomor STR">
                                                        <span class="input-group-text"><i class="ti ti-notes f-20"></i></span>
                                                    </div>
                                                </div>
                                        <div class="d-grid mt-4">
                                            <button type="submit" class="btn btn-xl btn-primary rounded-0"
                                                id="loginButton"><i class="ti ti-login"></i> Masuk </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <style>
                                .divider {
                                    display: flex;
                                    align-items: center;
                                    text-align: center;
                                    color: #555;
                                }

                                .divider::before,
                                .divider::after {
                                    content: '';
                                    flex: 1;
                                    border-bottom: 1px solid #aaa;
                                }

                                .divider:not(:empty)::before {
                                    margin-right: .75em;
                                }

                                .divider:not(:empty)::after {
                                    margin-left: .75em;
                                }
                            </style>

                            <div class="d-flex align-items-center">
                                <hr class="flex-grow-1">
                                <span class="mx-1 text-muted">atau</span>
                                <hr class="flex-grow-1">
                            </div>

                            <div class="p-3 px-lg-2 text-center">
                                <h4 class="text-dark">Belum memiliki asuransi tanggung gugat profesi?</h4>
                                <a href="/pendaftaran" class="btn btn-light-success border border-success btn-xl w-100 rounded-0 my-2"><i class="ti ti-edit"></i> Daftar Sekarang</a>
                            </div>
                        </div>

                        <!-- Tab for choosing OTP method -->
                        <div class="tab-pane" id="auth-2" role="tabpanel" aria-labelledby="auth-tab-2">
                            <div class="text-center mb-4">
                                <h3 class="h3">Pilih Metode OTP</h3>
                                <p class="text-muted mb-4">Pilih bagaimana Anda ingin menerima kode OTP</p>
                            </div>

                            <!-- Pilihan metode OTP -->
                            <div class="row my-4 text-center">
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="auth-option">
                                        <input type="radio" class="btn-check" name="otp_method" id="method_email"
                                            value="1" checked />
                                        <label class="auth-megaoption btn btn-outline-primary w-100 py-3"
                                            for="method_email">
                                            <i class="fas fa-envelope mb-2" style="font-size: 3rem;"></i>
                                            <span class="h5">Email</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="auth-option">
                                        <input type="radio" class="btn-check" name="otp_method" id="method_sms"
                                            value="2" />
                                        <label class="auth-megaoption btn btn-outline-success w-100 py-3"
                                            for="method_sms">
                                            <i class="fas fa-sms mb-2" style="font-size: 3rem;"></i>
                                            <span class="h5">SMS</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="button" class="btn btn-lg btn-primary" id="chooseMethodButton">Kirim Kode
                                    OTP <i class="ti ti-send"></i></button>
                            </div>
                        </div>

                        <!-- Tab for OTP input -->
                        <div class="tab-pane" id="auth-3" role="tabpanel" aria-labelledby="auth-tab-3">
                            <div class="text-center mb-4">
                                <h3 class="h3">Masukan kode OTP</h3>
                                <p class="text-muted mb-4" id="otpMethodText">Kami telah mengirim kode OTP ke email anda.
                                </p>
                            </div>
                            <!-- OTP form -->
                            <form id="otpForm" role="form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row my-4 text-center">
                                    <div class="col"><input type="text"
                                            class="form-control text-center otpInput enam"
                                            style="font-size: 28px;font-weight: 900;letter-spacing:0.3em" autofocus />
                                    </div>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary mb-4" id="otpButton">Lanjutkan
                                        <i class="ti ti-login"></i></button>
                                </div>
                            </form>
                            {{-- <div class="d-flex justify-content-start align-items-end mt-3">
                            <p class="mb-0">Tidak menerima email?<a href="#" class="link-primary d-block" id="resendCode">Kirim kembali kode otp</a></p>
                        </div> --}}
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
    <!-- choices js -->
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
    <!-- bootstrap-datepicker -->
    <script src="{{ asset('assets/js/plugins/datepicker-full.min.js') }}"></script>
    <!-- input mask -->
    <script src="{{ asset('assets/js/plugins/jquery.inputmask.bundle.min.js') }}"></script>
    {{-- custom js --}}
    @vite(['resources/js/v1/pi/login.js'])
@endpush
