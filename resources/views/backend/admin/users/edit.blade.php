@extends('layouts.backend.app')


@push('css')
<link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
@livewireStyles
@endpush

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-user bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','Edit User')</h5>
                <span>@yield('span','Edit User')</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <x-backend.breadcrumb></x-backend.breadcrumb>
    </div>
</div>
@endsection

@section('content')
<div class="">

<livewire:bankend.user.edit :user="$user" />

</div>
@endsection


@push('js')
@livewireScripts

<script src="{{ asset('/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>

<script>
    var elemsingle = document.querySelector('#checkbox');

    function checkbox() {
        var switchery = new Switchery(elemsingle, {
                color: '#4099ff',
                jackColor: '#fff',
                size: 'small'
        });
    }

    document.addEventListener("livewire:load", function(event) {
        window.livewire.hook('beforeDomUpdate', () => {
            // checkbox();

        });

        window.livewire.hook('afterDomUpdate', () => {
            checkbox();

        });
    });

    document.addEventListener('DOMContentLoaded',function(event) {
        checkbox();
    })

    window.addEventListener('notify',e=>{
        $.toast({
            heading: e.detail.type,
            text: e.detail.message,
            showHideTransition: 'fade',
            icon: e.detail.type.toLowerCase(),
            loaderBg: '#00ffdd',
            position: 'bottom-left'
        })
    })
</script>
@endpush
