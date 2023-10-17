@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.config.title'))

@section('content')
    <h1 class="fw-semibold">@lang('site.config.title')</h1>
    <form method="POST" id="add_languages" onsubmit="OnSubmit(event, false);"
        action="{{ route('admin:config:add-languages') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="fw-semibold text-decoration-underline">@lang('site.config.add_languages')</h3>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4">
                @include('_partials.input', [
                    '_id' => 'code',
                    'title' => __('site.config.code.title'),
                    'placeholder' => __('site.config.code.placeholder'),
                    'help' => __('site.config.code.help'),
                    'icon' => 'bx bxs-pencil',
                    'input_type' => 'text',
                    'input_name' => 'code',
                ])
            </div>
            <div class="col-md-4">
                @include('_partials.input', [
                    '_id' => 'name',
                    'title' => __('site.config.name.title'),
                    'placeholder' => __('site.config.name.placeholder'),
                    'help' => __('site.config.name.help'),
                    'icon' => 'bx bxs-pencil',
                    'input_type' => 'text',
                    'input_name' => 'name',
                ])
            </div>
            <div class="col-md-4">
                <button type="button" onclick="$('#add_languages').submit();"
                    class="btn btn-primary m-0">@lang('admin.add')</button>
            </div>
        </div>
    </form>
    <hr>
    <form method="POST" id="site_status" onsubmit="OnSubmit(event, false);" action="{{ route('admin:config:add-config') }}"
        enctype="multipart/form-data">
        @csrf
        @php
            $status = $config->where('key', 'status')->first();
        @endphp
        <h3 class="fw-semibold text-decoration-underline">@lang('site.config.site_status')</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check form-switch mb-2">
                    <input type="hidden" name="key" value="status">
                    <input class="form-check-input" onchange="$('#site_status').submit();" name="value" type="checkbox"
                        id="status" {{ $status && $status->value == 'on' ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">@lang('site.config.status')</label>
                </div>
            </div>
        </div>
    </form>



    <hr>
    <form method="POST" id="add_logo" onsubmit="OnSubmit(event, false);" action="{{ route('admin:config:add-config') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            @foreach (array_keys(config('translatable.locales')) as $locale)
                <input type="hidden" name="key[{{ $locale }}]" value="logo">
                <div class="col-md-6">
                    @php
                        $logo = collect($config)
                            ->where('key', 'logo_' . $locale)
                            ->first();
                    @endphp
                    @include('_partials.uploadImage', [
                        'id' => 'logo_' . $locale,
                        'name' => 'value[' . $locale . ']',
                        'title' => __('site.config.logo.title', [
                            'lang' => $locale,
                        ]),
                        'placeholder' => __('site.config.logo.placeholder', [
                            'lang' => $locale,
                        ]),
                        'help' => __('site.config.logo.help', ['lang' => $locale]),
                        'class' => 'file-upload-input-' . $locale,
                        'prifex' => $locale,
                        'src' => $logo->value,
                    ])
                </div>
            @endforeach
            <div class="col-md-12">
                <button type="button" onclick="$('#add_logo').submit();"
                    class="btn btn-primary m-0">@lang('admin.add')</button>
            </div>
        </div>
    </form>
@endsection
