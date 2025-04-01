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
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Polis</th>
                      <th>No Klaim</th>
                      <th>Tanggal Lapor</th>
                      <th>Tanggal Kejadian</th>
                      <th>Nilai Klaim</th>
                      <th>Status</th>
                      <th>Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>3321110110030029230</td>
                      <td>PI/KLAIM/202503/00004</td>
                      <td>17 March 2025</td>
                      <td>15 March 2025</td>
                      <td>324,453,485</td>
                      <td>PROSES VERIFIKASI REVISI DOKUMEN DI ASURANSI</td>
                      <td class="text-center"><button class="btn btn-primary btn-icon btn-sm"><i class="ti ti-eye"></i></button></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>015920200820003400</td>
                      <td>PI/KLAIM/202501/00002</td>
                      <td>21 February 2025</td>
                      <td>18 February 2025</td>
                      <td>119,062,382</td>
                      <td>KLAIM SUDAH DIBAYAR (CLOSED FILE)</td>
                      <td class="text-center"><button class="btn btn-primary btn-icon btn-sm"><i class="ti ti-eye"></i></button></td>
                    </tr>
                  </tbody>
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
<script src="{{ asset('storage/v1/dashboard.js?v=1') }}"></script>
<script>
  // [ DOM/jquery ]
  var table = $('#dom-jqry').DataTable();
</script>
@endpush
