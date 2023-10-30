@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.config.title'))

@section('content')
    <h1 class="fw-semibold">@lang('menu.config.title')</h1>
    <form method="POST" id="add_languages" onsubmit="OnSubmit(event, false);"
        action="{{ route('admin:config:add-languages') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="fw-semibold text-decoration-underline">@lang('site.fields.add_languages.title')</h3>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4">
                @include('_partials.input', [
                    '_id' => 'code',
                    'title' => __('site.fields.code.title'),
                    'placeholder' => __('site.fields.code.placeholder'),
                    'help' => __('site.fields.code.help'),
                    'icon' => 'bx bxs-pencil',
                    'input_type' => 'text',
                    'input_name' => 'code',
                ])
            </div>
            <div class="col-md-4">
                @include('_partials.input', [
                    '_id' => 'name',
                    'title' => __('site.fields.name.title'),
                    'placeholder' => __('site.fields.name.placeholder'),
                    'help' => __('site.fields.name.help'),
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

    <div class="row">
        @foreach (config('variables.config_site') as $key)
            <div class="col-md-4">
                <form method="POST" id="site_{{ $key }}" onsubmit="OnSubmit(event, false);"
                    action="{{ route('admin:config:add-config') }}" enctype="multipart/form-data">
                    @csrf
                    @php
                        $_config = $config->where('key', $key)->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check form-switch mb-2">
                                <input type="hidden" name="key" value="{{ $key }}">
                                <input class="form-check-input" onchange="$('#site_{{ $key }}').submit();"
                                    name="value" type="checkbox" id="{{ $key }}"
                                    {{ $_config && $_config->value == 'on' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}">@lang('site.fields.config.' . $key)</label>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- <hr> --}}
            </div>
        @endforeach
    </div>

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
                        'title' => __('site.fields.logo.title', [
                            'lang' => $locale,
                        ]),
                        'placeholder' => __('site.fields.logo.placeholder', [
                            'lang' => $locale,
                        ]),
                        'help' => __('site.fields.logo.help', ['lang' => $locale]),
                        'class' => 'file-upload-input-' . $locale,
                        'prifex' => $locale,
                        'src' => $logo->value ?? false,
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
