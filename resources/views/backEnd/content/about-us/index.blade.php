@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.about_us.title'))

@section('content')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="fw-semibold fs-3">@lang('menu.about_us.title')</h1>
            <form method="POST" id="form_" onsubmit="OnSubmit(event, false);" action="{{ route('admin:about-us:save') }}"
                enctype="multipart/form-data">
                @csrf
                @foreach (config('translatable.locales') as $locale => $locale_name)
                    @php
                        $data = collect($about_us)
                            ->where('locale', $locale)
                            ->first();
                    @endphp
                    <div class="col-md-12">
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
                                '_id' => 'small_description_' . $locale,
                                'title' => __('site.fields.small_description.title', [
                                    'lang' => $locale,
                                ]),
                                'placeholder' => __('site.fields.small_description.placeholder', [
                                    'lang' => $locale,
                                ]),
                                'help' => __('site.fields.small_description.help', [
                                    'lang' => $locale,
                                ]),
                                'icon' => 'bx bxs-chevron-right',
                                'input_type' => 'text',
                                'input_name' => 'small_description_' . $locale,
                                'value' => $data['small_description'] ?? '',
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
                    <hr>
                @endforeach
                <button type="button" onclick="$('#form_').submit(); $('#modalCenter').modal('hide');fetchData()"
                    class="btn btn-primary">@lang('admin.save')</button>
            </form>
        </div>
    </div>
@endsection
