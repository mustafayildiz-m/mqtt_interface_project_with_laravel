@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')

    <?php

    $userRole = \App\Models\AllowedUserAndWorkspaces::where(['allowed_user_id' => auth()->user()->id, 'allowed_workspace_id' => $workspace_detail->id])->first();

    ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a>
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
                        <button
                            class="@if(session('tab')==='device_info')nav-link active @else nav-link @endif"
                            id="device-info" data-bs-toggle="tab"
                            data-bs-target="#device-info-tab-pane" type="button" role="tab"
                            aria-controls="device-info-tab-pane" aria-selected="true">Cihaz
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="@if(session('tab')==='general')nav-link active @else nav-link @endif"
                                id="general-settings"
                                data-bs-toggle="tab"
                                data-bs-target="#general-settings-tab-pane" type="button" role="tab"
                                aria-controls="general-settings-tab-pane" aria-selected="false">
                            Genel
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="@if(session('tab')==='network')nav-link active @else nav-link @endif"
                            id="network-settings" data-bs-toggle="tab"
                            data-bs-target="#network-settings-tab-pane" type="button" role="tab"
                            aria-controls="network-settings-tab-pane" aria-selected="false">
                            Bağlantı
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="@if(session('tab')==='trashold')nav-link active @else nav-link @endif"
                            id="threshold" data-bs-toggle="tab"
                            data-bs-target="#threshold-tab-pane" type="button" role="tab"
                            aria-controls="threshold-tab-pane" aria-selected="false">Sıcaklık ve Nem
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="@if(session('tab')==='notifications')nav-link active @else nav-link @endif"
                            id="notifications" data-bs-toggle="tab"
                            data-bs-target="#notification-tab-pane" type="button" role="tab"
                            aria-controls="notification-tab-pane" aria-selected="false">Bildirim
                        </button>
                    </li>
                    <li
                        class="nav-item"
                        role="presentation">
                        <button
                            class="@if(session('tab')==='permissions')nav-link active @else nav-link @endif"
                            id="permissions" data-bs-toggle="tab"
                            data-bs-target="#permission-tab-pane" type="button" role="tab"
                            aria-controls="permission-tab-pane" aria-selected="false">İzinler
                        </button>
                    </li>
                    <li
                        class="nav-item"
                        role="presentation">
                        <button
                            class="@if(session('tab')==='ownership')nav-link active @else nav-link @endif"

                            id="ownership" data-bs-toggle="tab"
                            data-bs-target="#ownership-tab-pane" type="button" role="tab"
                            aria-controls="ownership-tab-pane" aria-selected="false">Sahiplik
                        </button>
                    </li>
                </ul>


                <div class="tab-content" id="myTabContent">
                    <div class="@if(session('tab')==='device_info')tab-pane fade show active @else tab-pane fade @endif"
                         id="device-info-tab-pane" role="tabpanel"
                         aria-labelledby="home-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->mqtt_url) ? $device_info->mqtt_url :'' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Mqtt url</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               value="<?= isset($device_info->mqtt_port)? $device_info->mqtt_port :'' ?>"
                                               disabled/>
                                        <label for="exampleInputEmail1">Mqtt port</label>
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
                                               value="<?= isset($device_info->hardware_version) ? $device_info->hardware_version : '' ?>"
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

                    <div
                        class="@if(session('tab')==='general')tab-pane fade show active @else tab-pane fade @endif"
                        id="general-settings-tab-pane" role="tabpanel"
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

                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select"
                                                        @if($userRole->user_role !== 'owner') disabled
                                                        @endif name="zone_id"
                                                        aria-label="Default select example">
                                                    <option selected disabled>Bölge seçiniz...</option>

                                                    {{printTree($zones,$device->zone_id)}}
                                                </select>
                                                @if($userRole->user_role === 'owner')

                                                    <small style="float: right" id="emailHelp"
                                                           class="form-text text-muted"><span>Bölge eklemek için
                                                        <a href="javascript:void(0)"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#workspaceStaticBackdrop8"><b>tıklayınız</b></a></span></small>
                                                    <label for="parent_id" class="form-label">Bağlı olduğu bölge</label>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">

                                            <input class="form-control form-control-sm"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   name="hostname"
                                                   value="@if(isset($device_conn_info->hostname)){{$device_conn_info->hostname}} @endif "
                                                   type="text"
                                                   placeholder="30%"/>
                                            <label for="exampleInputEmail1">Hostname</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select"
                                                        @if($userRole->user_role !== 'owner') disabled
                                                        @endif required name="notice_period"
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
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($device->device_name) ? $device->device_name:'' ?>"
                                                   type="text"
                                                   placeholder="30%"/>
                                            <label for="exampleInputEmail1">Cihaz adı</label>
                                        </div>
                                    </div>

                                    @if($userRole->user_role === 'owner')
                                        <div class="form-floating mb-3">
                                            <input class="btn btn-success float-md-end" type="submit" value="Güncelle">
                                        </div>
                                    @endif

                                    <hr/>

                                </div>
                            </form>

                        </div>
                    </div>
                    <div
                        class="@if(session('tab')==='network')tab-pane fade show active @else tab-pane fade @endif"
                        id="network-settings-tab-pane" role="tabpanel"
                        aria-labelledby="network-settings-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <h5>Varsayılan Bağlantı Türü</h5>
                                    </div>
                                    <div class="d-flex justify-content-around my-3">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif type="radio" name="connection_type"
                                                   value="ethernet"
                                                   id="flexRadioDefault1"
                                                   @if($device_conn_info->connection_type==0)checked @endif />
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                <strong>Ethernet</strong>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif type="radio" name="connection_type"
                                                   value="wireless"
                                                   id="flexRadioDefault2"
                                                   @if($device_conn_info->connection_type==1)checked @endif/>

                                            <label class="form-check-label" for="flexRadioDefault2">
                                                <strong>Wi-Fi</strong>
                                            </label>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-12 col-md-6"></div>

                                <div class="col-12 col-md-6 shadow-sm mb-3">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button @if($userRole->user_role !== 'owner') disabled
                                                        @endif class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Wi-Fi Bağlantı Ayarları
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                 aria-labelledby="flush-headingOne"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control form-control-sm" type="text"
                                                               id="ssid"
                                                               name="ssid"
                                                               value="@if(isset($device_conn_info_w_sta->ssid)) {{$device_conn_info_w_sta->ssid}} @endif"
                                                               placeholder="SupercodeStaff"/>
                                                        <label for="exampleInputEmail1">SSID</label>
                                                        <div class="form-floating mb-3">
                                                            <input class="form-control form-control-sm"
                                                                   id="password"
                                                                   name="password"
                                                                   value="@if(isset($device_conn_info_w_sta->password)) {{$device_conn_info_w_sta->password}} @endif"
                                                                   type="password"/>
                                                            <label for="exampleInputEmail1">Password</label>
                                                            <span class="password-toggle"
                                                                  onclick="togglePasswordVisibility()">
                                                         <i class="fa fa-eye" id="password-icon"></i>
                                                                                     </span>

                                                        </div>
                                                        <div class="input-group mb-3" hidden>
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select" id="encry" name="parent_id"
                                                                        aria-label="Default select example">
                                                                    <option>Encryption...</option>
                                                                    @foreach($conn_encrpte as $enc)
                                                                        <option
                                                                            @if($device_conn_info->encryption == $enc) selected @endif>{{$enc}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="parent_id" class="form-label">Bildirim
                                                                    süresi</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <input class="form-check-input"
                                                       @if($userRole->user_role !== 'owner') disabled
                                                       @endif type="radio" name="ethernet_ip_set"
                                                       value="false"
                                                       @if($device_conn_info->connection_type==1) disabled @endif
                                                       @if($device_conn_info->ip_set === false && $device_conn_info->connection_type==0)checked @endif />
                                                <label class="form-check-label" for="ethernet_ip_set">
                                                    <strong>Dynamic</strong>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ethernet_ip_set"
                                                       @if($userRole->user_role !== 'owner') disabled
                                                       @endif
                                                       value="true"
                                                       @if($device_conn_info->connection_type==1) disabled @endif
                                                       @if($device_conn_info->ip_set ===true && $device_conn_info->connection_type==0)checked @endif
                                                />
                                                <label class="form-check-label" for="ethernet_ip_set">
                                                    <strong>Static </strong>
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
                                                <input class="form-check-input" type="radio" name="wifi_ip_set"
                                                       @if($userRole->user_role !== 'owner') disabled
                                                       @endif
                                                       value="false"
                                                       @if($device_conn_info->connection_type==0) disabled @endif
                                                       @if(isset($device_conn_info_w_sta)&&$device_conn_info_w_sta->ip_set === false )checked @endif />
                                                <label class="form-check-label" for="wifi_ip_set">
                                                    <strong>Dynamic</strong>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="wifi_ip_set"
                                                       @if($userRole->user_role !== 'owner') disabled
                                                       @endif
                                                       value="true"
                                                       @if($device_conn_info->connection_type==0) disabled @endif
                                                       @if(isset($device_conn_info_w_sta)&&$device_conn_info_w_sta->ip_set ===true )checked @endif
                                                />
                                                <label class="form-check-label" for="wifi_ip_set">
                                                    <strong>Static</strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 @if($device_conn_info->ip_set == true) d-none @endif"
                                     id="ethernet_man_field_dynamic">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="192.168.1.100"
                                               value="@if(isset($ethernetDynamic->ip)){{$ethernetDynamic->ip}} @endif"
                                               disabled

                                        />
                                        <label for="exampleInputEmail1">IP</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="255.0.0.0"
                                               value="@if(isset($ethernetDynamic->submask)){{$ethernetDynamic->submask}} @endif"
                                               disabled/>
                                        <label for="exampleInputEmail1">Submask</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="192.168.1.1"
                                               value="@if(isset($ethernetDynamic->gateway)){{$ethernetDynamic->gateway}} @endif"
                                               disabled/>
                                        <label for="exampleInputEmail1">Gateway</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="8.8.8.8"
                                               value="@if(isset($ethernetDynamic->dns)){{$ethernetDynamic->dns}} @endif"
                                               disabled/>
                                        <label for="exampleInputEmail1">DNS</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 @if($device_conn_info->ip_set == false) d-none @endif"
                                     id="ethernet_man_field_static">
                                    <div class="form-floating mb-3">
                                        <input
                                            id="e-ip"
                                            class="form-control form-control-sm" type="text"
                                            placeholder="192.168.1.100"
                                            value="@if(isset($device_conn_info_e_sta->ip)){{$device_conn_info_e_sta->ip}} @endif"


                                        />
                                        <label for="exampleInputEmail1">IP</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            id="e-submask"
                                            class="form-control form-control-sm" type="text"
                                            placeholder="255.0.0.0"
                                            value="@if(isset($device_conn_info_e_sta->submask)){{$device_conn_info_e_sta->submask}} @endif"
                                        />
                                        <label for="exampleInputEmail1">Submask</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            id="e-gateway"
                                            class="form-control form-control-sm" type="text"
                                            placeholder="192.168.1.1"
                                            value="@if(isset($device_conn_info_e_sta->gateway)){{$device_conn_info_e_sta->gateway}} @endif"
                                        />
                                        <label for="exampleInputEmail1">Gateway</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            id="e-dns"
                                            class="form-control form-control-sm" type="text"
                                            placeholder="8.8.8.8"
                                            value="@if(isset($device_conn_info_e_sta->dns)){{$device_conn_info_e_sta->dns}} @endif"
                                        />
                                        <label for="exampleInputEmail1">DNS</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 @if($device_conn_info->ip_set == true) d-none @endif"
                                     id="wifi_man_field_dynamic">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="192.168.1.100"
                                               value="@if(isset($wifiDynamic->ip)){{$wifiDynamic->ip}} @endif"
                                               disabled

                                        />
                                        <label for="exampleInputEmail1">IP</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="255.0.0.0"
                                               value="@if(isset($wifiDynamic->submask)){{$wifiDynamic->submask}} @endif"
                                               disabled/>
                                        <label for="exampleInputEmail1">Submask</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="192.168.1.1"
                                               value="@if(isset($wifiDynamic->gateway)){{$wifiDynamic->gateway}} @endif"
                                               disabled/>
                                        <label for="exampleInputEmail1">Gateway</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text"
                                               placeholder="8.8.8.8"
                                               value="@if(isset($wifiDynamic->dns)){{$wifiDynamic->dns}} @endif"
                                               disabled/>
                                        <label for="exampleInputEmail1">DNS</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 @if($device_conn_info->ip_set == false) d-none @endif"
                                     id="wifi_man_field_static">
                                    <div class="form-floating mb-3">
                                        <input
                                            id="w-ip"
                                            class="form-control form-control-sm" type="text"
                                            placeholder="192.168.1.100"
                                            value="@if(isset($device_conn_info_w_sta->ip)){{$device_conn_info_w_sta->ip}} @endif"
                                        />
                                        <label for="exampleInputEmail1">IP</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            id="w-submask"
                                            class="form-control form-control-sm" type="text"
                                            placeholder="255.0.0.0"
                                            value="@if(isset($device_conn_info_w_sta->submask)){{$device_conn_info_w_sta->submask}} @endif"

                                        />
                                        <label for="exampleInputEmail1">Submask</label>
                                    </div>
                                    <div

                                        class="form-floating mb-3">
                                        <input id="w-gateway" class="form-control form-control-sm" type="text"
                                               placeholder="192.168.1.1"
                                               value="@if(isset($device_conn_info_w_sta->gateway)){{$device_conn_info_w_sta->gateway}} @endif"
                                        />
                                        <label for="exampleInputEmail1">Gateway</label>
                                    </div>

                                    <input type="hidden" id="device_serial_no" value="{{$device->serial_no}}">
                                    <input type="hidden" id="device_workspace_id" value="{{$workspace_detail->id}}">
                                    <div
                                        class="form-floating mb-3">
                                        <input
                                            id="w-dns"
                                            class="form-control form-control-sm" type="text"
                                            placeholder="8.8.8.8"
                                            value="@if(isset($device_conn_info->dns) && $device_conn_info->connection_type==1){{$device_conn_info->dns}} @endif"
                                        />
                                        <label for="exampleInputEmail1">DNS</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input id="port" class="form-control form-control-sm" type="text"
                                               @if($userRole->user_role !== 'owner') disabled
                                               @endif
                                               placeholder="8806"
                                               value="@if(isset($device_conn_info->port)){{$device_conn_info->port}} @endif"

                                        />
                                        <label for="exampleInputEmail1">Port</label>
                                    </div>
                                    {{--                                    <div class="form-floating mb-3">--}}
                                    {{--                                        <input--}}
                                    {{--                                            id="hostname"--}}
                                    {{--                                            class="form-control form-control-sm" type="text"--}}
                                    {{--                                            placeholder="30%"--}}
                                    {{--                                            name="hostname"--}}
                                    {{--                                            value="@if(isset($device_conn_info->hostname)){{$device_conn_info->hostname}} @endif "--}}
                                    {{--                                        />--}}
                                    {{--                                        <label for="exampleInputEmail1">Hostname</label>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            @if($userRole->user_role === 'owner')
                                <div class="form-floating mb-3">
                                    <input class="btn btn-success float-md-end" id="update-button" type="button"
                                           value="Güncelle">
                                </div>
                            @endif

                        </div>
                    </div>

                    <div
                        class="@if(session('tab')==='trashold')tab-pane fade show active @else tab-pane fade @endif"
                        id="threshold-tab-pane" role="tabpanel" aria-labelledby="threshold-tab"
                        tabindex="0">
                        <div class="card card-body">
                            <form id="trasholdForm"
                                  action='/{{$workspace_detail->id}}/devices/{{$device->serial_no}}/edit-trashhold'
                                  method="post">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($trashhold->temp_min) ? $trashhold->temp_min : '' ?>"
                                                   name="temp_min" type="number"/>
                                            <label for="temp_min">Isı alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="number"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($trashhold->moisture_min) ? $trashhold->moisture_min :'' ?>"
                                                   name="moisture_min"
                                            />
                                            <label for="moisture_min">Nem alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="number"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($trashhold->temp_max)? $trashhold->temp_max:'' ?>"
                                                   name="temp_max"/>
                                            <label for="temp_max">Isı üst limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
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
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($trashhold->crit_temp_min)? $trashhold->crit_temp_min:'' ?>"
                                                   name="crit_temp_min"
                                                   type="number"/>
                                            <label for="crit_temp_min">Isı kritik alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm" type="number"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($trashhold->crit_moisture_min)?$trashhold->crit_moisture_min:'' ?>"
                                                   name="crit_moisture_min"
                                            />
                                            <label for="crit_moisture_min">Nem kritik alt limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($trashhold->crit_temp_max)?$trashhold->crit_temp_max:'' ?>"
                                                   name="crit_temp_max"
                                                   type="number"/>
                                            <label for="crit_temp_max">Isı kritik üst limit</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control form-control-sm"
                                                   @if($userRole->user_role !== 'owner') disabled
                                                   @endif
                                                   value="<?= isset($trashhold->crit_moisture_max)?$trashhold->crit_moisture_max:'' ?>"
                                                   name="crit_moisture_max"
                                                   type="number"
                                            />
                                            <label for="crit_moisture_max">Nem kritik üst limit</label>
                                        </div>
                                    </div>

                                    @if($userRole->user_role === 'owner')
                                        <div class="form-floating mb-3">
                                            <input class="btn btn-success float-md-end" type="button"
                                                   onclick="showConfirmation()" value="Güncelle">
                                        </div>
                                    @endif

                                </div>
                            </form>
                        </div>
                    </div>
                    <div
                        class="@if(session('tab')==='notifications')tab-pane fade show active @else tab-pane fade @endif"
                        id="notification-tab-pane" role="tabpanel"
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
                    <div
                        class="@if(session('tab')==='permissions')tab-pane fade show active @else tab-pane fade @endif"
                        id="permission-tab-pane"
                        role="tabpanel"
                        aria-labelledby="permission-tab"
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
                    <div
                        class="@if(session('tab')==='ownership')tab-pane fade show active @else tab-pane fade @endif"
                        id="ownership-tab-pane"
                        role="tabpanel"
                        aria-labelledby="ownership-tab"
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

    <div id="loader">
        <div class="spinner"></div>
        <span>Lütfen Bekleyiniz...</span>
    </div>

    <div class="modal fade" id="workspaceStaticBackdrop8" data-bs-backdrop="static" data-bs-keyboard="false"
         aria-labelledby="workspaceStaticBackdropdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="workspaceStaticBackdropdropLabel">Bölge Oluştur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        @isset($zones)
                            <div class="">
                                <form action="/zones/{{$workspace_detail->id}}/created-in-device" method="POST"
                                      class="forms-sample">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="parent_id" name="parent_id"
                                                aria-label="Default select example">
                                            <option value="0" selected>Bölge seçiniz...</option>

                                            {{printTree($zones,$device->zone_id)}}

                                        </select>
                                        @method('post')

                                        @csrf
                                        <label for="parent_id" class="form-label">Bağlı olduğu bölge</label>
                                    </div>
                                    <input type="hidden" name="workspace_id" value="{{$workspace_detail->id}}">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="zone_name" name="name"
                                               placeholder="Ofis">
                                        <label for="name" class="form-label">İsim</label>
                                    </div>
                                    <div class="mb-3">
                                        <input class="btn btn-primary" disabled type="submit" id="create-zone-button"
                                               value="Oluştur">
                                    </div>
                                </form>
                            </div>
                        @endisset
                    </div>
                </div>

            </div>
        </div>
    </div>



    <style>
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            display: none;
        }

        .spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        #loader span {
            font-size: 18px;
            margin-top: 10px;
            display: block;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .fa-eye,
        .fa-eye-slash {
            font-size: 20px;
        }
    </style>

@endsection
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>


@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endpush



@push('custom-scripts')

    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>


        $(function () {

            $('#device-info').on('click', function () {
                setSessionData('device_info')
            })
            $('#general-settings').on('click', function () {
                setSessionData('general')
            })
            $('#network-settings').on('click', function () {
                setSessionData('network')
            })
            $('#threshold').on('click', function () {
                setSessionData('trashold')
            })
            $('#notifications').on('click', function () {
                setSessionData('notifications')

            })
            $('#permissions').on('click', function () {
                setSessionData('permissions')
            })
            $('#ownership').on('click', function () {
                setSessionData('ownership')
            })

            function setSessionData(statu) {
                $.ajax({
                    url: '{{ route('ajax.session') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: {
                        key: 'tab',
                        value: statu
                    },
                    success: function (response) {

                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            $('#parent_id').on('change', function () {
                if ($('#zone_name').val().length > 0) {
                    $('#create-zone-button').removeAttr('disabled')
                }
            })
            $('#zone_name').on('keyup', function () {
                if ($(this).val().length > 0) {
                    $('#create-zone-button').removeAttr('disabled')
                } else if ($(this).val().length === 0) {
                    $('#create-zone-button').attr('disabled', 'disabled')
                }
            });
            $('input[type=radio][name=wifi_ip_set]').change(function () {
                switch ($(this).val()) {
                    case 'true':
                        $('#wifi_man_field_dynamic').addClass('d-none')
                        $('#wifi_man_field_static').removeClass('d-none')
                        break
                    case 'false':
                        $('#wifi_man_field_static').addClass('d-none')
                        $('#wifi_man_field_dynamic').removeClass('d-none')
                        break

                }
            });
            $('input[type=radio][name=ethernet_ip_set]').change(function () {
                console.log($(this).val())
                switch ($(this).val()) {
                    case 'true':
                        $('#ethernet_man_field_dynamic').addClass('d-none')
                        $('#ethernet_man_field_static').removeClass('d-none')
                        break
                    case 'false':
                        $('#ethernet_man_field_static').addClass('d-none')
                        $('#ethernet_man_field_dynamic').removeClass('d-none')
                        break

                }
            });
            $('input[type=radio][name=connection_type]').change(function () {
                console.log($(this).val())
                switch ($(this).val()) {
                    case 'wireless':
                        $('input[type=radio][name=wifi_ip_set]').attr('disabled', false)
                        $('input[type=radio][name=ethernet_ip_set]').attr('disabled', true)
                        break
                    case 'ethernet':
                        $('input[type=radio][name=wifi_ip_set]').attr('disabled', true)
                        $('input[type=radio][name=ethernet_ip_set]').attr('disabled', false)
                        break

                }
            });

            $('#update-button').on('click', function (e) {
                Swal.fire({
                    title: 'Cihaz yeniden başlatılacak. Emin misiniz?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'İptal',
                    confirmButtonText: 'Evet'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // $(this).prop("disabled", true);
                        var loader = $("#loader");
                        loader.show(); // Loader'ı görünür hale getir

                        let connection_type = $('input[type=radio][name=connection_type]:checked').val()
                        let port = $('#port').val().trim();
                        let serial_no = $('#device_serial_no').val().trim();
                        let device_workspace_id = $('#device_workspace_id').val();
                        let hostname = $('#hostname').val();
                        switch (connection_type) {
                            case 'wireless':
                                //wifi_ip_set
                                let ip_set = $('input[type=radio][name=wifi_ip_set]:checked').val();
                                //statik
                                let encry = $('#encry').val().trim();
                                let ssid = $('#ssid').val().trim();
                                let password = $('#password').val().trim();
                                let ip = $('#w-ip').val().trim();
                                let submask = $('#w-submask').val().trim();
                                let gateway = $('#w-gateway').val().trim();
                                let dns = $('#w-dns').val().trim();

                                let data = {
                                    encry,
                                    ssid,
                                    password,
                                    ip,
                                    submask,
                                    gateway,
                                    dns,
                                    port,
                                    hostname,
                                    serial_no,
                                    device_workspace_id,
                                    ip_set

                                }

                                $.ajax({
                                    url: '{{ route('ajax.wifi') }}',
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                                    },
                                    data,
                                    success: function (response) {
                                        loader.hide(); // Loader'ı gizle
                                        // $("#update-button").prop("disabled", false);

                                        console.log(response);
                                        if (response.success) {
                                            Swal.fire(
                                                "Başarılı!",
                                                'Güncelleme Başarılı!',
                                                'success'
                                            )
                                        } else if (!response.success) {
                                            console.log(response);

                                            Swal.fire(
                                                "Cihazın fişe takılı olduğundan emin olun.",
                                                'Güncelleme Başarısız!',
                                                'error'
                                            )
                                        } else {
                                            console.log(response);

                                            Swal.fire(
                                                "Cihazın fişe takılı olduğundan emin olun.",
                                                'Güncelleme Başarısız!',
                                                'error'
                                            )

                                        }
                                    },
                                    error: function (xhr) {
                                        $("#update-button").prop("disabled", false);

                                        loader.hide(); // Loader'ı gizle

                                        console.log(xhr.responseText);
                                    }
                                });


                                break;
                            case 'ethernet':
                                let ethernet_ip_set = $('input[type=radio][name=ethernet_ip_set]:checked').val();
                                let e_ip = $('#e-ip').val().trim();
                                let e_submask = $('#e-submask').val().trim();
                                let e_gateway = $('#e-gateway').val().trim();
                                let e_dns = $('#e-dns').val().trim();
                                let e_data = {
                                    ip: e_ip,
                                    submask: e_submask,
                                    gateway: e_gateway,
                                    dns: e_dns,
                                    port,
                                    hostname,
                                    serial_no,
                                    device_workspace_id,
                                    ip_set: ethernet_ip_set
                                }
                                $.ajax({
                                    url: '{{ route('ajax.ethernet') }}',
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                                    },
                                    data: e_data,
                                    success: function (response) {
                                        loader.hide(); // Loader'ı gizle

                                        console.log(response);
                                        if (response.success) {
                                            Swal.fire(
                                                "Başarılı!",
                                                'Güncelleme Başarılı!',
                                                'success'
                                            )
                                        } else if (!response.success) {
                                            console.log(response);

                                            Swal.fire(
                                                "Cihazın fişe takılı olduğundan emin olun.",
                                                'Güncelleme Başarısız!',
                                                'error'
                                            )
                                        } else {
                                            console.log(response);

                                            Swal.fire(
                                                "Cihazın fişe takılı olduğundan emin olun.",
                                                'Güncelleme Başarısız!',
                                                'error'
                                            )

                                        }
                                    },
                                    error: function (xhr) {
                                        $("#update-button").prop("disabled", false);

                                        loader.hide(); // Loader'ı gizle

                                        console.log(xhr.responseText);
                                    }
                                });

                                break;
                        }
                    }
                })


            })


        });


        var loadFile = function (event) {
            var output = document.getElementById('profilePic');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };


        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var passwordIcon = document.getElementById('password-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        function showConfirmation() {
            Swal.fire({
                title: 'Cihazın sıcaklık ve nem ayarları güncellenecek. Emin misiniz?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Onaylandıysa formu post et
                    document.getElementById("trasholdForm").submit();
                }
            });
        }
    </script>

@endpush
