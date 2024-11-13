@extends('v1.layouts..dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h3>Input Klaim</h3>
              <small>Pastikan mengisi klaim dengan benar sesuai data yang Anda miliki untuk mempercepat proses pengajuan</small>
            </div>
                <form>
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                               <label class="form-label required">Pilih STR</label>
                               <select class="form-control" data-trigger name="str" id="pilih-str">
                                  <option value="1">124980572095</option>
                                  <option value="2">805092529037</option>
                                  <option value="0">Lainnya</option>
                               </select>
                            </div>
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label required">Tanggal kejadian</label>
                                <div class="input-group date mb-3">
                                <input type="text" class="form-control datepicker-bs5" placeholder="Tanggal kejadian" id="periode-awal-str">
                                <span class="input-group-text">
                                <i class="feather icon-calendar"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              <label class="form-label required">Nilai Kerugian</label>
                              <input type="text" class="form-control" placeholder="Nilai Kerugian" id="nomor-sip">
                           </div>
                        </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                               <label class="form-label required">Keterangan</label>
                               <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Keterangan"></textarea>
                            </div>
                         </div>
                         <div class="col-lg-6">
                            <div class="form-group">
                               <label class="form-label required">Unggah File</label>
                               <input type="file" class="form-control" id="unggah-str" accept=".jpg, .jpeg, .png">
                            </div>
                         </div>
                    </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary me-2">Submit</button>
              <button type="reset" class="btn btn-light">Reset</button>
            </div>
        </form>
          </div>
        </div>
    </div>
@endsection
@push('levelPluginsJs')
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
{{-- custom js --}}
<script src="{{ asset('storage/v1/dashboard.js?v=1') }}"></script>
@endpush

