@extends('v1.layouts.client_admin')

@section('content')
    <div class="pct-body">
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-file mb-2" style="font-size: 2.5rem;"></i> List Batch</h3></div>

            <div class="card-body">
                <button class="btn btn-light-primary border-primary" id="btnUpload"
                    data-bs-target="#modal-upload" data-bs-toggle="modal" data-stat="2"><i class="fa fa-plus"></i> Upload Batch</button>
                    <table id="table" class="table table-striped table-bordered nowrap" style="max-width: 100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Fasyankes</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-upload">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Ulang Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="fileForm" enctype="multipart/form-data" method="POST">
                    <div class="modal-body task-card">
                        <div class="form-group">
                            <label for="">Asuransi</label>
                            <select class="form-control mb-3" name="ins_id" required id="insId">
                                <option value="">-- Pilih Asuransi --</option>
                            </select>
                            <label for="">Upload File</label>
                            <input type="file" class="form-control" required id="inputFile" name="fileUp"
                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                        <a href="{{ asset('assets/Template Named & Nakes.xlsx')}}" class="btn btn-secondary"><i class="fas fa-download"></i> Template Pendaftaran</a>
                        
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit" id="btnUpload"><i class="fas fa-upload"></i>
                            Insert</button>
                        <button type="button" class="btn btn-danger pull-right" data-bs-dismiss="modal">Tutup
                        </button>
                        </div>
                        
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @push('levelPluginsJsHeader')
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">
    @endpush

    @push('levelPluginsJs')
        <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
        @vite(['resources/js/v1/admin/list.js'])

        <script type="text/javascript">
        </script>
    @endpush
@endsection
