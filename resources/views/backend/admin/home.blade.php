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
        <x-backend.breadcrumb></x-backend.breadcrumb>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="container card-body">
        <h2>Home </h2>
    </div>
</div>
@endsection
