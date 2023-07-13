@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    href="{{ route('dashboard', ['workspace' => \App\Models\WorkSpace::find(\App\Models\Zone::find($zone->id)->work_space_id)->id]) }}">{{\App\Models\WorkSpace::find(\App\Models\Zone::find($zone->id)->work_space_id)->name}}</a>
            </li>
            <li class="breadcrumb-item"><a
                    href="{{ route('zones', ['workspace' => \App\Models\Zone::find($zone->id)->work_space_id]) }}">Bölgeler</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Bölge Düzenle</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-12 col-md-6 offset-md-3">
            <form method="POST" action="/zones/update" class="forms-sample">
                @csrf
                @method('put')
                <div class="form-floating mb-3">
                    <select class="form-select" name="id" aria-label="Default select example">
                        @foreach($zones as $zone1)
                            @if($workspace_detail->id === $zone1->work_space_id)
                                <option @if($zone1->id == $zone->parent_id || $zone1->id == $zone->id ) disabled @endif
                                @selected($zone1->id == $zone->parent_id) value="{{$zone1->id}}">{{$zone1->name}}</option>

                            @endif

                        @endforeach

                    </select>
                    <label for="parent_id" class="form-label">Bölge Seçiniz</label>
                </div>
                <input type="hidden" value="{{$workspace_detail->id}}" name="workspace_id">
                <input type="hidden" value="{{$zone->id}}" name="zone_id">


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" value="{{$zone->name}}"
                           placeholder="Ofis">
                    <label for="name" class="form-label">İsim</label>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Güncelle</button>
                </div>

            </form>

        </div>
    </div>
@endsection
