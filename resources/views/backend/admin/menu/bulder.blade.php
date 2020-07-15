@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-check-square bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Menu Bulder')</h5>
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

@endpush



@section('content')
<div class="card">
    <div class="card-header justify-content-between">
        <h3>Menus</h3>
        <a class="btn btn-theme shadow" data-toggle="modal" data-target="#menuModal" href="#">Add Menu <i class="ik ik-plus"></i></a>
    </div>
    <div class="card-body">
        <div>

        </div>
    </div>
</div>

@endsection


@push('js')

@endpush
