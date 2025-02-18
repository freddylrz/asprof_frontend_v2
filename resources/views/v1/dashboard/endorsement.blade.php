@extends('v1.layouts.dashboard')

@section('content')
    <style>
        .endorsement-button {
            border-radius: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: transparent; /* Latar belakang transparan */
            border: 2px solid; /* Border dengan warna sesuai */
            padding: 2rem; /* Ukuran tombol menjadi kotak */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .endorsement-button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .endorsement-button i {
            font-size: 2rem; /* Perbesar font icon */
        }
        .endorsement-button span {
            font-size: 1.25rem; /* Perbesar teks */
        }
        .endorsement-button small {
            font-size: 0.875rem; /* Sesuaikan ukuran teks kecil */
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                <div class="card-body">
                   <div class="row g-4">
                    <div class="col-12 text-center mb-4">
                        <h3 class="fw-bold">Endorsement</h3>
                    </div>
                      <div class="col-12 col-lg-6 d-flex justify-content-center">
                          <button type="button" class="btn btn-outline-primary endorsement-button w-100">
                              <i class="ti ti-edit" style="font-size: 64px"></i><br>
                              <span class="h5">Ubah Data Diri</span>
                          </button>
                      </div>
                      <div class="col-12 col-lg-6 d-flex justify-content-center">
                          <button type="button" class="btn btn-outline-success endorsement-button w-100">
                              <i class="ti ti-package" style="font-size: 64px"></i><br>
                              <p class="h5 ">Ubah Paket<br><small class="h6"><span class="text-danger">*</span>Perubahan paket akan mempengaruhi nilai premi Anda</small></p>

                          </button>
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
@endpush
