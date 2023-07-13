@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'admin']) }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.devices') }}">Cihazlar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cihaz Ekle</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="row">
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="name" name="name" placeholder="SL13323GF">
                        <label for="floatingInput">Cihaz seri no</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group mb-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="parent_id" aria-label="Default select example">
                                <option>Model seçiniz...</option>
                                <option value="1">SL (gen 1)</option>
                                <option value="1">SL (gen 2)</option>
                                <option value="1">SL (gen 3)</option>
                            </select>
                            <label for="parent_id" class="form-label">Model</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="btn btn-primary">Ekle</div>
            </div>
        </div>
    </div>
@endsection
