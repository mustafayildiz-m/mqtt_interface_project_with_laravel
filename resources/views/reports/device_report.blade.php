@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Raporlar</li>
        </ol>
    </nav>

    <div class="card">
        <div class="row">
            <div class="col-12 card">
                <div class="card-header-pills">
                    <button class="btn btn-link collapsed " data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fas fa-search"></i> Detaylı Arama
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div class="card" id="accordion">
        <div id="collapseTwo" class="collapse @if(isset($searchTerm)) show @endif" aria-labelledby="headingTwo"
             data-parent="#accordion">
            <div class="card-body">
                <form action="/{{$workspace_detail->id}}/reports" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <label>Başlangıç Tarihi</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control"
                                       value="@if(isset($searchTerm['q_start_date'])) {{$searchTerm['q_start_date']}} @endif"
                                       name="start_date" placeholder="Tarih seçin" data-input>
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4">
                            <label>Bitiş Tarihi</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control"
                                       value="@if(isset($searchTerm['q_end_date'])) {{$searchTerm['q_end_date']}} @endif"
                                       name="end_date" placeholder="Tarih seçin" data-input>
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>

                        <?php

                        $states = [
                            'normal',
                            'alarm',
                            'critical_alarm',
                        ];
                        ?>

                        <div class="col-12 col-md-4 col-lg-4">
                            <label>Durum</label>
                            <select class="form-select" name="q_state"
                                    aria-label="Default select example">
                                <option @if(!isset($searchTerm['q_state'])) selected @endif disabled>
                                    Durum
                                    seçiniz...
                                </option>
                                @foreach($states as $state)
                                    <option
                                        @if(isset($searchTerm['q_state']) && $searchTerm['q_state'] == $state ) selected
                                        @endif
                                        value="{{$state}}">@if($state ==='normal')
                                            Normal
                                        @elseif($state ==='alarm')
                                            Alarm
                                        @else
                                            Kritik Alarm
                                        @endif</option>

                                @endforeach
                            </select>
                        </div>


                        <div class="row">

                            <div class="col-12 col-md col-lg">
                                <label class="mt-2">Sıcaklık Min</label>
                                <input type="text" name="q_temp_min"
                                       value="@if(isset($searchTerm['q_temp_min'])) {{$searchTerm['q_temp_min']}} @endif"
                                       class="form-control" placeholder="Sıcaklık min.">
                            </div>
                            <div class="col-12 col-md col-lg">
                                <label class="mt-2">Sıcaklık Max</label>
                                <input type="text" name="q_temp_max"
                                       value="@if(isset($searchTerm['q_temp_max'])) {{$searchTerm['q_temp_max']}} @endif"
                                       class="form-control"
                                       placeholder="Sıcaklık maks.">
                            </div>
                            <div class="col-12 col-md col-lg">
                                <label class="mt-2">Nem Min</label>
                                <input type="text" name="q_moisture_min"
                                       value="@if(isset($searchTerm['q_moisture_min'])) {{$searchTerm['q_moisture_min']}} @endif"
                                       class="form-control"
                                       placeholder="Nem min.">
                            </div>
                            <div class="col-12 col-md col-lg">
                                <label class="mt-2">Nem Max</label>
                                <input type="text" name="q_moisture_max"
                                       value="@if(isset($searchTerm['q_moisture_max'])) {{$searchTerm['q_moisture_max']}} @endif"
                                       class="form-control"
                                       placeholder="Nem max.">
                            </div>
                        </div>
                        {{--                        <div class="col-12 col-md-4 col-lg-3 mt-2">--}}
                        {{--                            <label class="mt-2"></label>--}}

                        {{--                            <input type="submit" name="export_excel"--}}
                        {{--                                   class="form-control btn btn-success"--}}
                        {{--                                   value="Excele Aktar">--}}

                        {{--                        </div>--}}
                        <div class="col-12 col-md-4 col-lg-3 mt-2">
                            <label class="mt-2"></label>


                        </div>

                        <div class="col-12 col-md-4 col-lg-3 mt-2">
                            <label class="mt-2"></label>
                            <input type="button" class="form-control btn btn-primary" id="show-limits"
                                   value="Limitleri Göster"
                                   placeholder="Nem maks.">
                        </div>


                        <div class="col-12 col-md-4 col-lg-3 mt-2">
                            <label class="mt-2"></label>
                            <input type="submit" name="reset" class="form-control btn btn-warning"
                                   value="Sıfırla">

                        </div>

                        <div class="col-12 col-md-4 col-lg-3 mt-2">
                            <label class="mt-2"></label>
                            <input type="submit" class="form-control btn btn-info" value="Ara"
                                   placeholder="Nem maks.">
                        </div>


                    </div>

                </form>


            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 card">
            <h6 class="mt-2 mb-2">Toplam <b style="font-size: 16px ">{{$deviceLogs->count()}}</b> Kayıt</h6>


            <div class="table-responsive" style="text-align: center;">
                <table id="table" data-show-export="true" data-pagination="true" data-click-to-select="true"
                       data-toolbar="#toolbar" data-search="true" data-visible-search="true" data-show-columns="true"
                       data-locale="tr-TR" data-filter-control="true">
                    <thead>
                    <tr>
                        <th data-sortable="true">İsim</th>
                        <th data-sortable="true">Cihaz Seri No</th>
                        <th data-sortable="true">Bölge</th>
                        <th data-sortable="true">Isı</th>
                        <th data-sortable="true">Nem</th>
                        <th data-sortable="true">Durum</th>
                        <th class="lim-th d-none">Limitler</th>
                        <th>Zaman</th>
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
                    @if(isset($deviceLogs))

                        @foreach($deviceLogs->get() as $key => $deviceLog)
                            <tr>
                                <td>{{$deviceLog->device_name}}</td>
                                <td>{{$deviceLog->serial_no}}</td>
                                <td>
                                    {{printUpperSubtree(\App\Models\Zone::where(['work_space_id' => $workspace_detail->id])->get()->toArray(),$deviceLog->zone_id)}}
                                </td>
                                <td>{{$deviceLog->temp}} °C</td>
                                <td>{{$deviceLog->humd}} %</td>
                                <td>

                                    @if ($deviceLog->state === 'critical_alarm')
                                        <span class="blink badge badge-danger">Kritik Alarm</span>
                                    @elseif ($deviceLog->state === 'alarm')
                                        <span class="blink1 badge badge-warning">Alarm</span>
                                    @else
                                        <span class="blink2 badge badge-success">Normal</span>
                                    @endif

                                </td>
                                <td class="lim-td d-none">
                                    <ul class="custom-list">
                                        <li>Isı : {{$deviceLog->temp_min}}°C
                                            - {{$deviceLog->temp_max}}°C
                                        </li>
                                        <li>Nem : {{$deviceLog->moisture_min}}%
                                            - {{$deviceLog->moisture_max}}%
                                        </li>
                                        <li>Kritik Isı :{{$deviceLog->crit_temp_min}}°C
                                            - {{$deviceLog->crit_temp_max}}°C
                                        </li>
                                        <li>Kritik Nem :{{$deviceLog->crit_moisture_min}}%
                                            - {{$deviceLog->crit_moisture_max}}%
                                        </li>
                                    </ul>

                                </td>
                                {{--                                <td>{{turkishDate('j F Y , l',explode(' ',$deviceLog->d_created_at)[0])}} <br>--}}
                                {{--                                    {{explode(' ',$deviceLog->d_created_at)[1]}}</td>--}}
                                <td>
                                        <?php
                                        $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $deviceLog->d_created_at);
                                        $formattedDate = $carbonDate->format('d.m.Y H:i:s');
                                        print $formattedDate;
                                        ?>
                                </td>
                            </tr>

                        @endforeach
                    @endif

                    </tbody>


                </table>
                {{--                <div class="pagination mt-1" style="text-align: center;">--}}
                {{--                    {{ $pagination->links() }}--}}
                {{--                </div>--}}


            </div>

        </div>

    </div>
@endsection

@push('plugin-scripts')
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/tableExport.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF/jspdf.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.21/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>
    <script
        src="https://unpkg.com/bootstrap-table@1.21.4/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
@endpush

@push('custom-scripts')
    <script>
        var $table = $('#table')

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

            $('.show-limits').on('click', function (e) {
                e.preventDefault();
                if ($('.lim-th').attr('class').indexOf('d-none') != -1) {
                    $('.lim-th').removeClass('d-none');
                    $('.lim-td').removeClass('d-none');
                    $(this).val('Limitleri Gizle')
                } else {
                    $('.lim-th').addClass('d-none');
                    $('.lim-td').addClass('d-none');
                    $(this).val('Limitleri Göster')

                }

            })

            $table.bootstrapTable({
                exportDataType: 'all',
                exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
                showRefresh: true
            })
        });

        $.fn.bootstrapTable.locales['tr-TR'] = $.fn.bootstrapTable.locales['tr'] = {
            formatCopyRows() {
                return 'Copy Rows'
            },
            formatPrint() {
                return 'Print'
            },
            formatLoadingMessage() {
                return 'Yükleniyor, lütfen bekleyin'
            },
            formatRecordsPerPage(pageNumber) {
                return `Sayfa başına ${pageNumber} kayıt.`
            },
            formatShowingRows(pageFrom, pageTo, totalRows, totalNotFiltered) {
                if (totalNotFiltered !== undefined && totalNotFiltered > 0 && totalNotFiltered > totalRows) {
                    return `${totalRows} kayıttan ${pageFrom}-${pageTo} arası gösteriliyor (filtered from ${totalNotFiltered} total rows).`
                }

                return `${totalRows} kayıttan ${pageFrom}-${pageTo} arası gösteriliyor.`
            },
            formatSRPaginationPreText() {
                return 'previous page'
            },
            formatSRPaginationPageText(page) {
                return `to page ${page}`
            },
            formatSRPaginationNextText() {
                return 'next page'
            },
            formatDetailPagination(totalRows) {
                return `Showing ${totalRows} rows`
            },
            formatClearSearch() {
                return 'Clear Search'
            },
            formatSearch() {
                return 'Ara'
            },
            formatNoMatches() {
                return 'Eşleşen kayıt bulunamadı.'
            },
            formatPaginationSwitch() {
                return 'Hide/Show pagination'
            },
            formatPaginationSwitchDown() {
                return 'Show pagination'
            },
            formatPaginationSwitchUp() {
                return 'Hide pagination'
            },
            formatRefresh() {
                return 'Yenile'
            },
            formatToggleOn() {
                return 'Show card view'
            },
            formatToggleOff() {
                return 'Hide card view'
            },
            formatColumns() {
                return 'Sütunlar'
            },
            formatColumnsToggleAll() {
                return 'Toggle all'
            },
            formatFullscreen() {
                return 'Fullscreen'
            },
            formatAllRows() {
                return 'Tüm Satırlar'
            },
            formatAutoRefresh() {
                return 'Auto Refresh'
            },
            formatExport() {
                return 'Export data'
            },
            formatJumpTo() {
                return 'GO'
            },
            formatAdvancedSearch() {
                return 'Advanced search'
            },
            formatAdvancedCloseButton() {
                return 'Close'
            },
            formatFilterControlSwitch() {
                return 'Hide/Show controls'
            },
            formatFilterControlSwitchHide() {
                return 'Hide controls'
            },
            formatFilterControlSwitchShow() {
                return 'Show controls'
            }
        }

        Object.assign($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales['tr-TR'])
    </script>
    <style>
        nav[role='navigation'] {
            margin: auto;
        }

        .custom-list {
            list-style-type: none; /* Yuvarlak işaretleri kaldırır */
        }

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
