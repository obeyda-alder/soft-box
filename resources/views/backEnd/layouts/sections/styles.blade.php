<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/boxicons.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/core.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/theme-default.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/demo.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/datatables.bootstrap.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/dashboard.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')) }}" />
@yield('vendor-style')
<style>
    .btn-primary {
        background-color: rgba(58, 65, 111, 0.95);
        display: flex;
        justify-content: center;
        align-items: center
    }

    .btn-primary:hover,
    .btn-primary:active,
    .btn-primary:focus {
        border: unset !important;
        box-shadow: unset !important;
        background-color: rgba(58, 65, 111, 1) !important;
    }
</style>
@yield('page-style')
