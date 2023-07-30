@extends('layouts.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a></li>
            <li class="breadcrumb-item active" aria-current="page">Olaylar</li>
        </ol>
    </nav>

    <div class="col-md-10 offset-1 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"></h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Cihaz</th>
                                <th>Olay</th>
                                <th>Başlangıç</th>
                                <th>Bitiş</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SC-23</td>
                                <td>Kritik Nem</td>
                                <td>4 Mayıs 2023, Perşembe 20:33</td>
                                <td>4 Mayıs 2023, Perşembe 20:43</td>
                                <td><span class="badge bg-warning">Bekliyor</span></td>
                                <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Düzenle</button></td>
                            </tr>
                            <tr>
                                <td>SC-23</td>
                                <td>Kritik Nem</td>
                                <td>3 Mayıs 2023, Perşembe 20:33</td>
                                <td>3 Mayıs 2023, Perşembe 20:43</td>
                                <td><span class="badge bg-success">Çözüldü</span></td>
                                <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Düzenle</button></td>
                            </tr>
                            <tr>
                                <td>SC-23</td>
                                <td>Kritik Nem</td>
                                <td>3 Mayıs 2023, Perşembe 14:33</td>
                                <td>3 Mayıs 2023, Perşembe 14:43</td>
                                <td><span class="badge bg-success">Çözüldü</span></td>
                                <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Düzenle</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Olay Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control">
                        <label for="exampleFormControlInput1" class="form-label">İsim</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Sorun neydi ve nasıl çözüldü?" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Açıklama</label>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <label for="floatingTextarea2">Ek</label>
                        <input type="file" id="myDropify" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary">Kaydet</button>
                </div>
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
