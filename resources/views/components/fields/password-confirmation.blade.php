<div class="field">
    <label for="password_confirmation" class="field__label">
        {!! $slot !!}
    </label>
    @error('verification_password')
    <p class="error text-red-500">
        {{$message}}
    </p>
    @enderror
    <input type="password" id="password_confirmation" name="password_confirmation" class="field__input" value="" aria-required="true" wire:model.blur="{{$wire}}">
</div>
