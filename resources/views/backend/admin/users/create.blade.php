@extends('layouts.backend.app')


@push('css')

@endpush

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-user bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','Add User')</h5>
                <span>@yield('span','Add New User To Website')</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <nav class="breadcrumb-container" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href="/"><i class="ik ik-home"></i></a>
                </li>
                @foreach (request()->segments() as $item)
                    <li class="breadcrumb-item">
                        <a >{{ucfirst($item)}}</a>
                    </li>
                @endforeach


            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="card-header justify-content-between">
    <h3>Add User</h3>
    <a class="btn btn-theme pull-right" href="{{ url()->previous() }}">Back</a>
</div>
<div class="card-body">
    <div>

    </div>

</div>
@endsection


@push('js')

@endpush
