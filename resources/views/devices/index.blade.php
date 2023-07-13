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
            <li class="breadcrumb-item active" aria-current="page">Cihazlar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-10 offset-1">
            <div class="d-flex justify-content-end my-3">
                <a href="{{ route('devices', ['view' => 'list','workspace' =>$workspace_detail->id]) }}"
                   class="btn btn-primary">Liste Görünümü</a>
                <a   href="javascript:void(0)"
                     data-bs-toggle="modal"
                     data-bs-target="#workspaceStaticBackdrop6"
                   class="btn btn-primary ms-3">Cihaz Ekle</a>
            </div>
        </div>
    </div>


    <hr>




    <h2 class="mb-3">Cihazlarım</h2>
    <div class="row">
        @if(isset($devices))
            @foreach($devices as $key => $device)
                    <?php
                    if (isset(\App\Models\DeviceLog::where('serial_no', $device->serial_no)->latest('id')->first()->created_at)) {
                        date_default_timezone_set('Europe/Istanbul');
                        $currentTime = date("Y-m-d H:i:s");
                        $created_at = \App\Models\DeviceLog::where('serial_no', $device->serial_no)->latest('id')->first()->created_at;
                        $yeniGuncelle = strtotime($currentTime);
                        $eskiGuncelle = strtotime($created_at);
                        $fark = $yeniGuncelle - $eskiGuncelle;
                        $min = floor($fark / (60));

                        $class = '';
                        if (intval($min) > intval($device->notice_period)) {
                            $class = 'danger';
                        } else {
                            $class = 'success';
                        }
                    }


                    ?>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="card">
                        <div class="card-image-header">
                            <div class="card-image">
                                <img src="{{asset($device->device_img)}}" class="card-img-top" alt="...">
                                <div class="device-info">
                                    <div class="device-name"><span class="badge">{{$device->serial_no}}</span></div>
                                    <div class="zone-name"><span
                                            class="badge">{{$device->device_name}}</span></div>
                                </div>
                                <div class="workspace-info">
                                    <span class="badge bg-dark">Supercode</span>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">

                            <div class="d-flex justify-content-around">
                                @if(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->count() != 0)
                                    <div class="d-flex align-items-center badge
                                    @if(intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->temp)>intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->temp_max) &&intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->temp)< intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->crit_temp_max) ) bg-danger
                                    @elseif(intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->temp) < intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->temp_min)) bg-warning
                                    @elseif(intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->temp) > intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->crit_temp_max)) bg-danger blink
                                    @else bg-success
                                    @endif">
                                        <i class="icon-md"
                                           data-feather="coffee"></i><span
                                            class="ms-2">{{\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->temp}}°C</span>
                                    </div>

                                    <div class="d-flex align-items-center badge
                                    @if(intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->humd)>intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->moisture_max) &&intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->humd) < intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->crit_moisture_max)) bg-danger
                                    @elseif(intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->humd) < intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->moisture_min)) bg-warning
                                    @elseif(intval(\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->humd) > intval(\App\Models\DeviceTempHumLimit::where('serial_no',$device->serial_no)->latest('id')->first()->crit_moisture_max)) bg-danger blink
                                    @else bg-success
                                    @endif"><i class="icon-md"
                                               data-feather="droplet"></i><span
                                            class="ms-2">% {{\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->humd }}</span>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center badge bg-info"><i class="icon-md"
                                                                                            data-feather="droplet"></i><span
                                            class="ms-2"> Değer yok</span>
                                    </div>

                                @endif


                                @if(isset($class))
                                    <div
                                        class="d-flex align-items-center badge bg-{{$class}}">

                                        <i class="icon-md"
                                           data-feather="check-square"></i><span
                                            class="ms-2">{{$class ==='success'? 'Aktif' : 'Deactive' }}</span></div>


                                @else
                                    <div
                                        class="d-flex align-items-center badge bg-danger">

                                        <i class="icon-md"
                                           data-feather="check-square"></i><span
                                            class="ms-2">Deactive</span></div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex  justify-content-between align-items-baseline">
                                <a href="{{ route('report', ['serial'=>$device->serial_no,'workspace'=>$workspace_detail->id]) }}"
                                   class="btn btn-xs"><i
                                        class="icon-md" data-feather="bar-chart"></i> Raporlar</a>
                                <a href="{{ route('devices.edit', ['id'=>$device->serial_no,'workspace'=>$workspace_detail->id]) }}"
                                   class="btn btn-xs"><i
                                        class="icon-md"
                                        data-feather="settings"></i>
                                    Ayarlar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <span>Cihaz Bulunamadı</span>
        @endif

    </div>


    <div class="modal fade" id="workspaceStaticBackdrop6" data-bs-backdrop="static" data-bs-keyboard="false"
         aria-labelledby="workspaceStaticBackdropdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="workspaceStaticBackdropdropLabel">Cihaz Ekle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <form action="/devices/create-device" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-floating mb-3">

                                <input type="hidden" name="workspace_id" value="{{$workspace_detail->id}}">
                                <input type="text" required id="serial_no" name="serial_no"
                                       class="form-control">
                                <label for="exampleFormControlInput1" class="form-label">Cihaz Seri No</label>
                            </div>
                            <div class="input-group">
                                <select class="form-select select-test" id="device_name"
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

                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">İptal
                        </button>
                        <button type="submit" class="btn btn-primary">Ekle</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        .blink {
            animation: blinker 0.9s linear infinite;
            color: white;
            background-color: red !important;
            text-align: center;

        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }
    </style>


    {{--    <h2 class="my-3">Benimle Paylaşılan Cihazlar</h2>--}}
    {{--    <div class="row">--}}
    {{--        <div class="col-12 col-md-4 col-lg-3">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-image-header">--}}
    {{--                    <div class="card-image">--}}
    {{--                        <img src="https://placehold.co/600x400" class="card-img-top" alt="...">--}}
    {{--                        <div class="device-info">--}}
    {{--                            <div class="device-name"><span class="badge">SC-24</span></div>--}}
    {{--                            <div class="zone-name"><span class="badge">Teknopark Ankara > Sunucu Odası 1 > Giriş</span>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="workspace-info">--}}
    {{--                            <span class="badge bg-dark">Supercode</span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="card-body">--}}
    {{--                    <div class="d-flex justify-content-around">--}}
    {{--                        <div class="d-flex align-items-center badge bg-success"><i class="icon-md"--}}
    {{--                                                                                   data-feather="coffee"></i><span--}}
    {{--                                class="ms-2">27°C</span></div>--}}
    {{--                        <div class="d-flex align-items-center badge bg-success"><i class="icon-md"--}}
    {{--                                                                                   data-feather="droplet"></i><span--}}
    {{--                                class="ms-2">%30</span></div>--}}
    {{--                        <div class="d-flex align-items-center badge bg-success"><i class="icon-md"--}}
    {{--                                                                                   data-feather="check-square"></i><span--}}
    {{--                                class="ms-2">Aktif</span></div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="card-footer">--}}
    {{--                    <div class="d-flex  justify-content-between align-items-baseline">--}}
    {{--                        <a href="#" class="btn btn-xs"><i class="icon-md" data-feather="bar-chart"></i> Raporlar</a>--}}
    {{--                        <a href="{{ route('devices.edit', ['id'=>3,'workspace'=>$workspace_detail->id]) }}"--}}
    {{--                           class="btn btn-xs"><i class="icon-md"--}}
    {{--                                                 data-feather="settings"></i>--}}
    {{--                            Ayarlar</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--    </div>--}}
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
            integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>


    <script>
        $(document).ready(function () {
            $('.select-test').select2({
                dropdownParent: $("#workspaceStaticBackdrop6")
            });
            $('#device_name').on('change', function () {
                $('#serial_no').val($(this).find('option:selected').data('serial'));
            })

        })
    </script>
@endsection
