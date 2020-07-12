@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-check-square bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Menu List')</h5>
                <span>@yield('span','')</span>
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
@livewireStyles
@endpush



@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3>Menus</h3>
        <a class="btn btn-theme shadow" data-toggle="modal" data-target="#menuModal" href="#">Add Menu <i class="ik ik-plus"></i></a>
    </div>
    <div class="card-body">
        <div>
            <table id="data_table" class="table table-responsive-md">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Items</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                        <tr>
                            <td>{{$menu->id}}</td>
                            <td>{{$menu->name}}</td>
                            <td><code>{{$menu->slug}}</code></td>
                            <td>{{$menu->description}}</td>
                            <td>
                                <span class="badge badge-primary shadow">{{$menu->items_count}} Items</span>
                            </td>

                            <td>{{$menu->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="#" class="btn btn-success shadow btn-sm"> <i class="ik ik-menu"></i> Builder</a>
                                <a href="javascript:void(0)" onclick="openEditMenu({{$menu->id}})" class="btn btn-danger shadow btn-sm"><i class="ik ik-edit"></i> Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>

    </div>
</div>

<div class="modal fade shadow border-0" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <livewire:bankend.menu.create />
      </div>
    </div>
</div>

<div class="modal fade shadow border-0" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <livewire:bankend.menu.edit />
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
     $('#data_table').DataTable({
        responsive: true,
        select: true,
        "aLengthMenu": [
            [10, 20, 50, -1],
            [10, 20, 50, "All"]
        ],
        "iDisplayLength": 15,
        "autoWidth" : false,
        order:  [0, 'desc'] ,

    });
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

    if (e.detail.reload) {
        setInterval(() => {
            window.location.reload();
        }, 1000);
    }

})


function openEditMenu($id) {
    window.livewire.emit('editMenu',$id)
    $('#editMenuModal').modal();
}

</script>
@endpush
