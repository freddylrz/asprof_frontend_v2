@extends('layouts.client_admin')

@section('content')

    <form id="fileForm" enctype="multipart/form-data" method="POST">
        <input type="file" id="inputFile" name="fileUp">
        <button type="submit">Save</button>
    </form>
    @push('levelPluginsJsHeader')
        <!-- SweetAlert2 -->
    @endpush

    @push('levelPluginsJs')
        <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>

        <script>



        </script>

    @endpush
@endsection
