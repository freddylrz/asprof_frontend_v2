<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Login | Admin Named & Nakes</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Able Pro is trending dashboard template made using Bootstrap 5 design framework. Able Pro is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
          content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="Phoenixcoded">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/inter/inter.css') }}" id="main-font-link"/>

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}"/>
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}"/>
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}"/>
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}"/>
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}"/>

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
<!-- [ Pre-loader ] start -->
{{--<div class="container mt-5">--}}

<div class="auth-main">
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="container" style="max-width: 600px">
                {{--                <div class="row">--}}
                {{--                            <div class="col-lg-12">--}}
                <div class="card my-5" style="box-shadow: 0 10px 15px #ddd">
                    <div class="card-header text-center">
                        <img src="../assets/images/img.png" style="width: 200px; height: 80px"/>
                    </div>

                    <div class="card-body">
                        <form method="POST" action=" " id="formLogin">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-3 col-form-label text-md-right">Username</label>

                                <div class="col-md-9">
                                    <div class="input-group search-form">
                                        <input id="username" type="text"
                                               class="form-control{{ $errors->has('email') || $errors->has('username') ? ' is-invalid' : '' }}"
                                               name="username" value="{{ old('username') }}" required autofocus
                                               placeholder="Username">
                                        <span class="input-group-text bg-transparent"><i class="feather icon-mail"></i></span>
                                    </div>

                                </div>

                            @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                                @endif

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-9">
                                    <div class="input-group search-form">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="current-password">
                                        <span class="input-group-text bg-transparent"><i id="togglePassword" class="feather icon-lock"></i></span>
                                    </div>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{--                    </div>--}}
    {{--                </div>--}}
</div>

{{--</div>--}}
<!-- [ Main Content ] end -->
<script src="{{ asset('assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>

<!-- [Page Specific JS] start -->
<script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/Jarallax.js') }}"></script>
@vite(['resources/js/v1/admin/login.js'])
<script>

</script>

</body>
</html>
