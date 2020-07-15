@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-package bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Pages List')</h5>
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

@endpush



@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3>Pages</h3>
        <a class="btn btn-theme shadow" data-toggle="modal" data-target="#menuModal" href="#">Add Page <i class="ik ik-plus"></i></a>
    </div>
    <div class="card-body">
        <div>
            <table id="data_table" class="table table-responsive-md">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Body</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->image}}</td>
                            <td>{{$page->title}}</td>
                            <td>{{$page->slug}}</td>
                            <td>
                               {{$page->short_body}}
                            </td>

                            <td>{!!$page->status ? '<span class="text-green rounded-circle">•</span>' : '<span class="text-danger rounded-circle">•</span>'!!}</td>
                            <td>{{$page->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{ route('backend.pages.show',$page->id) }}" class="btn btn-success shadow btn-sm"> <i class="ik ik-eye"></i> Show</a>
                                <a href="javascript:void(0)" class="btn btn-danger shadow btn-sm"><i class="ik ik-edit"></i> Edit</a>
                            </td>
                        </tr>
                        @endforeach
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



</script>
@endpush
