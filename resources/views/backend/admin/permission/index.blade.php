@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-check-square bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Permissions List')</h5>
                <span>@yield('span','Permission is give some action permission to any role')</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <x-backend.breadcrumb></x-backend.breadcrumb>
    </div>
</div>
@endsection



@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush



@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3>Modules</h3>
        <a class="btn btn-theme pull-right" href="{{ route('backend.modules.create') }}">Add Module <i class="ik ik-plus"></i></a>
    </div>
    <div class="card-body">
        <div>
            <table id="data_table" class="table">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Roles</th>
                        <th>Module</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
            </table>
        </div>

    </div>
</div>
@endsection


@push('js')
<script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}" defer ></script>
<script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" defer ></script>
<script>
$(document).ready(function() {
    var table = $('#data_table').DataTable({
        responsive: true,
        select: true,
        processing: true,
            serverSide: true,
            ajax: "{{ route('datatable.permissions') }}",
            "aLengthMenu": [
                [10, 20, 50, -1],
                [10, 20, 50, "All"]
            ],
            "iDisplayLength": 15,
            "autoWidth" : false,
            order:  [0, 'desc'] ,
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'rolesname',
                    name: 'rolesname'
                },
                {
                    data: 'module.name',
                    name: 'module.name'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    // width: '50%'
                },
                {
                    data: 'action',
                    name: 'action',
                    sort: false,
                }
            ],
    });

})
</script>
@endpush
