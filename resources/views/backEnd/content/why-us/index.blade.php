@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.why_us.title'))

@section('content')
    <form method="POST" id="form_" onsubmit="OnSubmit(event, false);" action="{{ route('admin:why-us:save') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-xl-12 col-md-12 element mb-3">
                <h6 class="text-muted">
                    <h1 class="fw-semibold fs-3">@lang('menu.why_us.title')</h1>
                </h6>

                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach (config('translatable.locales') as $locale => $locale_name)
                            <li class="nav-item">
                                <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" role="tab"
                                    data-bs-toggle="tab" data-bs-target="#navs-main-top-{{ $locale_name }}"
                                    aria-controls="navs-top-{{ $locale_name }}"
                                    aria-selected="true">{{ $locale_name }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach (config('translatable.locales') as $locale => $locale_name)
                            @php
                                $why_us = collect($us['why_us'])
                                    ->where('locale', $locale)
                                    ->first();
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="navs-main-top-{{ $locale_name }}" role="tabpanel">
                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'small_title_' . $locale,
                                        'title' => __('site.fields.small_title.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.small_title.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.small_title.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'small_title_' . $locale,
                                        'value' => $why_us['small_title'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'title_' . $locale,
                                        'title' => __('site.fields.title.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.title.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.title.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'title_' . $locale,
                                        'value' => $why_us['title'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'description_' . $locale,
                                        'title' => __('site.fields.description.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.description.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.description.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'description_' . $locale,
                                        'value' => $why_us['description'] ?? '',
                                    ])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            @for ($i = 0; $i < 2; $i++)
                <div class="col-md-6 element mb-3">
                    <h6 class="text-muted">
                        <h1 class="fw-semibold fs-3">@lang('site.fields.item.title')</h1>
                    </h6>

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach (config('translatable.locales') as $locale => $locale_name)
                                <li class="nav-item">
                                    <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-why-us-top-{{ $i }}-{{ $locale_name }}"
                                        aria-controls="navs-top-{{ $locale_name }}"
                                        aria-selected="true">{{ $locale_name }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach (config('translatable.locales') as $locale => $locale_name)
                                @php
                                    $data = [];
                                    $x = 0;
                                    for ($z = 0; $z < count($us['why_us_items']); $z++) {
                                        if ($us['why_us_items'][$z]->locale == $locale && $us['why_us_items'][$z]->type == 'ITEM') {
                                            $data['ITEM'][$x++][$locale] = $us['why_us_items'][$z];
                                        }
                                    }
                                @endphp

                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="navs-why-us-top-{{ $i }}-{{ $locale_name }}" role="tabpanel">

                                    <div class="m-2">
                                        @include('_partials.input', [
                                            '_id' => 'item_title_' . $locale,
                                            'title' => __('site.fields.item_title.title', ['lang' => $locale]),
                                            'placeholder' => __('site.fields.item_title.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.fields.item_title.help', ['lang' => $locale]),
                                            'icon' => 'bx bxs-chevron-right',
                                            'input_type' => 'text',
                                            'input_name' => 'item_title[' . $locale . '][]',
                                            'value' => $data['ITEM'][$i][$locale]['title'] ?? '',
                                        ])
                                    </div>

                                    <div class="m-2">
                                        @include('_partials.input', [
                                            '_id' => 'item_description_' . $locale,
                                            'title' => __('site.fields.item_description.title', [
                                                'lang' => $locale,
                                            ]),
                                            'placeholder' => __('site.fields.item_description.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.fields.item_description.help', ['lang' => $locale]),
                                            'icon' => 'bx bxs-chevron-right',
                                            'input_type' => 'text',
                                            'input_name' => 'item_description[' . $locale . '][]',
                                            'value' => $data['ITEM'][$i][$locale]['description'] ?? '',
                                        ])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endfor

            @for ($i = 0; $i < 4; $i++)
                <div class="col-md-6 element mb-3">
                    <h6 class="text-muted">
                        <h1 class="fw-semibold fs-3">@lang('site.fields.item_box.title')</h1>
                    </h6>

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach (config('translatable.locales') as $locale => $locale_name)
                                <li class="nav-item">
                                    <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-box-top-{{ $i }}-{{ $locale_name }}"
                                        aria-controls="navs-top-{{ $locale_name }}"
                                        aria-selected="true">{{ $locale_name }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach (config('translatable.locales') as $locale => $locale_name)
                                @php
                                    $data = [];
                                    $x = 0;
                                    for ($z = 0; $z < count($us['why_us_items']); $z++) {
                                        if ($us['why_us_items'][$z]->locale == $locale && $us['why_us_items'][$z]->type == 'BOX') {
                                            $data['BOX'][$x++][$locale] = $us['why_us_items'][$z];
                                        }
                                    }
                                @endphp

                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="navs-box-top-{{ $i }}-{{ $locale_name }}" role="tabpanel">

                                    <div class="m-2">
                                        @include('_partials.input', [
                                            '_id' => 'box_title_' . $locale,
                                            'title' => __('site.fields.box_title.title', [
                                                'lang' => $locale,
                                            ]),
                                            'placeholder' => __('site.fields.box_title.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.fields.box_title.help', [
                                                'lang' => $locale,
                                            ]),
                                            'icon' => 'bx bxs-chevron-right',
                                            'input_type' => 'text',
                                            'input_name' => 'box_title[' . $locale . '][]',
                                            'value' => $data['BOX'][$i][$locale]['title'] ?? '',
                                        ])
                                    </div>

                                    <div class="m-2">
                                        @include('_partials.input', [
                                            '_id' => 'box_box_number_' . $locale,
                                            'title' => __('site.fields.box_box_number.title', [
                                                'lang' => $locale,
                                            ]),
                                            'placeholder' => __('site.fields.box_box_number.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.fields.box_box_number.help', [
                                                'lang' => $locale,
                                            ]),
                                            'icon' => 'bx bxs-chevron-right',
                                            'input_type' => 'number',
                                            'input_name' => 'box_box_number[' . $locale . '][]',
                                            'value' => $data['BOX'][$i][$locale]['box_number'] ?? '',
                                        ])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endfor

        </div>
        <hr />
        <button type="button" onclick="$('#form_').submit();" class="btn btn-primary">@lang('admin.save')</button>
    </form>
@endsection

@section('page-style')
    <style>
        .element {
            padding: 10px 20px;
            border: 1px solid rgba(197, 197, 197, 0.5);
            border-radius: 6px;
        }

        .element .nav-align-top>.tab-content {
            box-shadow: unset !important
        }

        .col-md-6 {
            margin: auto;
            width: 49%;
        }
    </style>
@endsection
