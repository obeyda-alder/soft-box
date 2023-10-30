@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.news_letter.title'))

@section('content')
    <form method="POST" onsubmit="OnSubmit(event, false);" action="{{ route('admin:news-letter:save') }}"
        enctype="multipart/form-data">
        @csrf

        <div class="col-xl-12 col-md-12 element mb-3">
            <h6 class="text-muted">
                <h1 class="fw-semibold fs-3">@lang('menu.news_letter.title')</h1>
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
                            $data = collect($news_letter)
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            @foreach (array_keys(config('translatable.locales')) as $locale)
                @php
                    $data = collect($news_letter)
                        ->where('locale', $locale)
                        ->first();
                @endphp
                <div class="col-md-4">
                    @include('_partials.uploadImage', [
                        'id' => 'manager_logo_' . $locale,
                        'name' => 'manager_logo_' . $locale,
                        'title' => __('site.fields.manager_logo.title', ['lang' => $locale]),
                        'placeholder' => __('site.fields.manager_logo.placeholder', ['lang' => $locale]),
                        'help' => __('site.fields.manager_logo.help', ['lang' => $locale]),
                        'class' => 'file-upload-input-' . $locale,
                        'prifex' => $locale,
                        'src' => $data['manager_logo'] ?? '',
                    ])

                    <div class="m-2">
                        @include('_partials.input', [
                            '_id' => 'manager_name_' . $locale,
                            'title' => __('site.fields.manager_name.title', ['lang' => $locale]),
                            'placeholder' => __('site.fields.manager_name.placeholder', ['lang' => $locale]),
                            'help' => __('site.fields.manager_name.help', ['lang' => $locale]),
                            'icon' => 'bx bxs-chevron-right',
                            'input_type' => 'text',
                            'input_name' => 'manager_name_' . $locale,
                            'value' => $data['manager_name'] ?? '',
                        ])
                    </div>

                    <div class="m-2">
                        @include('_partials.input', [
                            '_id' => 'info_manage_' . $locale,
                            'title' => __('site.fields.info_manage.title', ['lang' => $locale]),
                            'placeholder' => __('site.fields.info_manage.placeholder', ['lang' => $locale]),
                            'help' => __('site.fields.info_manage.help', ['lang' => $locale]),
                            'icon' => 'bx bxs-chevron-right',
                            'input_type' => 'text',
                            'input_name' => 'info_manage_' . $locale,
                            'value' => $data['info_manage'] ?? '',
                        ])
                    </div>

                    <div class="m-2">
                        @include('_partials.input', [
                            '_id' => 'description_of_the_manager_' . $locale,
                            'title' => __('site.fields.description_of_the_manager.title', [
                                'lang' => $locale,
                            ]),
                            'placeholder' => __('site.fields.description_of_the_manager.placeholder', [
                                'lang' => $locale,
                            ]),
                            'help' => __('site.fields.description_of_the_manager.help', ['lang' => $locale]),
                            'icon' => 'bx bxs-chevron-right',
                            'input_type' => 'text',
                            'input_name' => 'description_of_the_manager_' . $locale,
                            'value' => $data['description_of_the_manager'] ?? '',
                        ])
                    </div>
                </div>
            @endforeach

            <hr class="mt-4" />
            <button type="submit" class="btn btn-primary w-75 m-auto">@lang('admin.send')</button>
        </div>
    </form>
@endsection
