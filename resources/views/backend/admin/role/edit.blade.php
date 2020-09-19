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
            <i class="ik ik-shield-off bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','Edit Role & Premission')</h5>
                <span>@yield('span','Edit Roles, Premissions')</span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <x-backend.breadcrumb></x-backend.breadcrumb>
    </div>
</div>
@endsection

@section('content')
<div>

    <div class="card">
        <div class="card-body">
            <div class="border rounded shadow-sm border-primary p-3">
                <livewire:bankend.role.edit id="{{$id}}" />
            </div>
            <br>

            <h3 class="text-dark h5 text-center">Select Premission To Selected Role</h3>
            <div class="border rounded shadow-sm border-secondary p-3">
                <livewire:bankend.role.role-permission id="presdiid" />
            </div>
        </div>


    </div>
</div>

@endsection


@push('js')
@livewireScripts

<script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>

<script>
    function checkbox() {

    var elems = Array.prototype.slice.call(document.querySelectorAll('.checkbox'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#4099ff',
                jackColor: '#fff',
                size: 'small'
            });
        });
    }

    document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('message.processed', () => {
            checkbox();
            selectChanged();
            $(".select2").select2();

        });
        window.livewire.hook('message.received', () => {
            $('.switchery').hide();
        });
    });

    document.addEventListener('DOMContentLoaded', function (event) {
        checkbox();
        selectChanged();
        $(".select2").select2();

    })

    $(window).ready(e=>{

        window.livewire.emit('roleSelectChanged','{{$id}}');
    })

    function selectChanged(){
        $('#role').change(e=>{
            window.livewire.emit('roleSelectChanged',$("#role").val());
        })
    }

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
