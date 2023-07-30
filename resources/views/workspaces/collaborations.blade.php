@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Katılımcılar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-10">
                    <div class="d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                            Davet Et
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Davet Et</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form action="/{{$workspace_detail->id}}/workspace/invite-email" method="post"
                                          class="forms-sample">
                                        <div class="modal-body">

                                            <div class="form-floating mb-3">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" value="{{$workspace_detail->id}}"
                                                       name="workspace_id">

                                                <input type="email" name="email" class="form-control"
                                                       id="exampleFormControlInput1"
                                                       placeholder="name@example.com" required>
                                                <label for="exampleFormControlInput1" class="form-label">E-posta</label>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="user_role"
                                                           id="inlineRadio1" value="admin">
                                                    <label class="form-check-label" for="inlineRadio1">Admin</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="user_role"
                                                           id="inlineRadio2" value="user" checked>
                                                    <label class="form-check-label" for="inlineRadio2">Üye</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">İptal
                                            </button>
                                            <button type="submit" class="btn btn-primary">Davet Et</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-10 offset-md-1">
                    <h6 class="card-title">Katılımcılar</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>*</th>
                                <th></th>
                                <th>İsim</th>
                                <th>E-posta</th>
                                <th>Kayıt Durumu</th>
                                <th>Yetki</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($allowed_users))
                                @foreach($allowed_users as $key => $allow)

                                    <tr>
                                        <td></td>
                                        <td>{{$key+1}}</td>
                                        <td>{{$allow->user_name}}</td>
                                        <td>{{$allow->allowed_email}}</td>
                                        <td>Kayıt Oldu</td>
                                        <td>@if($allow->user_role==='user')
                                                Kullanıcı
                                            @elseif($allow->user_role==='admin')
                                                Admin
                                            @else
                                                Owner
                                            @endif</td>
                                        <td>
                                            <button class="btn btn-sm btn-light">Düzenle</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <span>Bu alan paylaşımı olmadı</span>
                            @endif
                            @if(isset($not_registered))
                                @foreach($not_registered as $key=> $not_register)
                                    <tr>
                                        <td></td>
                                        <td>{{$key+1}}</td>
                                        <td>İsim bilgisi alınamadı</td>
                                        <td>{{$not_register->allowed_email}}</td>
                                        <td>Kayıt Henüz Gerçekleşmedi</td>
                                        <td>@if($not_register->user_role==='user')
                                                Kullanıcı
                                            @elseif($not_register->user_role==='admin')
                                                Admin
                                            @else
                                                Owner
                                            @endif</td>
                                        <td>
                                            <button class="btn btn-sm btn-light">Düzenle</button>
                                        </td>
                                    </tr>

                                @endforeach

                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
