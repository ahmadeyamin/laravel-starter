@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-package bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Add New Pages')</h5>
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
        <h3>Add New Page</h3>
        <a class="btn btn-theme shadow" href="{{ URL::previous() }}">Back</a>
    </div>
    <div class="card-body">
        <div>
            <form action="{{ route('backend.pages.store') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Page Title" aria-describedby="page_title">
                                <small id="page_title" class="text-muted">Page Title</small>
                            </div>
                        </form>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


@endsection


@push('js')

@endpush
