<label class="form-label" for="basic-icon-default-email">{{ $title }}</label>
<div class="input-group input-group-merge">
    <span class="input-group-text"><i class="{{ $icon }}"></i></span>
    <input type="{{ $input_type }}" name="{{ $input_name }}" id="{{ $_id }}" class="form-control"
        placeholder="{{ $placeholder }}" value="{{ $value ?? '' }}" />
    @if (isset($has_count) && $has_count)
        <input class="form-control order-input" type="number" name="{{ $count_name }}"
            value="{{ $count_value ?? '' }}" />
    @endif
</div>
<div class="form-text">{{ $help ?? '' }}</div>
