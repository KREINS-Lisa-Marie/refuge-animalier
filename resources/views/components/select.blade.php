@props([
    'select_name',
    'label',
    'options' => [],
])

<label for="{{$select_name}}" class="">{{$label}}</label>

<select name="{{$select_name}}" id="{{$select_name}}" class="">
    <option class="" value="">--Sélectionnez une option--</option>

    @foreach($options as $option)
        <x-select-option :option_value="$option['value']" :option_name="$option['name']"  />

    @endforeach

</select>
