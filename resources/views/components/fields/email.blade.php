<div class="field">
    <label for="email" class="field__label">
        {!! $slot!!}
    </label>
    <input type="email" name="email" id="email" class="field__input"
           value="{{$value}}" wire:model.blur="{{$wire}}"
           placeholder="johndoe@gmail.com" aria-required="true">
    @error('email')
    <p class="error">
        {{$message}}
    </p>
    @enderror
</div>
