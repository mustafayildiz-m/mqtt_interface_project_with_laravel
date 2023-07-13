<!DOCTYPE html>
<!--
Template Name: NobleUI - Laravel Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_laravel
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
          content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">

    <title>Superlog</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <!-- end common css -->

    @stack('style')
</head>

<body data-base-url="{{ url('/') }}">

<script src="{{ asset('assets/js/spinner.js') }}"></script>

<div class="main-wrapper" id="app">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-8 offset-2 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2"><img
                                            src="{{ asset('assets/images/logo.png') }}" alt="SuperLog Logo" width="150"></a>
                                    {{-- <a href="#" class="noble-ui-logo d-block mb-2">Super<span>Log</span></a> --}}
                                    <h5 class="text-muted fw-normal mb-4">Hesap oluşturun.</h5>
                                    <form method="POST" action="{{ route('register') }}" class="forms-sample">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name" class="form-control"
                                                   id="exampleInputUsername1"  placeholder="İsim">
                                            <label for="exampleInputUsername1" class="form-label">İsim</label>
                                            @error('name')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="userEmail"
                                                   placeholder="E-posta">
                                            <label for="userEmail" class="form-label">E-posta adresi</label>
                                            @error('email')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control"
                                                   id="userPassword" autocomplete="new-password" placeholder="Şifre">
                                            <label for="userPassword" class="form-label">Şifre</label>
                                            @error('password')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   id="password-confirm" autocomplete="new-password"
                                                   placeholder="Şifre Tekrarı">
                                            <label for="userPassword" class="form-label">Şifre Tekrarı</label>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">Kaydol
                                            </button>
                                        </div>
                                        <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Hesabınız var mı?
                                            Giriş yapın</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- base js -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

<!-- common js -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- end common js -->

@stack('custom-scripts')
</body>

</html>
