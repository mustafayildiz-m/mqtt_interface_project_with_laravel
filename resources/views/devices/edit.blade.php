@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'supercode']) }}">Supercode</a>
            </li>
            <li class="breadcrumb-item"><a
                    href="{{ route('devices',['workspace' => $workspace_detail->id]) }}">Cihazlar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cihaz Düzenle</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="device-info" data-bs-toggle="tab"
                                data-bs-target="#device-info-tab-pane" type="button" role="tab"
                                aria-controls="device-info-tab-pane" aria-selected="true">Cihaz
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="general-settings" data-bs-toggle="tab"
                                data-bs-target="#general-settings-tab-pane" type="button" role="tab"
                                aria-controls="general-settings-tab-pane" aria-selected="false">
                            Genel
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="network-settings" data-bs-toggle="tab"
                                data-bs-target="#network-settings-tab-pane" type="button" role="tab"
                                aria-controls="network-settings-tab-pane" aria-selected="false">
                            Bağlantı
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="threshold" data-bs-toggle="tab"
                                data-bs-target="#threshold-tab-pane" type="button" role="tab"
                                aria-controls="threshold-tab-pane" aria-selected="false">Sıcaklık ve Nem
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="notifications" data-bs-toggle="tab"
                                data-bs-target="#notification-tab-pane" type="button" role="tab"
                                aria-controls="notification-tab-pane" aria-selected="false">Bildirim
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permissions" data-bs-toggle="tab"
                                data-bs-target="#permission-tab-pane" type="button" role="tab"
                                aria-controls="permission-tab-pane" aria-selected="false">İzinler
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ownership" data-bs-toggle="tab"
                                data-bs-target="#ownership-tab-pane" type="button" role="tab"
                                aria-controls="ownership-tab-pane" aria-selected="false">Sahiplik
                        </button>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="device-info-tab-pane" role="tabpanel"
                         aria-labelledby="home-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->hostname) ? $device_info->hostname :'' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Cihaz kayıt adresi</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->product_brand)? $device_info->product_brand :'' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Marka</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->product_brand)? $device_info->wifi_mac :'' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Wifi mac adresi</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->product_brand)? $device_info->ethernet_mac :'' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Ethernet mac adresi</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->hardware_version) ? $device_info->wifi_mac : '' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Hardware version</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->product_brand)? $device_info->firmware_version :'' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Firmware version</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="{{$device->serial_no}}"
                                               disabled/>
                                        <label for="exampleInputEmail1">Seri no</label>
                                    </div>
                                </div>
                                {{--                                <div class="col-12 col-md-6">--}}
                                {{--                                    <div class="form-floating mb-3">--}}
                                {{--                                        <input class="form-control form-control-sm" type="text"--}}
                                {{--                                               value="{{$device->master_key}}"--}}
                                {{--                                               disabled/>--}}
                                {{--                                        <label for="exampleInputEmail1">Master key</label>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="general-settings-tab-pane" role="tabpanel"
                         aria-labelledby="general-settings-tab" tabindex="0">
                        <div class="card card-body">
                            <form
                                action="/{{$workspace_detail->id}}/devices/{{$device->serial_no}}/edit-device/"
                                method="post"
                                enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @method('post')

                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="profile-pic-wrapper">
                                                <div class="pic-holder">


                                                    <img id="profilePic" class="pic"
                                                         src="{{asset($device->device_img)}}">
                                                    <Input class="uploadProfileInput" type="file"
                                                           onchange="loadFile(event)" name="image"
                                                           id="newProfilePhoto" accept="image/*" style="opacity: 0;"/>

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
                                    </div>
                                    <hr>

                                    @if($zones->count()>0)
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="zone_id"
                                                            aria-label="Default select example">
                                                        <option>Bölge seçiniz...</option>
                                                        @foreach($zones->get() as $zone)
                                                            <option value="{{$zone->id}}"
                                                                    @if($device->zone_id == $zone->id) selected @endif>{{$zone->name}}</option>

                                                        @endforeach

                                                    </select>
                                                    <label for="parent_id" class="form-label">Bağlı olduğu bölge</label>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                    <span>Bölge eklemek için <a
                                                            href="{{ route('zones.create',['workspace' => $workspace_detail->id]) }}"><b>tıklayınız</b></a></span>


                                            </div>
                                        </div>

                                    @endif

                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" required name="notice_period"
                                                        aria-label="Default select example">
                                                    <option>Bildirim süresi seçiniz...</option>
                                                    @foreach($periot as $key => $per)
                                                        <option value="{{$per}}"
                                                                @if($device->notice_period == $per) selected @endif>{{$key}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="parent_id" class="form-label">Bildirim süresi</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   name="device_name"
                                                   value="<?= isset($device->device_name) ? $device->device_name:'' ?>"
                                                   type="text"
                                                   placeholder="30%"/>
                                            <label for="exampleInputEmail1">Cihaz adı</label>
                                        </div>
                                    </div>

                                    <input type="submit" class="btn btn-success" value="Güncelle">
                                    <hr/>

                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="network-settings-tab-pane" role="tabpanel"
                         aria-labelledby="network-settings-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <h5>Varsayılan Bağlantı Türü</h5>
                                    </div>
                                    <div class="d-flex justify-content-around my-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="connection_type"
                                                   id="flexRadioDefault1"
                                                   @if($device->connection_type==='ethernet')checked @endif />
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                <strong>Ethernet</strong>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="connection_type"
                                                   id="flexRadioDefault2"
                                                   @if($device->connection_type==='wifi')checked @endif/>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                <strong>Wireless</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6"></div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="SupercodeStaff"/>
                                        <label for="exampleInputEmail1">SSID</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6"></div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="12345678"/>
                                        <label for="exampleInputEmail1">Password</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6"></div>
                                <div class="col-12 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="parent_id"
                                                    aria-label="Default select example">
                                                <option>Encryption...</option>
                                                <option value="1">WEP</option>
                                                <option value="1">WPA</option>
                                                <option value="1" selected>WPA2</option>
                                                <option value="1">WPA3</option>
                                            </select>
                                            <label for="parent_id" class="form-label">Bildirim süresi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex justify-content-center">
                                        IP
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-around my-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ethernet_statu"
                                                       value="oto"
                                                       checked/>
                                                <label class="form-check-label" for="ethernet_statu">
                                                    <strong>Otomatik</strong>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ethernet_statu"
                                                       value="manuel"
                                                />
                                                <label class="form-check-label" for="ethernet_statu">
                                                    <strong>Manuel</strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex justify-content-center">
                                        IP
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-around my-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="wifi_statu"
                                                       value="oto"
                                                       checked/>
                                                <label class="form-check-label" for="wifi_statu">
                                                    <strong>Otomatik</strong>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="wifi_statu"
                                                       value="manuel"
                                                />
                                                <label class="form-check-label" for="wifi_statu">
                                                    <strong>Manuel</strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <form action="">
                                        <div id="ethernet_man_field">
                                            <div class="form-floating mb-3">
                                                <input class="form-control form-control-sm" type="text"
                                                       placeholder="192.168.1.100"
                                                />
                                                <label for="exampleInputEmail1">IP</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control form-control-sm" type="text"
                                                       placeholder="255.0.0.0"/>
                                                <label for="exampleInputEmail1">Submask</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control form-control-sm" type="text"
                                                       placeholder="192.168.1.1"/>
                                                <label for="exampleInputEmail1">Gateway</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control form-control-sm" type="text"
                                                       placeholder="8.8.8.8"/>
                                                <label for="exampleInputEmail1">DNS</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control form-control-sm" type="text"
                                                       placeholder="8806"/>
                                                <label for="exampleInputEmail1">Port</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control form-control-sm" type="text"
                                                       placeholder="30%"
                                                       name="hostname" value="
                                                    @if(isset($device_info->connection_type))

                                                   @if($device_info->connection_type ==='ethernet') {{$device_info->hostname}} @endif"

                                                    @endif
                                                />
                                                <label for="exampleInputEmail1">Hostname</label>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-12 col-md-6">
                                    <div id="wifi_man_field">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="text"
                                                   placeholder="192.168.1.100"/>
                                            <label for="exampleInputEmail1">IP</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="text"
                                                   placeholder="255.0.0.0"/>
                                            <label for="exampleInputEmail1">Submask</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="text"
                                                   placeholder="192.168.1.1"/>
                                            <label for="exampleInputEmail1">Gateway</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="text"
                                                   placeholder="8.8.8.8"/>
                                            <label for="exampleInputEmail1">DNS</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="text" placeholder="8806"/>
                                            <label for="exampleInputEmail1">Port</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="text"
                                                   placeholder="30%"
                                                   name="hostname"
                                                   value="
                                                   @if(isset($device_info->connection_type))
@if($device_info->connection_type ==='wifi') {{$device_info->hostname}} @endif

                                                   @endif
                                                   "
                                            />
                                            <label for="exampleInputEmail1">Hostname</label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="threshold-tab-pane" role="tabpanel" aria-labelledby="threshold-tab"
                         tabindex="0">
                        <div class="card card-body">
                            <form action='/{{$workspace_detail->id}}/devices/{{$device->serial_no}}/edit-trashhold'
                                  method="post">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   value="<?= isset($trashhold->temp_min) ? $trashhold->temp_min : '' ?>"
                                                   name="temp_min" type="number"/>
                                            <label for="temp_min">Isı alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="number"
                                                   value="<?= isset($trashhold->moisture_min) ? $trashhold->moisture_min :'' ?>"
                                                   name="moisture_min"
                                            />
                                            <label for="moisture_min">Nem alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="number"
                                                   value="<?= isset($trashhold->temp_max)? $trashhold->temp_max:'' ?>"
                                                   name="temp_max"/>
                                            <label for="temp_max">Isı üst limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   value="<?= isset($trashhold->moisture_max)? $trashhold->moisture_max:'' ?>"
                                                   name="moisture_max"
                                                   type="number"
                                            />
                                            <label for="moisture_max">Nem üst limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   value="<?= isset($trashhold->crit_temp_min)? $trashhold->crit_temp_min:'' ?>"
                                                   name="crit_temp_min"
                                                   type="number"/>
                                            <label for="crit_temp_min">Isı kritik alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="number"
                                                   value="<?= isset($trashhold->crit_moisture_min)?$trashhold->crit_moisture_min:'' ?>"
                                                   name="crit_moisture_min"
                                            />
                                            <label for="crit_moisture_min">Nem kritik alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   value="<?= isset($trashhold->crit_temp_max)?$trashhold->crit_temp_max:'' ?>"
                                                   name="crit_temp_max"
                                                   type="number"/>
                                            <label for="crit_temp_max">Isı kritik üst limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   value="<?= isset($trashhold->crit_moisture_max)?$trashhold->crit_moisture_max:'' ?>"
                                                   name="crit_moisture_max"
                                                   type="number"
                                            />
                                            <label for="crit_moisture_max">Nem kritik üst limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="btn btn-success" type="submit" value="Güncelle">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="notification-tab-pane" role="tabpanel"
                         aria-labelledby="notification-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div class="form-floating">
                                                <select class="form-select" name="parent_id"
                                                        aria-label="Default select example">
                                                    <option>Tür seçiniz...</option>
                                                    <option value="1" selected>Sıcaklık</option>
                                                    <option value="2">Nem</option>
                                                </select>
                                                <label for="parent_id" class="form-label">Bildirim süresi</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" placeholder="Alt limit">
                                                <label for="parent_id" class="form-label">Alt limit</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" placeholder="Üst limit">
                                                <label for="parent_id" class="form-label">Üst limit</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="d-flex justify-content-evenly h-100 align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        E-posta
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        SMS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                           id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Arama
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <button class="btn btn-primary">Ekle</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-7"></div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group mt-3">
                                                <div class="input-group mb-3">
                                                    <input class="form-control mb-4 mb-md-0"
                                                           data-inputmask-alias="+\90 999 999 99 99"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <table id="table" class="table" data-pagination="true" data-search="true"
                                                   data-page-number="1" data-multiple-select-row="true"
                                                   data-click-to-select="true" data-buttons="buttons2">
                                                <thead>
                                                <tr>
                                                    <th data-checkbox="true"></th>
                                                    <th>#</th>
                                                    <th>Tür</th>
                                                    <th>Alt Limit</th>
                                                    <th>Üst Limit</th>
                                                    <th>Bildirim Tipi</th>
                                                    <th>Bildirim Adresi</th>
                                                    <th>İşlemler</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>1</td>
                                                    <td>Nem</td>
                                                    <td>25%</td>
                                                    <td>40%</td>
                                                    <td>E-posta</td>
                                                    <td>ozgur.aydin@supercode.com.tr</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">Sil</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>2</td>
                                                    <td>Nem</td>
                                                    <td>25%</td>
                                                    <td>40%</td>
                                                    <td>Arama</td>
                                                    <td>+90 555 555 33 25</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">Sil</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>3</td>
                                                    <td>Nem</td>
                                                    <td>25%</td>
                                                    <td>40%</td>
                                                    <td>SMS</td>
                                                    <td>+90 555 555 33 25</td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">Sil</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="permission-tab-pane" role="tabpanel" aria-labelledby="permission-tab"
                         tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="/devices/invite-email" method="post">
                                        <div class="input-group mb-3">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" value="{{$workspace_detail->id}}" name="workspace_id">
                                            <input type="hidden" value="{{$device->serial_no}}" name="serial_no">
                                            <input type="email" required class="form-control"
                                                   name="email"
                                                   placeholder="E-posta adresi"
                                                   aria-label="E-posta" aria-describedby="button-addon2">
                                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                                Ekle
                                            </button>

                                        </div>
                                    </form>

                                </div>
                                <div class="col-12">
                                    <table id="table" class="table" data-pagination="true" data-search="true"
                                           data-page-number="1" data-multiple-select-row="true"
                                           data-click-to-select="true" data-buttons="buttons2">
                                        <thead>
                                        <tr>
                                            <th data-checkbox="true"></th>
                                            <th data-field="id" data-sortable="true">#</th>
                                            <th data-field="name" data-sortable="true">E-posta</th>
                                            <th data-field="price" data-sortable="true">Adı</th>
                                            <th data-field="price" data-sortable="true">Kayıt Durumu</th>
                                            <th>Görüntüleme</th>
                                            <th>Ayarları Düzenleme</th>
                                            <th>İşlemler</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        @if(isset($allowed_users))
                                            @foreach($allowed_users as $key => $allow)
                                                <tr>
                                                    <td></td>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$allow->allowed_email}}</td>
                                                    <td>{{$allow->user_name}}</td>
                                                    <td>{{$allow->is_register==false ? 'Henüz Kayıt olmadı' : 'Kayıt Oldu'}}</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                   id="flexCheckChecked" checked>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                   id="flexCheckChecked">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm">Sil</button>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        @else
                                            <span>Bu Alanı Henüz Kimseyle Paylaşmadınız</span>
                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ownership-tab-pane" role="tabpanel" aria-labelledby="ownership-tab"
                         tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="border border-danger rounded py-3 my-3">
                                    <p>Cihazın sahibini değiştirdiğinizde cihazın tüm kontrolünü yeni sahibine vermiş
                                        olursunuz. Bu bağlamda cihaz ile ilgili izinler silinir. Cihazın sahibini
                                        değiştirmek için yeni cihaz sahibinin e-posta adresini giriniz. </p>
                                </div>
                                <div class="col-10 offset-1">
                                    <label class="mb-2">Yeni Cihaz Sahibi</label>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="E-posta adresi"
                                               aria-label="E-posta" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                            Değiştir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endpush



@push('custom-scripts')

    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    {{--    <script>--}}

    {{--        $('input[type=radio][name=ethernet_statu]').change(function () {--}}
    {{--            switch ($(this).val()) {--}}
    {{--                case 'manuel':--}}
    {{--                    $('#ethernet_man_field').removeClass('d-none')--}}
    {{--                    break--}}
    {{--                case 'oto':--}}
    {{--                    $('#ethernet_man_field').addClass('d-none')--}}
    {{--                    break--}}

    {{--            }--}}

    {{--        });--}}
    {{--        $('input[type=radio][name=wifi_statu]').change(function () {--}}
    {{--            switch ($(this).val()) {--}}
    {{--                case 'manuel':--}}
    {{--                    $('#wifi_man_field').removeClass('d-none')--}}
    {{--                    break--}}
    {{--                case 'oto':--}}
    {{--                    $('#wifi_man_field').addClass('d-none')--}}
    {{--                    break--}}

    {{--            }--}}

    {{--        });--}}

    {{--    </script>--}}

    <script>



        var loadFile = function (event) {
            var output = document.getElementById('profilePic');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };


    </script>

@endpush
