<!DOCTYPE html>

<html class="light-style layout-menu-fixed" lang="{{ app()->getLocale() }}" data-theme="theme-default"
    data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{ url('/') }}" data-framework="laravel"
    data-template="vertical-menu">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title')</title>
    <meta name="description"
        content="{{ config('variables.metaDescription') ? config('variables.metaDescription') : '' }}" />
    <meta name="keywords" content="{{ config('variables.metaKeyword') ? config('variables.metaKeyword') : '' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    @include('backEnd/layouts/sections/styles')
    @include('backEnd/layouts/sections/scriptsIncludes')

</head>

<body>
    @yield('layoutContent')
    @include('backEnd/layouts/sections/scripts')
</body>

</html>
