@extends('layouts.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a></li>
            <li class="breadcrumb-item"><a href="{{ route('devices') }}">Destek Talepleri</a></li>
            <li class="breadcrumb-item active" aria-current="page">Destek Talebi Oluştur</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="parent_id" aria-label="Default select example">
                                <option>Hizmet seçiniz...</option>
                                <option value="1">SC-21</option>
                                <option value="1">SC-23</option>
                                <option value="1">SC-25</option>
                                <option value="1">Diğer</option>
                            </select>
                            <label for="parent_id" class="form-label">Hizmet</label>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" placeholder="Konu">
                        <label>Konu</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" style="height: 150px;"></textarea>
                        <label for="exampleFormControlSelect2">Açıklama</label>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <label for="floatingTextarea2">Ek</label>
                            <input type="file" id="myDropify" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="mb-3">
                <div class="btn btn-primary">Oluştur</div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        $(function() {
            'use strict';
            $('#myDropify').dropify({
                messages: {
                    'default': 'Dosya yüklemek için buraya sürükleyin',
                    'replace': 'Dosyayı değiştirmek için bu alana yeni bir dosya sürükleyin',
                    'remove': 'Kaldır',
                    'error': 'Bir hata oluştu.'
                }
            });
        });
    </script>
@endpush
