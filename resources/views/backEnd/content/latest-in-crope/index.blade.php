@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.latest_in_crope.title'))

@section('content')
    <form method="POST" id="form_" onsubmit="OnSubmit(event, false);" action="{{ route('admin:latest-in-crope:save') }}"
        enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-xl-12 col-md-12">
                <h6 class="text-muted">
                    <h1 class="fw-semibold fs-3">@lang('menu.latest_in_crope.title')</h1>
                </h6>

                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach (config('translatable.locales') as $locale => $locale_name)
                            <li class="nav-item">
                                <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" role="tab"
                                    data-bs-toggle="tab" data-bs-target="#navs-top-{{ $locale_name }}"
                                    aria-controls="navs-top-{{ $locale_name }}"
                                    aria-selected="true">{{ $locale_name }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach (config('translatable.locales') as $locale => $locale_name)
                            @php
                                $data = collect($latest_in_crope)
                                    ->where('locale', $locale)
                                    ->first();
                            @endphp

                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="navs-top-{{ $locale_name }}" role="tabpanel">

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
                                        'value' => $data['small_title'] ?? '',
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
                                        'value' => $data['title'] ?? '',
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
                                        'value' => $data['description'] ?? '',
                                    ])
                                </div>
                                <input type="hidden" name="author_{{ $locale }}" value="{{ auth()->user()->id }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr />

        <button type="button" onclick="$('#form_').submit();" class="btn btn-primary mt-5">@lang('admin.save')</button>
        </div>
    </form>
@endsection
