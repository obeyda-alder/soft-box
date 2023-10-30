@extends('frontEnd/layouts/master')

@section('content')
    @if ($data['siteConfig'])
        @if (isset($data['siteConfig']['header']) && $data['siteConfig']['header'] == 'on')
            @include('frontEnd/content/header/index')
        @endif

        @if (isset($data['siteConfig']['about_us']) && $data['siteConfig']['about_us'] == 'on')
            @include('frontEnd/content/about-us/index')
        @endif
        @if (isset($data['siteConfig']['our_services']) && $data['siteConfig']['our_services'] == 'on')
            @include('frontEnd/content/our-services/index')
        @endif
        @if (isset($data['siteConfig']['contact_us']) && $data['siteConfig']['contact_us'] == 'on')
            @include('frontEnd/content/contact/index')
        @endif

        @if (isset($data['siteConfig']['why_us']) && $data['siteConfig']['why_us'] == 'on')
            @include('frontEnd/content/why-us/index')
        @endif
        @if (isset($data['siteConfig']['portfolio']) && $data['siteConfig']['portfolio'] == 'on')
            @include('frontEnd/content/portfolio/index')
        @endif
        @if (isset($data['siteConfig']['latest_in_crope']) && $data['siteConfig']['latest_in_crope'] == 'on')
            @include('frontEnd/content/latest-in-crope/index')
        @endif
    @endif
@endsection
