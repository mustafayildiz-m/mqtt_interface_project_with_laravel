<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Superlog">
    <meta name="keywords" content="superlog">

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
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper"
                                     style="background-image: url({{ asset('assets/images/login-bg-2.jpeg') }})">
                                </div>
                            </div>
                            @include('sweetalert::alert')

                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2"><img
                                            src="{{ asset('assets/images/logo.png') }}" alt="SuperLog Logo" width="150"></a>
                                    <h5 class="text-muted fw-normal mb-4">Hesabınıza giriş yapın.</h5>
                                    <form method="POST" action="{{ route('login') }}" class="forms-sample">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">E-posta adresi</label>
                                            <input type="email" name="email" class="form-control" id="userEmail"
                                                   placeholder="E-posta" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Şifre</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="userPassword" autocomplete="current-password" placeholder="Şifre"
                                                   required>
                                        </div>

                                        <div>
                                            <button type="submit"
                                                    class="btn btn-primary me-2 mb-2 mb-md-0 w-50 rounded">Giriş
                                            </button>
                                        </div>
                                        <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Üyeliğiniz yok
                                            mu? Kaydolun</a>
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
