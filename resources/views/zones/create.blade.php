@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a
                    href="{{ route('dashboard', ['workspace' => $workspace_detail->id])}}">{{$workspace_detail->name}}</a>
            </li>
            {{--            <li class="breadcrumb-item"><a href="{{ route('zones') }}">Bölgeler</a></li>--}}
            <li class="breadcrumb-item active" aria-current="page">Bölge Oluştur</li>
        </ol>
    </nav>

    <div class="row">

        @isset($zones)
            <div class="col-12 col-md-6 offset-md-3">
                <form action="/zones/{{$workspace_detail->id}}/created" method="POST" class="forms-sample">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="parent_id" name="parent_id" aria-label="Default select example">
                            <option value="0" selected >Bölge seçiniz...</option>

                            @foreach ($tree as $zone)
                                <option value="{{ $zone->id }}">{{ str_repeat('--', $zone->depth) }} {{ $zone->name }}</option>
                            @endforeach

                        </select>
                        @method('post')

                        @csrf
                        <label for="parent_id" class="form-label">Bağlı olduğu bölge</label>
                    </div>
                    <input type="hidden" name="workspace_id" value="{{$workspace_detail->id}}">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="zone_name" name="name" required placeholder="İsim">
                        <label for="name" class="form-label">İsim</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="btn btn-success float-md-end" type="submit" value="Oluştur">
                    </div>
                </form>
            </div>
        @endisset
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<script>

    $(function () {
        $('#parent_id').on('change', function () {
            if ($('#zone_name').val().length > 0) {
                $('#create-zone-button').removeAttr('disabled')
            }
        })
        $('#zone_name').on('keyup', function () {

            if ($(this).val().length > 0) {
                $('#create-zone-button').removeAttr('disabled')
            } else if ($(this).val().length === 0) {
                $('#create-zone-button').attr('disabled','disabled')

            }

        })

    })
</script>
