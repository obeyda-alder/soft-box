@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.blogs.title'))

@section('content')
    <div class="blogs">
        <form method="POST" id="form_" onsubmit="OnSubmit(event, false);" action="{{ route('admin:blogs:save') }}"
            enctype="multipart/form-data">
            <div class="row">
                @csrf
                <div class="col-xl-12 col-md-12">
                    <h6 class="text-muted">
                        <h1 class="fw-semibold fs-3">@lang('menu.blogs.title')</h1>
                    </h6>

                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach (config('translatable.locales') as $locale => $locale_name)
                                <li class="nav-item">
                                    <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-{{ $locale_name }}"
                                        aria-controls="navs-top-{{ $locale_name }}"
                                        aria-selected="true">{{ $locale_name }}</button>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach (config('translatable.locales') as $locale => $locale_name)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="navs-top-{{ $locale_name }}" role="tabpanel">


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
                                        ])
                                    </div>

                                    <div class="m-2">
                                        @include('_partials.input', [
                                            '_id' => 'slug_' . $locale,
                                            'title' => __('site.fields.slug.title', [
                                                'lang' => $locale,
                                            ]),
                                            'placeholder' => __('site.fields.slug.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.fields.slug.help', [
                                                'lang' => $locale,
                                            ]),
                                            'icon' => 'bx bxs-chevron-right',
                                            'input_type' => 'text',
                                            'input_name' => 'slug_' . $locale,
                                        ])
                                    </div>

                                    <div class="m-2">
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label">@lang('site.fields.content.title', ['lang' => $locale])</label>
                                        <textarea class="form-control" name="content_{{ $locale }}" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>

                                    <div class="m-2">
                                        <label for="html5-datetime-local-input"
                                            class="col-md-2 col-form-label">@lang('site.fields.published_at.title', ['lang' => $locale])</label>
                                        <input class="form-control" name="published_at_{{ $locale }}"
                                            type="datetime-local" value="" id="html5-datetime-local-input" />
                                    </div>

                                    <div class="m-2">
                                        @include('_partials.input', [
                                            '_id' => 'excerpt_' . $locale,
                                            'title' => __('site.fields.excerpt.title', [
                                                'lang' => $locale,
                                            ]),
                                            'placeholder' => __('site.fields.excerpt.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.fields.excerpt.help', [
                                                'lang' => $locale,
                                            ]),
                                            'icon' => 'bx bxs-chevron-right',
                                            'input_type' => 'text',
                                            'input_name' => 'excerpt_' . $locale,
                                        ])
                                    </div>

                                    <div class="m-2">
                                        <label for="exampleFormControlSelect1" class="form-label">@lang('site.fields.status.title')</label>
                                        <select class="form-select" id="exampleFormControlSelect1"
                                            name="status_{{ $locale }}" aria-label="Default select">
                                            @foreach (['active', 'unactive'] as $status)
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        @include('_partials.uploadImage', [
                                            'id' => 'logo_' . $locale,
                                            'name' => 'logo_' . $locale,
                                            'title' => __('site.fields.logo.title', [
                                                'lang' => $locale,
                                            ]),
                                            'placeholder' => __('site.fields.logo.placeholder', [
                                                'lang' => $locale,
                                            ]),
                                            'help' => __('site.fields.logo.help', ['lang' => $locale]),
                                            'class' => 'file-upload-input-' . $locale,
                                            'prifex' => $locale,
                                        ])
                                    </div>

                                    <input type="hidden" name="author_{{ $locale }}"
                                        value="{{ auth()->user()->id }}">
                                </div>
                            @endforeach
                            <button type="button" onclick="$('#form_').submit();fetchData()"
                                class="btn btn-primary mt-5">@lang('admin.save')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
        function fetchData() {
            $.ajax({
                url: '{{ route('admin:blogs:data') }}',
                type: 'GET',
                data: {},
                success: function(response) {
                    let cards = '';
                    response.forEach(card => {
                        cards += ` <div class="col-sm-6 col-lg-4 mb-4">
                                          <div class="card">
                                              <img class="card-img-top" src="${card.logo}" alt="${card.content}" />
                                              <div class="card-body">
                                                <span class="card-locale">${card.locale}</span>
                                                  <h5 class="card-title">${card.title}</h5>
                                                  <p class="card-text">${card.content}</p>
                                                  <p class="card-text"><small class="text-muted">${card.excerpt}</small></p>
                                                  <i class='bx bxs-trash trash-card' onclick="deleteCard(${card.id})"></i>
                                              </div>
                                          </div>
                                      </div>`;
                    });
                    $('.cards').html(cards);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
        fetchData()

        function deleteCard(card_id) {
            $.ajax({
                url: '{{ route('admin:blogs:delete') }}',
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
