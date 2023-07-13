@extends('demo.layout.master2')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                <img src="{{ url('assets/images/others/404.svg') }}" class="img-fluid mb-2" alt="404">
                <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">404</h1>
                <h4 class="mb-2">Sayfa Bulunamdı</h4>
                <h6 class="text-muted mb-3 text-center">
                    Aradığınız sayfa mevcut değil..</h6>
                <a href="{{ url('/') }}">Anasayfaya Dön</a>
            </div>
        </div>

    </div>
@endsection
