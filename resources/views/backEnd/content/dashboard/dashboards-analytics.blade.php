@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.dashboard'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="row d-flex justify-content-around align-items-center">
        @foreach ($analytics as $name => $analytic)
            <div class="col-lg-3 col-md-4 order-1 m-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-2"><i class="tf-icons  {{ __('admin.model_name.' . $name . '.icon') }}"></i>
                            {{ __('admin.model_name.' . $name . '.title') }}</h4>
                        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                            @if (is_array($analytic))
                                @foreach ($analytic as $key => $item)
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-justified-home"
                                            aria-controls="navs-pills-justified-home" aria-selected="true">
                                            {{ $key }} <span
                                                class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ $item }}</span></button>
                                    </li>
                                @endforeach
                            @else
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-home"
                                        aria-controls="navs-pills-justified-home" aria-selected="true">
                                        <span
                                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ $analytic }}</span></button>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('page-style')
    <style>
        .items {
            display: inline-table;
        }

        .nav-item {
            margin: 10px;
            width: min-content;
        }

        .nav-item span {
            display: inline-flex !important;
            justify-content: center;
            align-items: center
        }
    </style>
@endsection
