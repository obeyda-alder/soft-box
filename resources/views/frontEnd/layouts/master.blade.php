<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') ?? 'soft Box' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Crope - Multipurpose agency website" />
    <meta name="author" content="George_fx">
    <meta name="keywords" content="" />
    @include('frontEnd/layouts/sections/styles')
</head>

<body>
    @include('frontEnd/layouts/sections/loader/loader')

    @include('frontEnd/layouts/sections/left-sidebar/left-sidebar')

    <div class="wrapper">
        @include('frontEnd/layouts/sections/navbar/navbar')

        @include('frontEnd/layouts/sections/responsive/responsive')

        @yield('content')

        @include('frontEnd/layouts/sections/footer/footer')
    </div>
    <div class="clearfix"></div>

    @include('frontEnd/layouts/sections/scripts')
</body>

</html>
