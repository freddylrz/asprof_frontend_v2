@extends('v1.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <p style="font-size:1rem">
                    Kami memahami bahwa keputusan untuk membatalkan polis bukanlah hal yang mudah. Jika Anda yakin ingin melanjutkan proses pembatalan, harap tinjau kembali informasi di bawah ini.
                </p>
            </div>
        </div>
        <div class="col-12">
            <div class="card my-3" style="box-shadow: 0 1rem 1rem rgba(0, 0, 0, 0.175) !important; border: 2px solid #dddddd;">
                <div class="card-body px-0">
                   <div class="row">
                    <div class="col-12">
                        <div class="mb-2 mx-4">
                           <p class="h3">Detail Pembatalan</p>
                        </div>
                    </div>
                      <div class="col-12 col-lg-6">
                         <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                               <div class="d-flex align-items-center">
                                  <div class="flex-shrink-0">
                                     <div class="avtar avtar-s bg-light-secondary">
                                        <i class="ti ti-calendar-time f-32"></i>
                                     </div>
                                  </div>
                                  <div class="flex-grow-1 ms-3">
                                     <div class="row g-1">
                                        <div class="col-12">
                                           <p class="text-muted mb-1">Periode Polis Berjalan</p>
                                           <h5 class="mb-0" id="periode-polis">9 bulan</h5>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </li>
                         </ul>
                      </div>
                      <div class="col-12 col-lg-6">
                         <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                               <div class="d-flex align-items-center">
                                  <div class="flex-shrink-0">
                                     <div class="avtar avtar-s bg-light-secondary">
                                        <i class="ti ti-receipt-refund f-32"></i>
                                     </div>
                                  </div>
                                  <div class="flex-grow-1 ms-3">
                                     <div class="row g-1">
                                        <div class="col-12">
                                           <p class="text-muted mb-1">Refund</p>
                                           <h5 class="mb-0" id="periode-polis">Hak pengembalian premi akan disesuaikan dengan ketentuan polis.</h5>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </li>
                         </ul>
                      </div>
                   </div>
                </div>
                <div class="card-footer text-end">
                  <button type="button" id="submit-button" class="btn btn-primary me-2">Submit</button>
                </div>
             </div>
        </div>
    </div>
@endsection

@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script>
    document.getElementById('submit-button').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Pembatalan',
            text: 'Apakah Anda yakin ingin membatalkan polis ini? Tindakan ini dapat mengakhiri polis asuransi Anda.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna menekan tombol "Ya, batalkan!"
                // Anda bisa menambahkan kode untuk mengirimkan form atau melakukan tindakan lain di sini
                document.querySelector('form').submit();
            }
        });
    });
</script>
@endpush
