@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.header.title'))

@section('content')
    <div class="col-lg-4 col-md-6">
        <small class="fw-semibold fs-3">@lang('site.header.create_slide')</small>
        <div class="mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
                @lang('admin.create')
            </button>
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">@lang('site.header.create_slide')</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="form_" onsubmit="OnSubmit(event, false);"
                                action="{{ route('admin:header:save') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    @foreach (config('translatable.locales') as $locale => $locale_name)
                                        <div class="col-md-6">
                                            @include('_partials.uploadImage', [
                                                'id' => 'image_' . $locale,
                                                'name' => 'slid_image_' . $locale,
                                                'title' => __('site.header.logo.title', ['lang' => $locale]),
                                                'placeholder' => __('site.header.logo.placeholder', [
                                                    'lang' => $locale,
                                                ]),
                                                'help' => __('site.header.logo.help', ['lang' => $locale]),
                                                'class' => 'file-upload-input-' . $locale,
                                                'prifex' => $locale,
                                            ])
                                            <div class="m-2">
                                                @include('_partials.input', [
                                                    '_id' => 'slide_small_title_' . $locale,
                                                    'title' => __('site.header.slide_small_title.title', [
                                                        'lang' => $locale,
                                                    ]),
                                                    'placeholder' => __(
                                                        'site.header.slide_small_title.placeholder',
                                                        [
                                                            'lang' => $locale,
                                                        ]),
                                                    'help' => __('site.header.slide_small_title.help', [
                                                        'lang' => $locale,
                                                    ]),
                                                    'icon' => 'bx bxs-chevron-right',
                                                    'input_type' => 'text',
                                                    'input_name' => 'slide_small_title_' . $locale,
                                                ])
                                            </div>

                                            <div class="m-2">
                                                @include('_partials.input', [
                                                    '_id' => 'slide_title_' . $locale,
                                                    'title' => __('site.header.slide_title.title', [
                                                        'lang' => $locale,
                                                    ]),
                                                    'placeholder' => __('site.header.slide_title.placeholder', [
                                                        'lang' => $locale,
                                                    ]),
                                                    'help' => __('site.header.slide_title.help', [
                                                        'lang' => $locale,
                                                    ]),
                                                    'icon' => 'bx bxs-chevron-right',
                                                    'input_type' => 'text',
                                                    'input_name' => 'slide_title_' . $locale,
                                                ])
                                            </div>

                                            <div class="m-2">
                                                @include('_partials.input', [
                                                    '_id' => 'slide_description_' . $locale,
                                                    'title' => __('site.header.slide_description.title', [
                                                        'lang' => $locale,
                                                    ]),
                                                    'placeholder' => __(
                                                        'site.header.slide_description.placeholder',
                                                        [
                                                            'lang' => $locale,
                                                        ]),
                                                    'help' => __('site.header.slide_description.help', [
                                                        'lang' => $locale,
                                                    ]),
                                                    'icon' => 'bx bxs-chevron-right',
                                                    'input_type' => 'text',
                                                    'input_name' => 'slide_description_' . $locale,
                                                ])
                                            </div>
                                            <hr />
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">@lang('admin.close')</button>
                            <button type="button"
                                onclick="$('#form_').submit(); $('#modalCenter').modal('hide');fetchData()"
                                class="btn btn-primary">@lang('admin.save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="cards"></div>

@endsection

@section('page-style')
    <style>
        .text-lang {
            color: #d6d6d6 !important;
            padding: -1px 6px;
            font-size: 29px;
            text-decoration: underline;
        }

        .cards {
            position: relative;
        }

        .text-color {
            color: #000
        }

        .ex-style {
            border: 0.2px solid #F1EFEF;
            box-shadow: rgb(0 0 0 / 10%) 0px 4px 12px;
            max-height: 300px;
            min-height: 300px;
            height: 300px;
        }

        .card-img-overlay {
            background-color: #b1b1b185;
            transition: .2s all ease-in;
        }

        .cards .trash-card {
            position: absolute;
            right: 25px;
            bottom: 13px;
            background: #ff0000c4;
            color: #fff;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            cursor: pointer;
            opacity: 0;
            transition: .2s all ease-in;
        }

        .cards:hover .card-img-overlay {
            background-color: #F1EFEF
        }

        .cards:hover .trash-card {
            opacity: 1;
        }
    </style>
@endsection

@section('page-script')
    <script>
        fetchData();

        function fetchData() {
            $.ajax({
                url: '{{ route('admin:header:fetch_data') }}',
                type: 'GET',
                data: {},
                success: function(response) {
                    let html = ''
                    response.forEach(card => {
                        html += ` <div class="col-md-3 my-2 cards">
                                    <div class="card bg-dark border-0 text-color">
                                        <img class="card-img ex-style" src="${card['logo']}" alt="${card['small_title']}" />
                                        <div class="card-img-overlay">
                                            <p class="card-text">${card['small_title']}</p>
                                            <h5 class="card-title text-color">${card['title']}</h5>
                                            <p class="card-text">${card['description']}</p>
                                        </div>
                                    </div>
                                    <i class='bx bxs-trash trash-card' onclick="deleteCard(${card['id']})"></i>
                                </div>`;
                    });
                    $('#cards').html(html)
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function deleteCard(card_id) {
            $.ajax({
                url: '{{ route('admin:header:delete') }}',
                type: 'POST',
                data: {
                    card_id: card_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response['success']) {
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
