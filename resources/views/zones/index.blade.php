@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => $workspace_detail->id]) }}">superLOG</a>
            </li>
            <li class="breadcrumb-item" aria-current="page"><a
                    href="{{ route('zones', ['workspace' => $workspace_detail->id])}}">Bölgeler</a></li>
            <li class="breadcrumb-item active">{{$workspace_detail->name}}
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-10 offset-1">
            <div class="d-flex justify-content-end my-3">
                <a href="{{ route('zones.create',['workspace' => $workspace_detail->id]) }}" class="btn btn-primary">Bölge
                    Oluştur</a>
            </div>
        </div>
        <div class="col-md-10 offset-1 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"></h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>İsim</th>
                                <th>Bağlı olduğu Çalışma alanı</th>
                                <th>Bağlı olduğu Bölge</th>
                                <th>Cihaz Sayısı</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(auth()->user()->workspaces as $workspace)
                                @foreach($workspace->zones as $zone)
                                    @if($zone->work_space_id == request()->segments()[0] )
                                        <tr>
                                            <td>{{$zone->name}}</td>
                                            <td>{{$workspace->name}}</td>
                                            <td>@if(isset(\App\Models\Zone::find($zone->parent_id)->name))
                                                    {{\App\Models\Zone::find($zone->parent_id)->name}}
                                                @endif</td>
                                            <td>{{\App\Models\Device::where('zone_id',$zone->id)->count()}}</td>
                                            <td>
                                                <a href="{{ route('zones.edit', ['workspace'=>$workspace_detail->id,'id'=>$zone->id]) }}"
                                                   class="btn btn-primary">Düzenle</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
