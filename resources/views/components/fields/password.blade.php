<div class="field">
    <label for="password" class="field__label">
        {!! $slot!!}
    </label>
    @error('password')
    <p class="error text-red-500">
        {{$message}}
    </p>
    @enderror
    <input type="password" id="password" name="password" class="field__input" value="{{$value}}" aria-required="true" wire:model.blur="{{$wire}}">
</div>
