@extends('layouts.master')

@push('page_title')
    {!! $pageTitle !!}
@endpush

@push('plugin-styles')
    <link href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard', ['workspace' => 'admin']) }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cihazlar</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-10 offset-1">
            <div class="assignment-actions my-3">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Kullanıcı seçiniz...</option>
                            <option value="1">Ali Onur Serçe</option>
                            <option value="2">Özgür Aydın</option>
                            <option value="3">Köksal Tapan</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-4"><a href="{{ route('admin.devices.assignment') }}" class="btn btn-primary">Ata</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-10 offset-1 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Cihazlar</h6>
                    <table id="table">
                        <thead>
                            <tr>
                                <th data-checkbox="true"></th>
                                <th>İsim</th>
                                <th>Seri No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>SC-001</td>
                                <td>SCSAF83FGH32</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>SC-001</td>
                                <td>SCSAF83FGH32</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>SC-001</td>
                                <td>SCSAF83FGH32</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>SC-001</td>
                                <td>SCSAF83FGH32</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>
    <script>
        $(function() {
            $('#table').bootstrapTable()

            $('#button').click(function() {
                alert(JSON.stringify($('#table').bootstrapTable('getData').map(function(row) {
                    return row.id
                })))
            })
        })
    </script>

    <script>
        function connectButton() {
            return {
                btnUsersAdd: {
                    text: 'Cihazları ata',
                    icon: 'fa-chain',
                    event: function() {
                        alert('Cihazlar atandı')
                    },
                    attributes: {
                        title: 'Cihazları ata'
                    }
                }
            }
        }
    </script>
@endpush
