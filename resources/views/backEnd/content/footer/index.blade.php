@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.footer.title'))

@section('content')
    <form method="POST" id="form_" onsubmit="OnSubmit(event, false);" action="{{ route('admin:footer:save') }}"
        enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-xl-12 col-md-12">
                <h6 class="text-muted">
                    <h1 class="fw-semibold fs-3">@lang('menu.footer.title')</h1>
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
                                $data = collect($footer)
                                    ->where('locale', $locale)
                                    ->first();
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="navs-top-{{ $locale_name }}" role="tabpanel">
                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'copy_right_' . $locale,
                                        'title' => __('site.fields.copy_right.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.copy_right.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.copy_right.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'copy_right_' . $locale,
                                        'value' => $data['copy_right'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'phone_number_' . $locale,
                                        'title' => __('site.fields.phone_number.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.phone_number.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.phone_number.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'phone_number_' . $locale,
                                        'value' => $data['phone_number'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'working_hours_' . $locale,
                                        'title' => __('site.fields.working_hours.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.working_hours.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.working_hours.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'working_hours_' . $locale,
                                        'value' => $data['working_hours'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'address_' . $locale,
                                        'title' => __('site.fields.address.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.address.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.address.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'address_' . $locale,
                                        'value' => $data['address'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'email_' . $locale,
                                        'title' => __('site.fields.email.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.fields.email.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.fields.email.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'email',
                                        'input_name' => 'email_' . $locale,
                                        'value' => $data['email'] ?? '',
                                    ])
                                </div>
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
