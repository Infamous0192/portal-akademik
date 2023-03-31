@props([
'name',
'label' => '',
'value' => '',
'placeholder' => '',
'data' => [],
'required' => 'false'
])

<div class="form-group">
    @if ($label != '')
    <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <select id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
        value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" {{ $required=='true' ? 'required' : '' }}>
        <option value="" {{ old($name, $value)=='' ? 'selected' : '' }}>{{ $placeholder }}</option>
        @foreach ($data as $item)
        <option value="{{ $item['value'] }}" {{ old($name, $value)==$item['value'] ? 'selected' : '' }}>{{
            $item['label'] }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>