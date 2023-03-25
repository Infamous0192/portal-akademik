@props([
'name',
'label' => '',
'type' => 'text',
'value' => '',
'placeholder' => ''
])

<div class="form-group">
    @if ($label != '')
    <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input id="{{ $name }}" type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
        value="{{ old($name) }}" placeholder="{{ $placeholder }}">

    <div class="invalid-feedback">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>