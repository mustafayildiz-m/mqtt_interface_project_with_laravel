@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Hesap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-10 offset-md-1">
            <form
                action="/{{$workspace_detail->id}}/profile/edit-profile/"
                method="post"
                enctype="multipart/form-data">
                @method('post')
                @csrf

                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="old_image" value="@if(isset($user_info->user_img))
                {{asset($user_info->user_img)}}  @endif">
                <div class="d-flex align-items-center">
                    <div class="profile-pic-wrapper">
                        <div class="pic-holder">
                            <img id="profilePic1" class="pic"
                                 src="@if(isset($user_info->user_img)) {{asset($user_info->user_img)}} @endif"
                            >
                            <Input class="uploadProfileInput" type="file"
                                   onchange="loadFile(event)" name="image"
                                   id="newProfilePhoto"
                                   accept="image/*" style="opacity: 0;"/>
                            <label for="newProfilePhoto" class="upload-file-block">
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="fa fa-camera fa-2x"></i>
                                    </div>
                                    <div class="text-uppercase">
                                        Update <br/> Profile Photo
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
                <h3 class="mt-5 mb-3">Hakkımda</h3>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                           name="email" value="@if(isset($user_info->email)) {{$user_info->email}} @endif">
                    <label for="floatingInput">E-posta</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="John Doe"
                           name="name" value="@if(isset($user_info->name)) {{$user_info->name}} @endif">
                    <label for="floatingInput">İsim</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="user_phone" class="form-control mb-4 mb-md-0"
                           value="@if(isset($user_info->user_phone)) {{$user_info->user_phone}} @endif"
                           data-inputmask-alias="+\90 999 999 99 99"/>
                    <label for="floatingInput">Telefon</label>
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
                <hr>
            </form>
            <h3 class="mt-5 mb-3">Şifre</h3>
            <form method="POST" action="{{ route('change.password') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input
                        id="current_password" name="current_password" required
                        type="password" class="form-control" placeholder="Şifre">
                    <label for="current_password">Mevcut Şifre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="new_password" id="new_password"
                           placeholder="Şifre">
                    <label for="new_password">Şifre</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="new_password_confirmation" class="form-control"
                           id="new_password_confirmation" placeholder="Şifre Tekrarı">
                    <label for="new_password_confirmation">Şifre Tekrarı</label>
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>


        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>


    <script>


        var loadFile = function (event) {
            var output = document.getElementById('profilePic1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };


    </script>
@endpush

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endpush
