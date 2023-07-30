@extends('layouts.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'supercode']) }}">superLOG</a></li>
            <li class="breadcrumb-item active" aria-current="page">Destek Taleplerim</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-10 offset-1">
            <div class="d-flex justify-content-end my-3">
                <a href="{{ route('tickets.create') }}" class="btn btn-primary ms-3">Oluştur</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                        <tr>
                            <th>Hizmet</th>
                            <th>Konu</th>
                            <th>Açıklama</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SC-001</td>
                            <td>Cihazın ışığı yanıp sönüyor</td>
                            <td>Cihazın ışığı yanıp sönüyor...</td>
                            <td>08.05.2023 16:54</td>
                            <td><span class="btn btn-sm btn-danger">Cevaplanmadı</span></td>
                            <td>
                                <a href="{{ route('tickets.details', [1]) }}" class="btn btn-sm btn-secondary">Detay</a>
                            </td>
                        </tr>
                        <tr>
                            <td>SC-001</td>
                            <td>Cihazın ışığı yanıp sönüyor</td>
                            <td>Cihazın ışığı yanıp sönüyor...</td>
                            <td>08.05.2023 16:54</td>
                            <td><span class="btn btn-sm btn-warning">Bekliyor</span></td>
                            <td>
                                <a href="{{ route('tickets.details', [1]) }}" class="btn btn-sm btn-secondary">Detay</a>
                            </td>
                        </tr>
                        <tr>
                            <td>SC-001</td>
                            <td>Cihazın ışığı yanıp sönüyor</td>
                            <td>Cihazın ışığı yanıp sönüyor...</td>
                            <td>08.05.2023 16:54</td>
                            <td><span class="btn btn-sm btn-success">Çözüldü</span></td>
                            <td>
                                <a href="{{ route('tickets.details', [1]) }}" class="btn btn-sm btn-secondary">Detay</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
