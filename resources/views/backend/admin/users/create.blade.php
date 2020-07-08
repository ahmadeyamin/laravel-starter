@extends('layouts.backend.app')


@push('css')
<link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
@livewireStyles
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
        <x-backend.breadcrumb></x-backend.breadcrumb>
    </div>
</div>
@endsection

@section('content')
<div class="">

    <livewire:bankend.user.create />

</div>
@endsection


@push('js')
@livewireScripts

<script src="{{ asset('/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>

<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>

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
            selectChanged()
            $(".select2").select2();
        });
    });

    document.addEventListener('DOMContentLoaded',function(event) {
        checkbox();
        selectChanged()
        $(".select2").select2();
    })

    function selectChanged(){
        $('#role').change(e=>{
            window.livewire.emit('roleSelectChanged',$("#role").val());
        })
    }
</script>
@endpush
