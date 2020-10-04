@extends('layouts.backend.app')


@push('css')

@livewireStyles

@endpush

@section('header')
<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <i class="ik ik-user bg-blue"></i>
            <div class="d-inline">
                <h5>@yield('h2','Profile') </h5>
                <span>@yield('span','View This User Profile')</span>
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
    <div class="max-w-7xl py-10 sm:px-6 lg:px-8">
        @livewire('profile.update-profile-information-form')

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <x-jet-section-border />
        
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <x-jet-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        <x-jet-section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('profile.delete-user-form')
        </div>
    </div>
</div>
@endsection


@push('js')
@livewireScripts
@endpush
