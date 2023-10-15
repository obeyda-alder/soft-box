@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.our_services.title'))

@section('content')
    <form method="POST" id="form_" onsubmit="OnSubmit(event, false);" action="{{ route('admin:our-services:save') }}"
        enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-xl-12 col-md-12">
                <h6 class="text-muted">
                    <h1 class="fw-semibold fs-3">@lang('site.our_services.details')</h1>
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
                                $data = collect($services['our_services'])
                                    ->where('locale', $locale)
                                    ->first();
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="navs-top-{{ $locale_name }}" role="tabpanel">
                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'small_title_' . $locale,
                                        'title' => __('site.our_services.small_title.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.our_services.small_title.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.our_services.small_title.help', [
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
                                        'title' => __('site.our_services.title.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.our_services.title.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.our_services.title.help', [
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
                                        'title' => __('site.our_services.description.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.our_services.description.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.our_services.description.help', [
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
        </div>
        <hr />

        <div class="row our_services_sliders">
            <h1> @lang('site.our_services.create_sliders')</h1>
            <div class="col-md-12 mb-2">
                <div class="col-md-4">
                    <button type="button" onclick="addMoreSliders()" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalCenter">
                        @lang('site.our_services.create_sliders')
                    </button>
                </div>
            </div>

            <div class="to-clone-element"></div>
        </div>

        <button type="button" onclick="$('#form_').submit();fetchData()"
            class="btn btn-primary mt-5">@lang('admin.save')</button>
        </div>
    </form>
@endsection

@section('page-style')
    <style>
        .our_services_sliders .image-upload-wrap {
            border: 2px solid #21abfe;
            position: relative;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto
        }

        .our_services_sliders .to-clone-element {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .our_services_sliders .drag-text h3 {
            font-weight: 300;
            text-transform: uppercase;
            color: #21abfe;
            padding: 10px 0;
            transition: all .2s ease;
            font-size: 14px
        }

        .our_services_sliders .file-upload-content {
            display: none;
            text-align: center;
            width: 150px;
            padding: 0;
            margin: auto;
            background-color: #21abfe;
            border: 4px dashed #ffffff;
            border-radius: 50%;
            overflow: hidden;
        }

        .our_services_sliders .file-upload-image {
            margin: auto;
            width: 150px;
            min-height: 150px;
            max-height: 150px;
            height: 150px;
            padding: 0;
            margin: auto;
            border-radius: 50%;
        }

        .our_services_sliders .image-title-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 75px;
            margin: auto
        }

        .our_services_sliders .file-upload-btn {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .our_services_sliders .input-group {
            width: 250px;
            margin: auto;
        }

        .our_services_sliders .cards {
            border-radius: 15px;
            border: 1px solid;
            position: relative;
            margin: 0 15px 30px;
        }

        .our_services_sliders .cards .trash-card {
            position: absolute;
            top: 0px;
            background: #ff0000c4;
            color: #fff;
            border-radius: 15px 0 15px 0;
            width: 38px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            cursor: pointer;
            opacity: 0;
            transition: .2s all ease-in;
        }

        .our_services_sliders .cards:hover .card-img-overlay {
            background-color: #F1EFEF
        }

        .our_services_sliders .cards:hover .trash-card {
            opacity: 1;
        }
    </style>
@endsection

@section('page-script')
    <script>
        function addMoreSliders() {
            const randomString = Math.random().toString(35).substring(2, 14);
            const SelectClone = document.querySelector('.to-clone-element');
            SelectClone.insertAdjacentHTML('afterend', `
                        @foreach (config('translatable.locales') as $locale => $locale_name)
                            <div class="col-md-3 text-center cards">
                                @include('_partials.uploadImage', [
                                    'id' => 'logo_slider_' . $locale,
                                    'name' => 'logo_slider[' . $locale . '][]',
                                    'title' => __('site.our_services.logo.title', ['lang' => $locale]),
                                    'placeholder' => __('site.our_services.logo.placeholder', ['lang' => $locale]),
                                    // 'help' => __('site.our_services.logo.help', ['lang' => $locale]),
                                    'class' => 'file-upload-input-' . $locale,
                                    'prifex' => '${randomString}-' . $locale,
                                ])

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'slide_title_' . $locale,
                                        'title' => __('site.our_services.slide_title.title', ['lang' => $locale]),
                                        'placeholder' => __('site.our_services.slide_title.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.our_services.slide_title.help', ['lang' => $locale]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'slide_title[' . $locale . '][]',
                                    ])
                                </div>
                            </div>
                        @endforeach`);
        }

        fetchData();

        function fetchData() {
            $.ajax({
                url: '{{ route('admin:our-services:fetch_data') }}',
                type: 'GET',
                data: {},
                success: function(response) {
                    console.log(response);
                    if (response.length > 0) {
                        getData(response);
                    } else {
                        addMoreSliders()
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function getData(data) {
            const container = document.querySelector('.to-clone-element');
            data.forEach(slid => {
                const randomString = Math.random().toString(35).substring(2, 14);
                const locale = slid.locale;
                const title = slid.title;
                const logo = slid.logo;

                const uploadImageHTML = `@include('_partials.uploadImage', [
                    'id' => 'logo_slider_' . '${locale}',
                    'name' => 'logo_slider[' . '${locale}' . '][]',
                    'title' => __('site.our_services.logo.title', ['lang' => '${locale}']),
                    'placeholder' => __('site.our_services.logo.placeholder', [
                        'lang' => '${locale}',
                    ]),
                    // 'help' => __('site.our_services.logo.help', ['lang' => '${locale}']),
                    'class' => 'file-upload-input-' . '${locale}',
                    'prifex' => '${randomString}-' . '${locale}',
                    'src' => '',
                ])`;

                const inputHTML = `@include('_partials.input', [
                    '_id' => 'slide_title_' . '${locale}',
                    'title' => __('site.our_services.slide_title.title', [
                        'lang' => '${locale}',
                    ]),
                    'placeholder' => __('site.our_services.slide_title.placeholder', [
                        'lang' => '${locale}',
                    ]),
                    'help' => __('site.our_services.slide_title.help', [
                        'lang' => '${locale}',
                    ]),
                    'icon' => 'bx bxs-chevron-right',
                    'input_type' => 'text',
                    'input_name' => 'slide_title[' . '${locale}' . '][]',
                    'value' => '${title}',
                ])`;

                const columnHTML = `<div class="col-md-3 text-center cards">
                                    <i class='bx bxs-trash trash-card' onclick="deleteCard(${slid.id})"></i>
                                        ${uploadImageHTML}
                                        <div class="m-2">${inputHTML}</div>
                                    </div>`;

                container.insertAdjacentHTML('afterbegin', columnHTML);

                $(`.file-upload-image-${randomString}-${locale}`).attr('src', logo);

                $('.image-upload-wrap').hide();
                $('.file-upload-content').show();
                $('.remove-image').show();
                $('.file-upload-btn').html('{!! __('base.edit_image') !!}');
            });
        }

        function deleteCard(card_id) {
            $.ajax({
                url: '{{ route('admin:our-services:delete') }}',
                type: 'POST',
                data: {
                    card_id: card_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response['success']) {
                        $('.to-clone-element').html(``);
                        fetchData();
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
