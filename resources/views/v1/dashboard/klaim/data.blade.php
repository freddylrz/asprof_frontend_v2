@extends('v1.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h3>Daftar Klaim</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive dt-responsive">
                <table id="table-klaim" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No Klaim</th>
                        <th>Nama Asuransi</th>
                        <th>Tempat Praktik</th>
                        <th>Nama PIC</th>
                        <th>Tanggal Lapor</th>
                        <th>Tanggal Diterima</th>
                        <th>Status</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                  </table>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
@push('levelPluginsJsh')
<!-- data tables css -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endpush
@push('levelPluginsJs')
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
{{-- custom js --}}
@vite(['resources/js/v1/pi/klaim/data.js'])
@endpush
