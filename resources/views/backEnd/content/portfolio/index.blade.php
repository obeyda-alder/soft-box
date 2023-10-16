@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.portfolio.title'))

@section('content')
    <form method="POST" id="form_" onsubmit="OnSubmit(event, false);" action="{{ route('admin:portfolio:save-section') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-12 col-md-12 element mb-3">
                <h6 class="text-muted">
                    <h1 class="fw-semibold fs-3">@lang('site.portfolios.details')</h1>
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
                                $portfolio = collect($portfolios['portfolios'])
                                    ->where('locale', $locale)
                                    ->first();
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="navs-main-top-{{ $locale_name }}" role="tabpanel">
                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'small_title_' . $locale,
                                        'title' => __('site.portfolios.small_title.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.portfolios.small_title.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.portfolios.small_title.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'small_title_' . $locale,
                                        'value' => $portfolio['small_title'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'title_' . $locale,
                                        'title' => __('site.portfolios.title.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.portfolios.title.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.portfolios.title.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'title_' . $locale,
                                        'value' => $portfolio['title'] ?? '',
                                    ])
                                </div>

                                <div class="m-2">
                                    @include('_partials.input', [
                                        '_id' => 'description_' . $locale,
                                        'title' => __('site.portfolios.description.title', [
                                            'lang' => $locale,
                                        ]),
                                        'placeholder' => __('site.portfolios.description.placeholder', [
                                            'lang' => $locale,
                                        ]),
                                        'help' => __('site.portfolios.description.help', [
                                            'lang' => $locale,
                                        ]),
                                        'icon' => 'bx bxs-chevron-right',
                                        'input_type' => 'text',
                                        'input_name' => 'description_' . $locale,
                                        'value' => $portfolio['description'] ?? '',
                                    ])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <button type="button" onclick="$('#form_').submit();" class="btn btn-primary">@lang('admin.save')</button>
    </form>

    <div class="row">
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exLargeModal">
                @lang('site.portfolios.add_tab')
            </button>
        </div>

        <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4">@lang('site.portfolios.tab_title')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tab-form" onsubmit="OnSubmit(event, false);" method="POST"
                            action="{{ route('admin:portfolio:save-tab') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                @foreach (array_keys(config('translatable.locales')) as $locale)
                                    <div class="col-md-6">
                                        @include('_partials.uploadImage', [
                                            'id' => 'tab_image_' . $locale,
                                            'name' => 'tab_image_' . $locale,
                                            'title' => __('site.portfolios.tab_image.title', [
                                                'lang' => $locale,
                                            ]),
                                            'placeholder' => __('site.portfolios.tab_image.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.portfolios.logo.help', ['lang' => $locale]),
                                            'class' => 'file-upload-input-' . $locale,
                                            'prifex' => $locale,
                                        ])

                                        <div class="m-2">
                                            @include('_partials.input', [
                                                '_id' => 'tab_title_' . $locale,
                                                'title' => __('site.portfolios.tab_title.title', [
                                                    'lang' => $locale,
                                                ]),
                                                'placeholder' => __('site.portfolios.tab_title.placeholder', [
                                                    'lang' => $locale,
                                                ]),
                                                'help' => __('site.portfolios.tab_title.help', [
                                                    'lang' => $locale,
                                                ]),
                                                'icon' => 'bx bxs-chevron-right',
                                                'input_type' => 'text',
                                                'input_name' => 'tab_title_' . $locale,
                                            ])
                                        </div>

                                        <div class="m-2">
                                            @include('_partials.input', [
                                                '_id' => 'tab_name_' . $locale,
                                                'title' => __('site.portfolios.tab_name.title', [
                                                    'lang' => $locale,
                                                ]),
                                                'placeholder' => __('site.portfolios.tab_name.placeholder', [
                                                    'lang' => $locale,
                                                ]),
                                                'help' => __('site.portfolios.tab_name.help', [
                                                    'lang' => $locale,
                                                ]),
                                                'icon' => 'bx bxs-chevron-right',
                                                'input_type' => 'text',
                                                'input_name' => 'tab_name_' . $locale,
                                            ])
                                        </div>

                                        <div class="m-2">
                                            @include('_partials.input', [
                                                '_id' => 'tab_description_' . $locale,
                                                'title' => __('site.portfolios.tab_description.title', [
                                                    'lang' => $locale,
                                                ]),
                                                'placeholder' => __(
                                                    'site.portfolios.tab_description.placeholder',
                                                    [
                                                        'lang' => $locale,
                                                    ]),
                                                'help' => __('site.portfolios.tab_description.help', [
                                                    'lang' => $locale,
                                                ]),
                                                'icon' => 'bx bxs-chevron-right',
                                                'input_type' => 'text',
                                                'input_name' => 'tab_description_' . $locale,
                                            ])
                                        </div>
                                        @if (!$loop->last)
                                            <hr>
                                        @endif
                                    </div>
                                @endforeach
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">@lang('admin.close')</button>
                    <button type="button" onclick="$('#tab-form').submit();fetchData(true)"
                        class="btn btn-primary">@lang('admin.save')</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row cards"></div>
    </div>
@endsection

@section('page-style')
    <style>
        .cards .card {
            height: 400px;
            max-height: 400px;
            min-height: 400px;
            overflow: hidden;
        }

        .cards .card img {
            height: 250px;
        }

        .cards .card .trash-card {
            position: absolute;
            bottom: 20px;
            right: 25px;
            background: red;
            padding: 8px;
            color: #fff;
            border-radius: 7px;
            opacity: 0.57;
            cursor: pointer;
            transition: .3s all ease-in
        }

        .cards .card .card-locale {
            position: absolute;
            top: 0px;
            right: 0;
            background: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%);
            color: #fff;
            border-radius: 0 15px 0 15px;
            width: 38px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }

        .cards .card .trash-card:hover {
            opacity: 1;
        }
    </style>
@endsection
@section('page-script')
    <script>
        function clearInput() {
            const langs = {!! json_encode(array_keys(config('translatable.locales'))) !!}
            langs.forEach(lang => {
                $('.image-upload-wrap').css('display', 'flex');
                $('.file-upload-content').css('display', 'none');
                $(`#tab-form input[name="tab_image_${lang}"]`).removeAttr('src');
                $(`#tab-form input[name="tab_title_${lang}"]`).val('');
                $(`#tab-form input[name="tab_name_${lang}"]`).val('');
                $(`#tab-form input[name="tab_description_${lang}"]`).val('');
            });
            $('#exLargeModal').modal('hide');
        }
        fetchData(false)

        function fetchData(sumbit) {
            if (sumbit) {
                clearInput();
            }

            $.ajax({
                url: '{{ route('admin:portfolio:fetch_data') }}',
                type: 'GET',
                data: {},
                success: function(response) {
                    let cards = '';
                    response.forEach(card => {
                        cards += ` <div class="col-sm-6 col-lg-4 mb-4">
                                          <div class="card">
                                              <img class="card-img-top" src="${card.image}" alt="${card.tab_name}" />
                                              <div class="card-body">
                                                <span class="card-locale">${card.locale}</span>
                                                  <h5 class="card-title">${card.title}</h5>
                                                  <p class="card-text">${card.description}</p>
                                                  <p class="card-text"><small class="text-muted">${card.tab_name}</small></p>
                                                  <i class='bx bxs-trash trash-card' onclick="deleteCard(${card.id})"></i>
                                              </div>
                                          </div>
                                      </div>`;
                        console.log(card);
                    });
                    $('.cards').html(cards);
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function deleteCard(card_id) {
            $.ajax({
                url: '{{ route('admin:portfolio:delete') }}',
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
