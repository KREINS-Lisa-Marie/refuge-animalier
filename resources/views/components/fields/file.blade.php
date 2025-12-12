<div class="field">
    <label for="{{$name}}"  class="field__label" >
        {!! $slot !!}
    </label>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000000"/>
    <input type="file" wire:model.blur="{{$wire}}" id="{{$name}}" name="{{$name}}"
           class="file-input background-white border-r-big">
    @error("{{$name}}")
    <p class="error">
        {{$message}}
    </p>
    @enderror
</div>
