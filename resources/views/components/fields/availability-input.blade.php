<div class="text-field">
    <label for="{!! $name !!}" class="field__label">
        {!! $slot!!}
    </label>
    <input wire:model.blur="{{$wire}}" type="text" name="{{$name}}" id="{{$id}}" value="{{$value}}" class="availability-input" placeholder="{{$placeholder}}"
           aria-required="true">
    @error('availability')
    <p class="error text-red-500">
        {{$message}}
    </p>
    @enderror
</div>
