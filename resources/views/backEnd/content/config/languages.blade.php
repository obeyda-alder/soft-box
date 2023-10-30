@extends('backEnd/layouts/navbarLayout')

@section('title', __('menu.languages.title'))

@section('content')
    @forelse($languages as $language)
        @if ($loop->first)
            <h1 class="fw-semibold">@lang('menu.languages.title')</h1>
        @endif
        <form method="POST" id="edit_languages_{{ $language->id }}" onsubmit="OnSubmit(event, false);"
            action="{{ route('admin:config:edit-languages') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $language->id }}">
            <div class="row justify-content-center align-items-center margin-left">
                <i class='bx bxs-minus-circle trash-lang' onclick="deleteLang({{ $language->id }})"></i>
                <div class="col-md-3">
                    @include('_partials.input', [
                        '_id' => 'code',
                        'title' => __('site.fields.code.title'),
                        'placeholder' => __('site.fields.code.placeholder'),
                        'help' => __('site.fields.code.help'),
                        'icon' => 'bx bxs-pencil',
                        'input_type' => 'text',
                        'input_name' => 'code',
                        'value' => $language->code,
                    ])
                </div>
                <div class="col-md-3">
                    @include('_partials.input', [
                        '_id' => 'name',
                        'title' => __('site.fields.name.title'),
                        'placeholder' => __('site.fields.name.placeholder'),
                        'help' => __('site.fields.name.help'),
                        'icon' => 'bx bxs-pencil',
                        'input_type' => 'text',
                        'input_name' => 'name',
                        'value' => $language->name,
                    ])
                </div>
                <div class="col-md-6 d-flex justify-content-start align-items-center">
                    <div class="col-md-2 my-0 form-check form-switch">
                        <input class="form-check-input" name="status" type="checkbox"
                            {{ $language->status ? 'checked' : '' }}>
                    </div>
                    <button type="submit" class="col-md-2 my-0 btn btn-primary">@lang('admin.edit')</button>
                </div>
            </div>
        </form>
    @empty
        <h1 class="fw-semibold text-center mt-5">@lang('admin.no_data')</h1>
    @endforelse
@endsection

@section('page-style')
    <style>
        .row {
            position: relative;
        }

        .margin-left {
            margin-left: 25px;
        }

        .trash-lang {
            background: red;
            color: #fff;
            border-radius: 10px;
            padding: 5px;
            cursor: pointer;
            position: absolute;
            width: 28px;
            left: -25px;
            bottom: 33px;
            transition: .3s ease-in;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .trash-lang:hover {
            box-shadow: 0 3px 5px -1px rgb(0 0 0 / 9%), 0 2px 3px -1px rgb(0 0 0 / 7%);
            transform: scale(1.1);
        }
    </style>
@endsection
@section('page-script')
    <script>
        function deleteLang(lang_id) {
            $.ajax({
                url: '{{ route('admin:config:delete-languages') }}',
                type: 'POST',
                data: {
                    lang_id: lang_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        $(`#edit_languages_${lang_id}`).css('display', 'none');
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
