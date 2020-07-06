@extends('layouts.backend.app')


@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
    @livewireStyles
@endpush

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-shield-off bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','Add Role & Premission')</h5>
                <span>@yield('span','Add New Roles, Premissions To Website')</span>
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

    <div class="card">
        <div class="card-body">
            <div class="border rounded shadow-sm border-primary p-3">
                <livewire:bankend.role.create />
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

<script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}">
</script>



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

    // var checkedarray = [];

    document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('afterDomUpdate', () => {
            checkbox();

            // checkedarray = []
            // $('.checkbox').each((e,i)=>{
            //     var val = $(i).val();
            //     if (i.checked) {
            //         checkedarray.push(parseInt(val));
            //     }
            // });

            // // checkedarray = []



            // $('.checkbox').change(function() {
            //     checkedarray = []
            //     $('.checkbox').each((e,i)=>{
            //         var val = $(i).val();
            //         if (i.checked) {
            //             checkedarray.push(parseInt(val));
            //         }
            //     });
            // });
        });

        window.livewire.hook('beforeDomUpdate', () => {
            // console.log('beforeDomUpdate');

            // $('.checkbox').each((e,i)=>{
            //     var val = $(i).val();
            //     checkedarray.push(Array(
            //         parseInt(val),
            //         i.checked,
            //     ));
            // });

            // console.log(checkedarray);
        });
    });

    document.addEventListener('DOMContentLoaded', function (event) {
        checkbox();
    })

    $('#role').change(e=>{
        window.livewire.emit('roleSelectChanged',$("#role").val());
    })

    window.addEventListener('notify',e=>{
        console.log(e);

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

{{-- @this.set('permissions', checkedarray); --}}
