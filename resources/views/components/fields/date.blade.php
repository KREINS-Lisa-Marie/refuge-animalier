<div class="text-field">
    <label for="date" class="field__label">
        {!! $slot !!}
    </label>
    <input type="date" name="date" id="date" {{--value="{!! $old_date !!}"--}} class="field__input">
    @error('date')
    {{$message}}
    @enderror
</div>
<?php
