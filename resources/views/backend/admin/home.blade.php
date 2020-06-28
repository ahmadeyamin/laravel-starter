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

@section('content')
<div class="container">
    <h2>Home </h2>
</div>
@endsection
