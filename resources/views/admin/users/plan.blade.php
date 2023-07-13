@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Kullanıcılar</a></li>
            <li class="breadcrumb-item"><a href="#">Ali Onur Serçe</a></li>
            <li class="breadcrumb-item active" aria-current="page">Plan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                        <div class="card border border-primary">
                            <div class="card-body">
                                <h4 class="text-center mt-3 mb-4">Giriş</h4>
                                <i data-feather="award" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                <h1 class="text-center">40₺</h1>
                                <p class="text-muted text-center mb-4 fw-light">aylık</p>
                                <h5 class="text-primary text-center mb-4">5 cihaz</h5>
                                <table class="mx-auto">
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Accounting dashboard</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Invoicing</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Online payments</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                        <td>
                                            <p class="text-muted">Branded website</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                        <td>
                                            <p class="text-muted">Dedicated account manager</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                        <td>
                                            <p class="text-muted">Premium apps</p>
                                        </td>
                                    </tr>
                                </table>
                                <div class="d-grid">
                                    <button class="btn btn-primary mt-4" disabled>Aktif</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center mt-3 mb-4">Kurumsal</h4>
                                <i data-feather="home" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                <h1 class="text-center">70₺</h1>
                                <p class="text-muted text-center mb-4 fw-light">aylık</p>
                                <h5 class="text-primary text-center mb-4">25 cihaz</h5>
                                <table class="mx-auto">
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Accounting dashboard</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Invoicing</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Online payments</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Branded website</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Dedicated account manager</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                        <td>
                                            <p class="text-muted">Premium apps</p>
                                        </td>
                                    </tr>
                                </table>
                                <div class="d-grid">
                                    <button class="btn btn-primary mt-4">Etkinleştir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center mt-3 mb-4">Profesyonel</h4>
                                <i data-feather="briefcase" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                <h1 class="text-center">250₺</h1>
                                <p class="text-muted text-center mb-4 fw-light">aylık</p>
                                <h5 class="text-primary text-center mb-4">Sınırsız cihaz</h5>
                                <table class="mx-auto">
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Accounting dashboard</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Invoicing</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Online payments</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Branded website</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Dedicated account manager</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                        <td>
                                            <p>Premium apps</p>
                                        </td>
                                    </tr>
                                </table>
                                <div class="d-grid">
                                    <button class="btn btn-primary mt-4">Etkinleştir</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-3 mt-4">Ek İletişim Paketleri</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center mt-3 mb-4">E-posta</h4>
                                <i data-feather="mail" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                <h1 class="text-center">40₺</h1>
                                <h5 class="text-primary text-center mb-4">1000 e-posta</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary mt-4">Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center mt-3 mb-4">SMS</h4>
                                <i data-feather="smartphone" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                <h1 class="text-center">70₺</h1>
                                <h5 class="text-primary text-center mb-4">500 SMS</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary mt-4">Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center mt-3 mb-4">Arama</h4>
                                <i data-feather="phone-call" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                <h1 class="text-center">250₺</h1>
                                <h5 class="text-primary text-center mb-4">100 arama</h5>
                                <div class="d-grid">
                                    <button class="btn btn-primary mt-4">Ekle</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
