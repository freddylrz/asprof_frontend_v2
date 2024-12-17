@extends('v1.layouts.client_admin')

@section('content')
    <div class="pct-body">
        <div class="card">
            <div class="card-header"><h3><i class="fas fa-file mb-2" style="font-size: 2.5rem;"></i> List Batch</h3></div>

            <div class="card-body">
                <form id="fileForm" enctype="multipart/form-data" method="POST">
                    <div class="card">
                        <div class="card-header" style="background-color:#e5ecfa;max-height: 40px; padding: 10px 0 10px 10px !important;">
                            <h4>Insert Batch</h4>
                        </div>
                        <div class="card-body" style="padding: 10px 0 10px 10px !important;">
                            <div class="row p-2" style="">
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label>Upload File</label>
                                        <input type="file" class="form-control" id="inputFile" required name="fileUp" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Asuransi</label>
                                        <select class="form-control mb-3" name="ins_id" required id="insId">
                                            <option value="">-- Pilih Asuransi --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-center">
                                    <button class="btn btn-primary " type="submit" id="btnUpload">
                                        <i class="fas fa-upload"></i> Insert
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
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
