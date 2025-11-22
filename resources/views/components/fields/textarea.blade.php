<div class="textarea_field">
    <label for="{{$name}}" class="field__label">
        {!! $slot !!}
    </label>
    <textarea id="{{$id}}" name="{{$name}}" class="textarea border-r-big message"
              placeholder="{{$placeholder}}" aria-required="true" >
        {!! $old_values !!}

    </textarea>
</div>
