@props([
    'select_name',
    'label',
    'options' => [],
])

<div class="text-field">
<label for="{{$select_name}}" class="field__label">{{$label}}</label>
<select name="{{$select_name}}" id="{{$select_name}}" class="d-block background-white border-r-big p-16-32">
    <option class="m-b-24" value="">{{__('components/select.select_an_option')}}</option>
    @foreach($options as $option)
        <x-select-option :option_value="$option['value']" :option_name="$option['name']"  />
    @endforeach
</select>
</div>
