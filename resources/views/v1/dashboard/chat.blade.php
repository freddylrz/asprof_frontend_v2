@extends('v1.layouts.dashboard')
@section('content')
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="chat-wrapper">
            <div class="chat-content">
              <div class="card mb-0">
                <div class="card-header p-3">
                  <div class="d-sm-flex align-items-center">
                    <ul class="list-inline me-auto mb-0">
                      <li class="list-inline-item">
                        <div class="media align-items-center">
                          <div class="chat-avtar">
                            <img class="rounded-circle img-fluid wid-40" src="{{ asset('assets/images/tib-logo.svg') }}" style="width: 50px;"
                              alt="User image">
                            <i class="chat-badge bg-success"></i>
                          </div>
                          <div class="media-body mx-3">
                            <h5 class="mb-0">TuguBro</h5>
                            <span class="text-sm text-muted">Active 2 hours ago</span>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <ul class="list-inline ms-auto mb-0">
                      <li class="list-inline-item">
                        <a href="#" class="d-md-none avtar avtar-s btn-link-secondary" data-bs-toggle="offcanvas"
                          data-bs-target="#offcanvas_User_info">
                          <i class="ti ti-info-circle f-18"></i>
                        </a>
                        <a href="#" class="d-none d-md-inline-flex avtar avtar-s btn-link-secondary"
                          data-bs-toggle="collapse" data-bs-target="#chat-user_info">
                          <i class="ti ti-info-circle f-18"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="scroll-block chat-message" id="chat-container">
                  <div class="card-body">
                  </div>
                </div>
                <div class="card-footer py-2 px-3 d-flex align-items-start">
                    <textarea
                      id="messageInput"
                      class="form-control border-0 shadow-none rounded-sm me-2"
                      name="message"
                      placeholder="Type a Message"
                      rows="1"
                      style="resize: none; max-height: 150px; overflow-y: auto;"
                    ></textarea>
                    <button
                        id="sendMessage"
                        class="btn btn-primary rounded-circle d-flex justify-content-center align-items-center disabled"
                        style="width: 40px; height: 40px; margin-top: 0;">
                        <i class="ti ti-send"></i>
                    </button>
                  </div>

              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
@endsection
@push('levelPluginsJs')
<!-- Sweet Alert -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
@vite(['resources/js/app.js'])
@endpush
