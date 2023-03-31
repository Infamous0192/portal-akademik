@props([
'name',
'label' => '',
'value' => '',
'placeholder' => 'Choose file'
])

<div class="form-group">
    @if ($label != '')
    <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input name="{{ $name }}" type="file" value="{{ old($name, $value) }}"
        class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" accept="image/*">

    <div class="invalid-feedback pt-1">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>