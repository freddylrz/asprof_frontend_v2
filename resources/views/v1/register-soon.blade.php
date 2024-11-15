@extends('v1.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card soon-card mb-0">
                <div class="card-body p-0">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="card bg-light" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                                        <div class="card-body">
                                            <h2 class="mt-3 mb-2">Daftarkan diri Anda segera </h2>
                                            <h4 class="mb-4"><b>Kami akan segera menghubungi Anda untuk memberikan informasi lebih lanjut.</b></h4>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" id="email" placeholder="Alamat Email" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="no_hp" placeholder="Nomor Telepon" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary align-items-center" id="contactButton">
                                                            <i class="ti ti-bell-ringing me-2"></i>Hubungi Saya
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 d-none d-lg-block text-center">
                            <img src="{{ asset('assets/images/landing/tata-cara-2.svg') }}" alt="img" class="img-fluid" />
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
@vite(['/resources/js/v1/pi/register-soon.js'])
@endpush
