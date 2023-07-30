@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ayarlar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="row">
                <div class="d-flex align-items-center">
                    <div class="profile-pic-wrapper">
                        <div class="pic-holder">
                            <img id="profilePic" class="pic" src="https://ui-avatars.com/api/?name=Super+Code">
                            <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
                            <label for="newProfilePhoto" class="upload-file-block">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="fa fa-camera fa-2x"></i>
                                    </div>
                                    <div class="text-uppercase">
                                        Update <br /> Profile Photo
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <ul>
                        <li>Minimum boyut: 512 x 512</li>
                        <li>Maksimum boyut: 2mb</li>
                        <li>Uzantılar: jpeg veya png</li>
                    </ul>
                </div>
                <hr>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" value="Supercode">
                        <label for="parent_id" class="form-label">İsim</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example">
                            <option>Çalışma alanı sahibi seçin...</option>
                            <option value="1" selected>Ali Onur Serçe</option>
                            <option value="2">Özgür Aydın</option>
                            <option value="3">Köksal Tapan</option>
                        </select>
                        <label for="parent_id" class="form-label">Çalışma alanı sahibi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="btn btn-success float-md-end" type="submit" value="Güncelle">
                    </div>
                </div>
                <hr>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <div class="mb-3 text-danger">
                            Çalışma alanını silmek içerisinde kayıtlı bölgeleri ve cihazları tamamen silecektir ve bu
                            işlemin geri dönüşü yoktur.
                        </div>
                        <button class="btn btn-danger">
                            Çalışma alanını sil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
