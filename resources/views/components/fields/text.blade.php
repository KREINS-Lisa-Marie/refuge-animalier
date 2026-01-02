@props([
    'id',
    'name',
    'placeholder' => '',
    'wire',
    'value' => '',
])
<div class="text-field">
    <label for="{!! $name !!}" class="field__label">
        {!! $slot!!}
    </label>
    <input wire:model.blur="{{$wire}}" type="text" name="{{$name}}" id="{{$id}}" value="{{$value ?? ''}}" class="field__input" placeholder="{{$placeholder}}"
           aria-required="true">
    @error($name)
    {{$message}}
    @enderror

    {{--
    wire blurr heisst dass das das formulaire schon an server schickt wenn aus dem feld raus geht also kann das theoretisch button ersetzen aber besser muss auf button whire submit machen!!!
    --}}
</div>
