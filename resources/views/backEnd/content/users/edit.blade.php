@extends('backEnd/layouts/navbarLayout')

@empty($type)
    @section('title', __('menu.users.edit'))
@else
@section('title', __('menu.users.' . $type))
@endempty

@section('content')
<h4 class="fw-bold py-3 mb-4">@lang('admin.users.create.edit')</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <form method="POST" onsubmit="OnSubmit(event, false);" action="{{ route('admin:users:edit', $user) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">@lang('admin.users.create.name.title')</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="bx bx-user"></i></span>
                            <input type="text" class="form-control" name="name" id="basic-icon-default-fullname"
                                placeholder="@lang('admin.users.create.name.placeholder')" aria-label="@lang('admin.users.create.name.help')"
                                aria-describedby="basic-icon-default-fullname2" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-email">@lang('admin.users.create.email.title')</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input type="text" name="email" id="basic-icon-default-email" class="form-control"
                                placeholder="@lang('admin.users.create.email.placeholder')" aria-label="@lang('admin.users.create.email.help')"
                                aria-describedby="basic-icon-default-email2" />
                            <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                        </div>
                        <div class="form-text"> You can use letters, numbers & periods </div>
                    </div>

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

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-phone">@lang('admin.users.create.phone.title')</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                    class="bx bx-phone"></i></span>
                            <input type="text" id="basic-icon-default-phone" class="form-control phone-mask"
                                placeholder="@lang('admin.users.create.phone.placeholder')" aria-label="@lang('admin.users.create.phone.help')"
                                aria-describedby="basic-icon-default-phone2" />
                        </div>
                    </div>

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
                        ])
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
