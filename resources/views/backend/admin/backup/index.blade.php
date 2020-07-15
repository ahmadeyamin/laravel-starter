@extends('layouts.backend.app')

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-check-square bg-green"></i>
            <div class="d-inline">
                <h5>@yield('h2','Database Backups')</h5>
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
        <h3>Backups</h3>
        <a class="btn btn-theme shadow"  href="{{ route('backend.backups.create') }}">New Backup<i class="ik ik-plus"></i></a>
    </div>
    <div class="card-body">
        <div>
            <ul class="list-group shadow-sm">

             @forelse ($backups as $backup)
             <li class="list-group-item ">
                <h2 class="text-dark d-inline-block font-weight-bold">{{$backup['file_name']}}
                </h2>
                <small class="bg-primary p-1 text-white shadow rounded">{{$backup['file_size']}}</small>

                <a class="btn btn-icon btn-outline-primary shadow float-right" href="{{ route('backend.backups.download',['path'=>$backup['file_path']]) }}"><i class="ik ik-download"></i></a>

                <a class="btn btn-icon btn-outline-danger float-right shadow mx-1" onclick="return confirm('Are You Sure. It Will Detele This DB File') ? true : false;
                " href="{{ route('backend.backups.delete',['path'=>$backup['file_path']]) }}"><i class="ik ik-trash"></i></a>
                </li>

            @empty
                <h2 class="text-danger text-center">No Backup Yet 😢</h2>
            @endforelse
            </ul>

        </div>
    </div>
</div>


@endsection

