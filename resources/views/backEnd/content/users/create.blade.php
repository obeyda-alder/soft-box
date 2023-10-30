@extends('backEnd/layouts/navbarLayout')

@empty($type)
    @section('title', __('menu.users.create'))
@else
@section('title', __('menu.users.' . $type))
@endempty

@section('content')
<h4 class="fw-bold py-3">@lang('admin.users.create.' . strtolower($type))</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" onsubmit="OnSubmit(event, false);" action="{{ route('admin:users:store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="type" value="{{ $type }}">

                    @include('_partials.input', [
                        '_id' => 'name',
                        'title' => __('admin.users.create.name.title'),
                        'placeholder' => __('admin.users.create.name.placeholder'),
                        'help' => __('admin.users.create.name.help'),
                        'icon' => 'bx bx-user',
                        'input_type' => 'text',
                        'input_name' => 'name',
                    ])

                    @include('_partials.input', [
                        '_id' => 'email',
                        'title' => __('admin.users.create.email.title'),
                        'placeholder' => __('admin.users.create.email.placeholder'),
                        'help' => __('admin.users.create.email.help'),
                        'icon' => 'bx bx-envelope',
                        'input_type' => 'email',
                        'input_name' => 'email',
                    ])

                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">@lang('admin.users.create.password.title')</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-dialpad-alt'></i></span>
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    @include('_partials.input', [
                        '_id' => 'phone',
                        'title' => __('admin.users.create.phone.title'),
                        'placeholder' => __('admin.users.create.phone.placeholder'),
                        'help' => __('admin.users.create.phone.help'),
                        'icon' => 'bx bx-phone',
                        'input_type' => 'text',
                        'input_name' => 'phone',
                    ])

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">@lang('admin.users.create.status.title')</label>
                        <select class="form-select" id="exampleFormControlSelect1" name="status"
                            aria-label="Default select">
                            @foreach (config('variables.status') as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        @include('_partials.uploadImage', [
                            'id' => 'image_',
                            'name' => 'user_image',
                            'title' => __('admin.users.create.image.title'),
                            'class' => 'file-upload-input',
                            'prifex' => Str::random(12),
                        ])
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('admin.send')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
