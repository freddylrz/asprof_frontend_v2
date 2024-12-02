@extends('v1.layouts.client_admin')

@section('content')
    <style>
        table.dataTable td.text-center {
            white-space: nowrap; /* Hindari teks melompat ke baris berikutnya */
        }
    </style>
    <div class="pct-body">
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-file mb-2" style="font-size: 2.5rem;"></i> List Data Peserta</h3></div>

            <div class="card-body">
                <table id="table" class="table table-striped table-bordered nowrap" style="max-width: 100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No Register</th>
                        <th>Nama</th>
                        <th>Profesi</th>
                        <th>Kategori Profesi</th>
                        <th>No STR</th>
                        <th>Premi</th>
                        <th>Sum Insured</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('levelPluginsJsHeader')
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    @endpush

    @push('levelPluginsJs')
        <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
        @vite(['resources/js/v1/admin/list-detail.js'])

        <script type="text/javascript">
        </script>
    @endpush
@endsection
