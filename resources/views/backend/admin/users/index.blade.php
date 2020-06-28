@extends('layouts.backend.app')



@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-home bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','Dashboard')</h5>
                <span>@yield('span','Website Admin Dashboard')</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <nav class="breadcrumb-container" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/"><i class="ik ik-home"></i></a>
                </li>

            </ol>
        </nav>
    </div>
</div>
@endsection



@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush




@push('js')
<script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}" defer ></script>
<script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" defer ></script>
<script>
$(document).ready(function() {
    var table = $('#data_table').DataTable({
        responsive: true,
        select: true,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['nosort']
        }]
    });

})
</script>
@endpush

@section('content')
<div class="card-header justify-content-between"><h3>Dashboard</h3> <a class="btn btn-theme pull-right" target="_blank" href="/">Setting</a></div>
<div class="card-body">

    <div>
        <table id="data_table" class="table">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td><img src="{{ asset('img/users/5.jpg') }}" class="img-thumbnail table-user-thumb rounded-circle" alt=""></td>
                        <td>EYamin </td>
                        <td>duh@wud.eof</td>
                        <td>Admin</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Apple</button>
                                <button type="button" class="btn btn-primary">Samsung</button>
                                <button type="button" class="btn btn-primary">Sony</button>
                              </div>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">1</td>
                        <td><img src="{{ asset('img.1.jpg') }}" class="img-thumbnail rounded-circle" alt=""></td>
                        <td>EYamin </td>
                        <td>duh@wud.eof</td>
                        <td>Admin</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Apple</button>
                                <button type="button" class="btn btn-primary">Samsung</button>
                                <button type="button" class="btn btn-primary">Sony</button>
                              </div>
                        </td>
                    </tr>
                </tbody>
        </table>
    </div>

</div>
@endsection
