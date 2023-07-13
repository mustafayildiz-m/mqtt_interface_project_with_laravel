@extends('layouts.master')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'supercode']) }}">Supercode</a>
            </li>
            <li class="breadcrumb-item"><a
                    href="{{ route('devices',['workspace'=>$workspace_detail->id]) }}">Cihazlar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cihaz Ekle</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <form action="/devices/create-device" method="post">
                <div class="row">

                    <div class="col-5">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required id="serial_no" name="serial_no"
                                   placeholder="SL13323GF">
                            <label for="floatingInput">Cihaz seri no</label>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <span class="d-flex justify-content-center align-items-end">Veya</span>
                    </div>
                    @csrf
                    @method('post')
                    <input type="hidden" value="{{$workspace_detail->id}}" name="workspace_id">
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="col-5">
                        <div class="input-group">
                            <select class="form-select select-test" name="serial_no" id="device_name"
                                    aria-label="Default select example">
                                <option>İzinli cihaz seçiniz...</option>
                                @if(isset($allowed_devices))
                                    @foreach($allowed_devices as $device)
                                        <option
                                            value="{{$device->serial_no}}"
                                            data-serial="<?=$device->serial_no ?>">{{$device->device_name}}</option>
                                    @endforeach
                                @endif



                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="parent_id" aria-label="Default select example">
                                    <option>Hazır konfigürasyon seçiniz...</option>
                                    <option value="1">Ev (15-30 °C sıcaklık ve %30-%45 nem)</option>
                                    <option value="1">Eczane (15-30 °C sıcaklık ve %30-%45 nem)</option>
                                    <option value="1">Sunucu Odası (15-30 °C sıcaklık ve %30-%45 nem)</option>
                                    <option value="1">Ev (15-30 °C sıcaklık ve %30-%45 nem)</option>
                                </select>
                                <label for="parent_id" class="form-label">Konfigürasyon</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Ekle">
                </div>
            </form>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
            integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>


    <script>
        $(document).ready(function () {
            $('.select-test').select2();
            $('#device_name').on('change', function () {
                $('#serial_no').val($(this).find('option:selected').data('serial'));
            })

        })
    </script>

@endsection

