@props([
'name',
'label' => '',
'value' => '',
'placeholder' => ''
])

<div class="form-group">
    @if ($label != '')
    <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input id="{{ $name }}" type="text" class="form-control timepicker @error($name) is-invalid @enderror"
        name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">

    <div class="invalid-feedback">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>
