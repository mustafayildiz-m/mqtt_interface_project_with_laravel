@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'admin']) }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Yöneticiler</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-10">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Yönetici Oluştur
                        </button>

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Kullanıcı Oluştur</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('register') }}" class="forms-sample">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputUsername1" class="form-label">İsim</label>
                                                <input type="text" name="name" class="form-control" id="exampleInputUsername1" placeholder="İsim">
                                            </div>
                                            <div class="mb-3">
                                                <label for="userEmail" class="form-label">E-posta adresi</label>
                                                <input type="email" name="email" class="form-control" id="userEmail" placeholder="E-posta">
                                            </div>
                                            <div class="mb-3">
                                                <label for="userPassword" class="form-label">Şifre</label>
                                                <input type="password" name="password" class="form-control" id="userPassword" autocomplete="new-password" placeholder="Şifre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="userPassword" class="form-label">Şifre Tekrarı</label>
                                                <input type="password" name="password_confirmation" class="form-control" id="password-confirm" autocomplete="new-password" placeholder="Şifre Tekrarı">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">Oluştur</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                        <button type="button" class="btn btn-primary">Davet Et</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-10 offset-md-1">
                    <h6 class="card-title">Yöneticiler</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>İsim</th>
                                    <th>E-posta</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ali Onur Serçe</td>
                                    <td>onur.serce@supercode.com.tr</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-light">Düzenle</a>
                                            <a class="btn btn-sm btn-danger ms-2">Sil</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Özgür Aydın</td>
                                    <td>ozgur.aydin@supercode.com.tr</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-light">Düzenle</a>
                                            <a class="btn btn-sm btn-danger ms-2">Sil</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Köksal Tapan</td>
                                    <td>koksal.tapan@supercode.com.tr</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-sm btn-light">Düzenle</a>
                                            <a class="btn btn-sm btn-danger ms-2">Sil</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
