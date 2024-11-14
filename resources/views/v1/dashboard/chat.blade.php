@extends('v1.layouts..dashboard')
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
                <div class="scroll-block chat-message">
                  <div class="card-body">
                    <div class="message-out">
                      <div class="d-flex">
                        <div class="flex-grow-1 mx-3">
                          <div class="msg-content bg-primary">
                            <p class="mb-0">Hi Good Morning!</p>
                          </div>
                          <p class="mb-0 text-muted text-sm">11:23 AM</p>
                        </div>
                      </div>
                    </div>
                    <div class="message-in">
                      <div class="d-flex">
                        <div class="flex-grow-1 mx-3">
                          <div class="msg-content">
                            <p class="mb-0">Hey. Very Good morning. How are you?</p>
                          </div>
                          <p class="mb-0 text-muted text-sm">11:23 AM</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer py-2 px-3">
                  <textarea class="form-control border-0 shadow-none px-0" placeholder="Type a Message"
                    rows="2"></textarea>
                  <hr class="my-2">
                  <div class="d-sm-flex align-items-center">
                    <ul class="list-inline me-auto mb-0">
                      <li class="list-inline-item">
                        <a href="#" class="avtar avtar-xs btn-link-secondary">
                          <i class="ti ti-paperclip f-18"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="avtar avtar-xs btn-link-secondary">
                          <i class="ti ti-photo f-18"></i>
                        </a>
                      </li>
                    </ul>
                    <ul class="list-inline ms-auto mb-0">
                      <li class="list-inline-item">
                        <a href="#" class="avtar avtar-s btn-link-primary">
                          <i class="ti ti-send f-18"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="offcanvas-md offcanvas-end chat-offcanvas" tabindex="-1" id="offcanvas_User_info">
              <div class="offcanvas-header">
                <button  class="btn-close" data-bs-dismiss="offcanvas"
                  data-bs-target="#offcanvas_User_info" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body p-0">
                <div id="chat-user_info" class="collapse collapse-horizontal">
                  <div class="chat-user_info">
                    <div class="card">
                      <div class="text-center card-body position-relative pb-0">
                        <div class="position-absolute end-0 top-0 p-3 d-none d-md-inline-flex">
                          <a href="#" class="avtar avtar-xs btn-link-danger btn-pc-default" data-bs-toggle="collapse"
                            data-bs-target="#chat-user_info">
                            <i class="ti ti-x f-16"></i>
                          </a>
                        </div>
                        <div class="chat-avtar d-inline-flex mx-auto">
                          <img class="rounded-circle img-fluid wid-100" src="{{ asset('assets/images/tib-logo.svg') }}" style="width: 128px;"
                            alt="User image">
                        </div>
                        <h5 class="mb-0">TuguBro</h5>
                        <p class="text-muted text-sm">Sr. Customer Manager</p>
                        <div class="d-flex align-items-center justify-content-center mb-4">
                          <i class="chat-badge bg-success me-2"></i>
                          <span class="badge bg-light-success">Available</span>
                        </div>
                      </div>
                      <div class="scroll-block">
                        <div class="card-body">
                          <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                            <label class="form-check-label h5 mb-0" for="customSwitchemlnot1">Notification</label>
                            <input class="form-check-input h5 mb-0 position-relative" type="checkbox"
                              id="customSwitchemlnot1" checked="">
                          </div>
                          <hr class="my-3 border border-secondary-subtle">
                          <a class="btn border-0 p-0 text-start w-100" data-bs-toggle="collapse"
                            href="#filtercollapse1">
                            <div class="float-end"><i class="ti ti-chevron-down"></i></div>
                            <h5 class="mb-0">Information</h5>
                          </a>
                          <div class="collapse show" id="filtercollapse1">
                              <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="mb-0">Email</p>
                                <p class="mb-0 text-muted">alene@company.com</p>
                              </div>
                              <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="mb-0">Phone</p>
                                <p class="mb-0 text-muted">380-293-0177</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
{{-- custom js --}}
<script src="{{ asset('storage/v1/dashboard.js?v=3') }}"></script>
@endpush
