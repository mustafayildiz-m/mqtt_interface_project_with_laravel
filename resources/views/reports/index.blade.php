@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'supercode']) }}">Supercode</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Raporlar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-3">
                            <label>Başlangıç Tarihi</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Tarih seçin" data-input>
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label>Bitiş Tarihi</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Tarih seçin" data-input>
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label>Durum</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Durum seçiniz...</option>
                                <option value="1">Normal</option>
                                <option value="2">Alarm</option>
                                <option value="3">Kritik Alarm</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label>Bölge</label>
                            <select class="form-select" name="q_zone_id" aria-label="Default select example">
                                <option selected disabled>Bölge seçiniz...</option>
                                @foreach(\App\Models\Zone::where(['work_space_id'=>$workspace_detail->id])->get()->all() as $zone)
                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label class="mt-2">Cihaz</label>
                            <select class="form-select" name="q_device_id" aria-label="Default select example">
                                <option selected disabled>Cihaz seçiniz...</option>
                                @foreach(\App\Models\Device::where(['workspace_id'=>$workspace_detail->id])->get()->all() as $device)
                                    <option value="1">{{$device->device_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label class="mt-2">Sıcaklık Min</label>
                            <input type="text" class="form-control" placeholder="Sıcaklık min.">
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label class="mt-2">Sıcaklık Max</label>
                            <input type="text" class="form-control" placeholder="Sıcaklık maks.">
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label class="mt-2">Nem Min</label>
                            <input type="text" class="form-control" placeholder="Nem min.">
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <label class="mt-2">Nem Max</label>
                            <input type="text" class="form-control" placeholder="Nem maks.">
                        </div>
                        <div class="col-12 col-md-4 col-lg-3 mt-2">
                            <label class="mt-2"></label>
                            <input type="submit" class="form-control btn btn-success" value="Ara"
                                   placeholder="Nem maks.">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    @dd($deviceLogs)--}}
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>İsim</th>
                        <th>Cihaz Seri No</th>
                        <th>Bölge</th>
                        <th>Isı</th>
                        <th>Nem</th>
                        <th>Durum</th>
                        <th>Limitler</th>
                        <th>Zaman</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($deviceLogs))
                        @foreach($deviceLogs as $key => $deviceLog)
                            <tr>
                                <td>{{$deviceLog->device_name}}</td>
                                <td>{{$deviceLog->serial_no}}</td>
                                <td>{{$workspace_detail->name}}{{isset(\App\Models\Zone::where(['id'=>$deviceLog->parent_id])->first()->name)?'>'.\App\Models\Zone::where(['id'=>$deviceLog->parent_id])->first()->name:''}}
                                    > {{$deviceLog->zone_name}}
                                </td>
                                <td>{{$deviceLog->temp}} °C</td>
                                <td>{{$deviceLog->humd}} %</td>
                                <td>

                                    @if ($deviceLog->state === 'critical_alarm')
                                        <span class="blink badge badge-danger">Kritik Alarm</span>
                                    @elseif ($deviceLog->state === 'alarm')
                                        <span class="blink1 badge badge-danger">Alarm</span>
                                    @else
                                        <span class="blink2 badge badge-success">Normal</span>
                                    @endif

                                </td>
                                <td>
                                    <ul>
                                        <li>Min Sıcaklık : {{$deviceLog->temp_min}}°C</li>
                                        <li>Max Sıcaklık : {{$deviceLog->temp_max}}°C</li>
                                        <li>Krit.Max Sıcaklık : {{$deviceLog->crit_temp_max}}°C</li>
                                        <li>Krit.Min Sıcaklık : {{$deviceLog->crit_temp_max}}°C</li>
                                        <li>Min Nem : {{$deviceLog->moisture_min}}°C</li>
                                        <li>Max Nem : {{$deviceLog->moisture_max}}°C</li>
                                        <li>Krit.Max Nem : {{$deviceLog->crit_moisture_max}}°C</li>
                                        <li>Krit.Min Nem : {{$deviceLog->crit_moisture_min}}°C</li>
                                    </ul>

                                </td>
                                <td>{{turkishDate('j F Y , l',explode(' ',$deviceLog->d_created_at)[0])}} <br>
                                    {{explode(' ',$deviceLog->d_created_at)[1]}}</td>
                            </tr>

                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        $(function () {
            'use strict';
            if ($('.flatpickr').length) {
                flatpickr(".flatpickr", {
                    enableTime: true,
                    wrap: true,
                    dateFormat: "d-m-Y H:i",
                    time_24hr: true,
                    locale: {
                        weekdays: {
                            longhand: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
                            shorthand: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt']
                        },
                        months: {
                            longhand: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                            shorthand: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara']
                        },
                        today: 'Bugün',
                        clear: 'Temizle'
                    }
                });
            }
        });
    </script>
    <style>
        .blink {
            animation: blinker 0.9s linear infinite;
            color: white;
            background-color: red !important;
            font-size: 15px;
            font-weight: bold;
            font-family: sans-serif;
            border-radius: 19px;
            text-align: center;

        }

        .blink1 {
            color: white;
            background-color: red !important;
            font-size: 15px;
            font-weight: bold;
            font-family: sans-serif;
            border-radius: 19px;
            text-align: center;

        }

        .blink2 {
            color: white;
            background-color: green !important;
            font-size: 15px;
            font-weight: bold;
            font-family: sans-serif;
            border-radius: 19px;
            text-align: center;

        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }

        .nrml {

            background-color: green !important;
            color: white;
            font-size: 15px;
            font-weight: bold;
            font-family: sans-serif;
            border-radius: 19px;
            text-align: center;

        }

        .dngr {

            background-color: red !important;
            color: white;
            font-size: 15px;
            font-weight: bold;
            font-family: sans-serif;
            border-radius: 19px;
            text-align: center;

        }

        td {
            text-align: center;

        }

        tr {
            text-align: center;

        }
    </style>
@endpush
