<div class="field">
    <label for="{!! $name !!}" class="field__label">
        {!! $slot!!}
    </label>
<input type="tel" wire:model.blur="{{$wire}}" name="{{$name}}" id="{{$id}}" value="{{$value}}" class="field__input" placeholder="{{$placeholder}}"
       aria-required="true">
</div>
