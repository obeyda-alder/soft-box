<label for="{{ $id }}" class="form-label">{{ $title }}</label>
<div class="image-upload-wrap image-upload-wrap-{{ $prifex ?? '' }}">
    <input class="file-upload-input-style {{ $class }}-{{ $prifex }}" id="{{ $id }}"
        name="{{ $name }}" type='file' onchange="readURL(this, '{{ $prifex ?? '' }}');" accept="image/*" />
    <div class="drag-text">
        <h3>@lang('admin.drag_and_drop')</h3>
    </div>
</div>

<div class="file-upload-content file-upload-content-{{ $prifex ?? '' }}">
    <img class="file-upload-image file-upload-image-{{ $prifex ?? '' }}" src="{{ $src ?? '' }}" alt="image" />
</div>

<div class="image-title-wrap mt-2">
    <button type="button" onclick="removeUpload('{{ $prifex ?? '' }}')"
        class="remove-image btn bg-gradient-error w-100 mx-2">@lang('admin.remove')</button>
    <button class="file-upload-btn file-upload-btn-{{ $prifex ?? '' }} btn bg-gradient-info w-100 mx-2" type="button"
        onclick="$('.{{ $class }}-{{ $prifex }}').trigger( 'click' )">@lang('admin.add_image')</button>
</div>
<div class="form-text">{{ $help ?? '' }}</div>

@isset($src)
    @empty(!$src)
        <script>
            window.onload = function() {
                $(document).ready(function() {
                    $('.image-upload-wrap').hide();
                    $('.file-upload-content').show();
                    $('.remove-image').show();
                    $('.file-upload-btn').html('{!! __('base.edit_image') !!}');
                });
            }
        </script>
    @endempty
@endisset
