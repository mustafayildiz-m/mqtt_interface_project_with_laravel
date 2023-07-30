@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Cihazlar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-10 offset-1">
            <div class="d-flex justify-content-end my-3">
                <a href="{{ route('devices', ['workspace' => $workspace_detail->id]) }}" class="btn btn-primary">Kart
                    Görünümü</a>
                <a href="javascript:void(0)"
                   data-bs-toggle="modal"
                   data-bs-target="#workspaceStaticBackdrop7"
                   class="btn btn-primary ms-3">Cihaz Ekle</a>
            </div>
        </div>
        <div class="col-md-10 offset-1 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Cihazlar</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>İsim</th>
                                <th>Durum</th>
                                <th>Bölge</th>
                                <th>Isı</th>
                                <th>Nem</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $svg = <<<EOF
<svg  style="color: red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                                                                </svg>
EOF;
                            ?>

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

                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th><img src="{{asset($device->device_img)}}" style="max-width: 90px"
                                                 class="card-img-top" alt="..."></th>
                                        <td>{{$device->device_name}}</td>

                                        @if(isset($class))

                                            <td><span
                                                    class="btn btn-sm btn-{{$class}}"><small>{{$class ==='success'? 'Aktif' : 'Deaktif' }}</small></span>
                                            </td>

                                        @else
                                            <td><span class="btn btn-sm btn-danger"><small>Deaktif</small></span></td>

                                        @endif

                                        <td>

                                            {{printUpperSubtree(\App\Models\Zone::where(['work_space_id' => $workspace_detail->id])->get()->toArray(),$device->zone_id)}}

                                        </td>


                                        <td>{{\App\Models\DeviceLog::where('serial_no',$device->serial_no)->count()>0?\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->temp .'°C':'Değer Yok'}}

                                        </td>
                                        <td>{{\App\Models\DeviceLog::where('serial_no',$device->serial_no)->count()>0?\App\Models\DeviceLog::where('serial_no',$device->serial_no)->latest('id')->first()->humd .'%' :'Değer Yok'}}


                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="d-flex col">
                                                    <a href="{{ route('devices.edit', ['id'=>$device->serial_no,'workspace'=>$workspace_detail->id]) }}"
                                                       class="btn btn-sm btn-secondary">Ayarlar</a>
                                                </div>
                                                <div class="col">
                                                    <a href="{{ route('report', ['serial'=>$device->serial_no,'workspace'=>$workspace_detail->id]) }}"
                                                       class="btn btn-xs btn-secondary">Cihaz Raporları</a>
                                                </div>
                                                <div class="d-flex col">
                                                    <button class="btn btn-xs btn-danger">Sil</button>
                                                </div>
                                            </div>


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

    <!-- Modal -->
    <div class="modal fade" id="workspaceStaticBackdrop7" data-bs-backdrop="static" data-bs-keyboard="false"
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
@endsection
