@extends('v1.layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Riwayat Polis</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive dt-responsive">
                        <table id="policy-history-table" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Asuransi</th>
                                    <th>No. Polis</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Plan</th>
                                    <th>Sum Insured</th>
                                    <th>Premi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('levelPluginsCss')
    <!-- data tables css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>

    @vite(['resources/js/v1/pi/polis-history.js'])
@endpush
