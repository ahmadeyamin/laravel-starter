@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-user bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','Users List')</h5>
                <span>@yield('span','Website Admin And User List')</span>
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
        <h3>Users</h3>
        <a class="btn btn-theme pull-right shadow-sm" href="{{ route('backend.users.create') }}">Add User <i class="ik ik-user-plus"></i></a>
    </div>
    <div class="card-body">
        <div>
            <table id="data_table" class="table table-responsive-md">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Last Active</th>
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
            ajax: "{{ route('datatable.users') }}",
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
                    data: 'avatar',
                    name: 'avatar'
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: false
                },
                {
                    data: 'email',
                    name: 'email',
                    className: 'font-weight-bold',
                    // width: '50%'
                },
                {
                    data: 'role',
                    name: 'role',
                    // width: '50%'
                },
                {
                    data: 'last_login_at',
                    name: 'last_login_at',
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
