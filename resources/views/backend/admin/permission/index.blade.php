@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-check-square bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Permissions List')</h5>
                <span>@yield('span','Permission is give some action permission to any role') <code>@{{Gate::autorize('app.example.index')}}</code></span>
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
<style>
    .select2-container{
        width: 100% !important;
    }
</style>
@livewireStyles
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
@endpush



@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3>Permissions</h3>
        <a class="btn btn-success shadow" href="{{ route('backend.modules.create') }}">Add Module <i class="ik ik-plus"></i></a>
        <a class="btn btn-theme shadow" data-toggle="modal" data-target="#permissionModal" href="#">Add Permission <i class="ik ik-plus"></i></a>
    </div>
    <div class="card-body">
        <div>
            <table id="data_table" class="table table-responsive-md">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gate</th>
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


<div class="modal fade shadow border-0" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <livewire:bankend.permission.create />
      </div>
    </div>
  </div>

<div class="modal fade shadow border-0" id="editpermissionModal" tabindex="-1" role="dialog" aria-labelledby="editpermissionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <livewire:bankend.permission.edit />
      </div>
    </div>
  </div>
@endsection


@push('js')
@livewireScripts
<script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}" defer ></script>
<script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}" defer ></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>

<script>
$(document).ready(function() {
    datatab();

})

function datatab() {
     window.table = $('#data_table').DataTable({
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
}


document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('afterDomUpdate', () => {
            $(".select2").select2();
            selectChanged()

        });
        window.livewire.hook('beforeDomUpdate', () => {

        });
    });

    document.addEventListener('DOMContentLoaded', function (event) {
        $(".select2").select2();
        selectChanged()
    })


    function selectChanged(){
        $('#module').change(e=>{
            window.livewire.emit('moduleSelectChanged',$("#module").val());
        })
        $('#moduleedit').change(e=>{
            window.livewire.emit('moduleEditSelectChanged',$("#moduleedit").val());
        })
    }


    window.addEventListener('notify',e=>{
        $.toast({
            heading: e.detail.type,
            text: e.detail.message,
            showHideTransition: 'fade',
            icon: e.detail.type.toLowerCase(),
            loaderBg: '#00ffdd',
            position: 'bottom-left'
        });
        console.log(e.detail.reload);

        if (e.detail.reload) {
            setInterval(() => {
                window.location.reload();
            }, 1000);
        }

    })


    function openEditPermission($id) {
        window.livewire.emit('editpermission',$id)
        $('#editpermissionModal').modal();
    }
</script>
@endpush
