@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'supercode']) }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('devices',['workspace' => $workspace_detail->id]) }}">Cihazlar</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cihaz Düzenle</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="device-info" data-bs-toggle="tab" data-bs-target="#device-info-tab-pane" type="button" role="tab" aria-controls="device-info-tab-pane" aria-selected="true">Cihaz</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="general-settings" data-bs-toggle="tab" data-bs-target="#general-settings-tab-pane" type="button" role="tab" aria-controls="general-settings-tab-pane" aria-selected="false">
                            Genel
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="network-settings" data-bs-toggle="tab" data-bs-target="#network-settings-tab-pane" type="button" role="tab" aria-controls="network-settings-tab-pane" aria-selected="false">
                            Bağlantı
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="threshold" data-bs-toggle="tab" data-bs-target="#threshold-tab-pane" type="button" role="tab" aria-controls="threshold-tab-pane" aria-selected="false">Sıcaklık ve Nem</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="notifications" data-bs-toggle="tab" data-bs-target="#notification-tab-pane" type="button" role="tab" aria-controls="notification-tab-pane" aria-selected="false">Bildirim</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permissions" data-bs-toggle="tab" data-bs-target="#permission-tab-pane" type="button" role="tab" aria-controls="permission-tab-pane" aria-selected="false">İzinler</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="device-info-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="https://register.superlog.com.tr" disabled />
                                        <label for="exampleInputEmail1">Cihaz kayıt adresi</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="superLOG IoT M1" disabled />
                                        <label for="exampleInputEmail1">Marka</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="00:1b:63:84:45:e6" disabled />
                                        <label for="exampleInputEmail1">Wifi mac adresi</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="00-1B-63-84-45-E6" disabled />
                                        <label for="exampleInputEmail1">Ethernet mac adresi</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="1.0.0" disabled />
                                        <label for="exampleInputEmail1">Hardware version</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="1.0.0" disabled />
                                        <label for="exampleInputEmail1">Firmware version</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="SL-84323HG2" disabled />
                                        <label for="exampleInputEmail1">Seri no</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" value="J32432GFJ1ASQ" disabled />
                                        <label for="exampleInputEmail1">Master key</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="general-settings-tab-pane" role="tabpanel" aria-labelledby="general-settings-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="profile-pic-wrapper">
                                            <div class="pic-holder">
                                                <img id="profilePic" class="pic" src="https://ui-avatars.com/api/?name=Super+Log">
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
                                </div>
                                <hr>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="parent_id" aria-label="Default select example">
                                                <option>Bölge seçiniz...</option>
                                                <option value="1">Teknopark Ankara</option>
                                                <option value="2">&nbsp&nbsp Sunucu Odası 1</option>
                                                <option value="2" selected>&nbsp&nbsp&nbsp&nbsp Giriş</option>
                                                <option value="2">&nbsp&nbsp&nbsp&nbsp Arka</option>
                                                <option value="2">&nbsp&nbsp Sunucu Odası 2</option>
                                                <option value="2">&nbsp&nbsp Sunucu Odası 3</option>
                                                <option value="1">ODTÜ Teknokent</option>
                                                <option value="2">&nbsp&nbsp Sunucu Odası 1</option>
                                                <option value="2">&nbsp&nbsp Sunucu Odası 2</option>
                                                <option value="2">&nbsp&nbsp Sunucu Odası 3</option>
                                            </select>
                                            <label for="parent_id" class="form-label">Bağlı olduğu bölge</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="parent_id" aria-label="Default select example">
                                                <option>Bildirim süresi seçiniz...</option>
                                                <option value="1">1 dakika</option>
                                                <option value="1">3 dakika</option>
                                                <option value="1" selected>5 dakika</option>
                                                <option value="1">10 dakika</option>
                                                <option value="1">15 dakika</option>
                                                <option value="1">20 dakika</option>
                                                <option value="1">30 dakika</option>
                                                <option value="1">60 dakika</option>
                                            </select>
                                            <label for="parent_id" class="form-label">Bildirim süresi</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="30%" />
                                        <label for="exampleInputEmail1">Cihaz adı</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="30%" />
                                        <label for="exampleInputEmail1">Hostname</label>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="network-settings-tab-pane" role="tabpanel" aria-labelledby="network-settings-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <h5>Varsayılan Bağlantı Türü</h5>
                                    </div>
                                    <div class="d-flex justify-content-around my-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                <strong>Ethernet</strong>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked />
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                <strong>Wireless</strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6"></div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="SupercodeStaff" />
                                        <label for="exampleInputEmail1">SSID</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6"></div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="12345678" />
                                        <label for="exampleInputEmail1">Password</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6"></div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="WPA2" />
                                        <label for="exampleInputEmail1">Encryption</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex justify-content-center">
                                        IP
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-around my-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ethernet_ip" id="ethernet_ip" />
                                                <label class="form-check-label" for="ethernet_ip">
                                                    <strong>Otomatik</strong>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ethernet_ip" id="ethernet_ip" checked />
                                                <label class="form-check-label" for="ethernet_ip">
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
                                                <input class="form-check-input" type="radio" name="wireless_ip" id="wireless_ip" />
                                                <label class="form-check-label" for="wireless_ip">
                                                    <strong>Otomatik</strong>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="wireless_ip" id="wireless_ip" checked />
                                                <label class="form-check-label" for="wireless_ip">
                                                    <strong>Manuel</strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="192.168.1.100" />
                                        <label for="exampleInputEmail1">IP</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="192.168.1.100" />
                                        <label for="exampleInputEmail1">IP</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="255.0.0.0" />
                                        <label for="exampleInputEmail1">Submask</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="255.0.0.0" />
                                        <label for="exampleInputEmail1">Submask</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="192.168.1.1" />
                                        <label for="exampleInputEmail1">Gateway</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="192.168.1.1" />
                                        <label for="exampleInputEmail1">Gateway</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="8.8.8.8" />
                                        <label for="exampleInputEmail1">DNS</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="8.8.8.8" />
                                        <label for="exampleInputEmail1">DNS</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="8806" />
                                        <label for="exampleInputEmail1">Port</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="8806" />
                                        <label for="exampleInputEmail1">Port</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="threshold-tab-pane" role="tabpanel" aria-labelledby="threshold-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="number" placeholder="15" />
                                        <label for="exampleInputEmail1">Isı alt limit</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="number" placeholder="15%" />
                                        <label for="exampleInputEmail1">Nem alt limit</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="30%" />
                                        <label for="exampleInputEmail1">Isı üst limit</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="40%" />
                                        <label for="exampleInputEmail1">Nem üst limit</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="10" />
                                        <label for="exampleInputEmail1">Isı kritik alt limit</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="45%" />
                                        <label for="exampleInputEmail1">Nem kritik alt limit</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="40" />
                                        <label for="exampleInputEmail1">Isı kritik üst limit</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control form-control-sm" type="text" placeholder="45%" />
                                        <label for="exampleInputEmail1">Nem kritik üst limit</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="notification-tab-pane" role="tabpanel" aria-labelledby="notification-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <select class="form-select" aria-label="Default select example">
                                                <option>Tür seçiniz...</option>
                                                <option value="1" selected>Sıcaklık</option>
                                                <option value="2">Nem</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <input type="number" class="form-control" placeholder="Alt limit">
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <input type="number" class="form-control" placeholder="Üst limit">
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="d-flex justify-content-evenly">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        E-posta
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        SMS
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Arama
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-9"></div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group mt-3">
                                                <div class="input-group mb-3">
                                                    <input class="form-control mb-4 mb-md-0" data-inputmask-alias="+\90 999 999 99 99" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="permission-tab-pane" role="tabpanel" aria-labelledby="permission-tab" tabindex="0">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="E-posta adresi" aria-label="E-posta" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Ekle</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <table id="table" class="table" data-pagination="true" data-search="true" data-page-number="1" data-multiple-select-row="true" data-click-to-select="true" data-buttons="buttons2">
                                        <thead>
                                            <tr>
                                                <th data-checkbox="true"></th>
                                                <th data-field="id" data-sortable="true">#</th>
                                                <th data-field="name" data-sortable="true">E-posta</th>
                                                <th data-field="price" data-sortable="true">Adı</th>
                                                <th>Görüntüleme</th>
                                                <th>Ayarları Düzenleme</th>
                                                <th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td>ozgur.aydin@supercode.com.tr</td>
                                                <td>Özgür Aydın</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    </div>
                                                </td>
                                                <td><button class="btn btn-danger btn-sm">Sil</button></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>2</td>
                                                <td>koksal.tapan@supercode.com.tr</td>
                                                <td>Köksal Tapan</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                                    </div>
                                                </td>
                                                <td><button class="btn btn-danger btn-sm">Sil</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
@endpush
