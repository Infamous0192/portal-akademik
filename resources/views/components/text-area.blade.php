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
    <textarea id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">{{ old($name, $value) }}</textarea>

    <div class="invalid-feedback">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>