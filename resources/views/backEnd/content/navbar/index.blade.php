@extends('backEnd/layouts/navbarLayout')

@section('title', __('site.navbar.title'))

@section('content')
    <h4 class="fw-bold py-3 mb-4">@lang('site.navbar.title')</h4>

    <form method="POST" onsubmit="OnSubmit(event, false);" action="{{ route('admin:navbar:return_and_update_navbar') }}"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            @foreach (array_keys(config('translatable.locales')) as $locale)
                @php
                    $navBarData = collect($navbar)
                        ->where('locale', $locale)
                        ->first();
                @endphp

                <div class="col-md-6">
                    @include('_partials.uploadImage', [
                        'id' => 'logo_' . $locale,
                        'name' => 'logo_' . $locale,
                        'title' => __('site.navbar.logo.title', ['lang' => $locale]),
                        'placeholder' => __('site.navbar.logo.placeholder', ['lang' => $locale]),
                        'help' => __('site.navbar.logo.help', ['lang' => $locale]),
                        'class' => 'file-upload-input-' . $locale,
                        'prifex' => $locale,
                        'src' => $navBarData['logo'] ?? '',
                    ])

                    <div class="m-2">
                        @include('_partials.input', [
                            '_id' => 'key_contact_' . $locale,
                            'title' => __('site.navbar.key_contact.title', ['lang' => $locale]),
                            'placeholder' => __('site.navbar.key_contact.placeholder', ['lang' => $locale]),
                            'help' => __('site.navbar.key_contact.help', ['lang' => $locale]),
                            'icon' => 'bx bx-phone',
                            'input_type' => 'text',
                            'input_name' => 'key_contact_' . $locale,
                            'value' => $navBarData['key_contact'] ?? '',
                        ])
                    </div>

                    <div class="m-2">
                        @include('_partials.input', [
                            '_id' => 'phone_number_' . $locale,
                            'title' => __('site.navbar.phone_number.title', ['lang' => $locale]),
                            'placeholder' => __('site.navbar.phone_number.placeholder', ['lang' => $locale]),
                            'help' => __('site.navbar.phone_number.help', ['lang' => $locale]),
                            'icon' => 'bx bx-navigation',
                            'input_type' => 'text',
                            'input_name' => 'phone_number_' . $locale,
                            'value' => $navBarData['phone_number'] ?? '',
                        ])
                    </div>
                </div>
            @endforeach

            <hr class="mt-4" />
            <div class="col-md-12 items__">
                <small class="text-light fw-semibold">@lang('admin.create_items')</small>
                <div class="demo-inline-spacing">
                    <button type="button" onclick="addItem({{ json_encode(array_keys(config('translatable.locales'))) }})"
                        class="btn btn-primary">
                        @lang('admin.items')
                        <span class="badge bg-white text-primary margin-left" id="items_count">0</span>
                    </button>
                </div>
            </div>

            <hr class="mt-4" />
            <button type="submit" class="btn btn-primary w-75 m-auto">@lang('admin.send')</button>
        </div>
    </form>
@endsection

@section('page-style')
    <style>
        .order-input {
            width: 100% !important;
            max-width: 70px !important;
            border: 1px solid #ddd !important;
            padding: 4px 20px !important;
        }

        .margin-left {
            margin-left: 8px
        }
    </style>
@endsection

@section('page-script')
    <script>
        let count = 0;

        const navBarItem = {!! json_encode($navbarItem) !!};
        var locales = {!! json_encode(array_keys(config('translatable.locales'))) !!};
        if (navBarItem.length > 0) {
            let template = '';
            navBarItem.forEach(nav => {
                template += `<div class="col-md-6">
                              <label class="form-label" for="basic-icon-default-email">{{ __('site.navbar.item_title_.title', ['lang' => ' + ${nav.locale} + ', 'count' => ' + count + ']) }}</label>
                                <div class="input-group input-group-merge">
                                  <span class="input-group-text"><i class="bx bx-sitemap"></i></span>
                                  <input type="text" name="item_title_${nav.locale}[]" id="${nav.id}" class="form-control"
                                  placeholder="{{ __('site.navbar.item_title_.placeholder', ['lang' => ' + ${nav.locale} + ', 'count' => ' + count + ']) }}" value="${nav.title}" />
                                  <input class="form-control order-input" type="number" name="order[]" value="${nav.order}" />
                                </div>
                                <div class="form-text">{{ __('site.navbar.item_title_.help', ['lang' => ' + ${nav.locale} + ', 'count' => ' + count + ']) }}</div>
                              </div>`
            });
            const targetElement = document.querySelector('.items__');
            targetElement.insertAdjacentHTML('afterend', template);
            $('#items_count').text(navBarItem.length / locales.length);
            count = navBarItem.length / locales.length
        }

        async function addItem(locales) {
            if (count < 5) {
                count = count + 1;
                try {
                    let responses = await Promise.all(locales.map(locale => loadPartial(locale, count)));

                    let templates = responses.map(response => `<div class="col-md-6">${response}</div>`);
                    let template = templates.join('');

                    const targetElement = document.querySelector('.items__');
                    targetElement.insertAdjacentHTML('afterend', template);
                    $('#items_count').text(count);
                } catch (error) {
                    console.error('Error loading the view.', error);
                }
            }
        }

        function loadPartial(locale, count) {
            var url = $('.target-element').data('url');
            var _id = `item_title_${locale}`;
            var title = '{{ __('site.navbar.item_title_.title', ['lang' => ' + locale + ', 'count' => ' + count + ']) }}';
            var placeholder =
                '{{ __('site.navbar.item_title_.placeholder', ['lang' => ' + locale + ', 'count' => ' + count + ']) }}';
            var help = '{{ __('site.navbar.item_title_.help', ['lang' => ' + locale + ', 'count' => ' + count + ']) }}';


            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: '{{ route('admin:load_partial') }}',
                    type: 'GET',
                    data: {
                        _id: _id,
                        title: title,
                        placeholder: placeholder,
                        help: help,
                        icon: 'bx bx-sitemap',
                        input_type: 'text',
                        input_name: `item_title_${locale}[]`,
                        type: 'input',
                        has_count: true,
                        count_name: 'order[]',
                        count_value: 0
                    },
                    success: function(response) {
                        resolve(response.html);
                    },
                    error: function(error) {
                        reject(error);
                    }
                });
            });
        }
    </script>
@endsection
