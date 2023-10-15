@extends('backEnd/layouts/master')

@php
    $contentNavbar = true;
    $containerNav = $containerNav ?? 'container';
    $isNavbar = $isNavbar ?? true;
    $isMenu = $isMenu ?? true;
    $isFlex = $isFlex ?? false;
    $isFooter = $isFooter ?? true;
    $customizerHidden = $customizerHidden ?? '';
    $pricingModal = $pricingModal ?? false;
    $navbarDetached = 'navbar-detached';
    $container = $container ?? 'container';
@endphp

@section('layoutContent')
    <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
        <div class="layout-container">
            @if ($isMenu)
                @include('backEnd/layouts/sections/menu/verticalMenu')
            @endif

            <div class="layout-page">
                @if ($isNavbar)
                    @include('backEnd/layouts/sections/navbar/navbar')
                @endif


                <div class="content-wrapper">
                    @if ($isFlex)
                        <div class="{{ $container }} d-flex align-items-stretch flex-grow-1 p-0 shadow-detached">
                        @else
                            <div class="{{ $container }} flex-grow-1 container-p-y shadow-detached">
                    @endif


                    @yield('aboveContent')
                    @yield('content')
                </div>

                @if ($isFooter)
                    @include('backEnd/layouts/sections/footer/footer')
                @endif
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>

    @if ($isMenu)
        <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <div class="drag-target"></div>
    </div>
@endsection
