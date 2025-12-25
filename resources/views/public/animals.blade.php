@php
    $age_options = [
        [
            'name' => 'un',
        'value' =>'1 an',
        ],
        [
            'name' => 'deux',
        'value' =>'2 ans',
        ],
        [
            'name' => 'trois',
        'value' =>'3 ans',
        ],
        [
            'name' => 'quatre',
        'value' =>'4 ans',
        ],
        [
            'name' => 'cinq',
        'value' =>'5 ans',
        ],
        [
            'name' => 'six',
        'value' =>'6 ans',
        ],
        ];


        $sex_options = [
        [
            'name' => 'masculin',
        'value' =>'Masculin',
        ],
        [
            'name' => 'feminin',
        'value' =>'Féminin',
        ],
        ];

@endphp


<x-public.app>

    <h2 class="page-title m-b-60-94 fw-700 t-a-center color-dark p-b-0">
        {{__('public/animals.our_animals')}}
    </h2>

    <section class="background-dark p-t-b-60-150 p-l-r-24 ">
        <h3 class="sro" aria-level="3" role="heading">
            {{__('public/animals.animal_list')}}
        </h3>
        <div class="d-flex flex-wrap flex-j-c-space-between max-w-web margin-l-r-auto">
            <div class="d-flex flex-wrap flex-c flex-gap-24 filters">
                <div class="select">
                    <x-select select_name="select-animals" label="Age" :options="$age_options"/>
                </div>
                <div class="select">
                    <x-select select_name="sex-animals" label="Sexe" :options="$sex_options"/>
                </div>


                <button class="p-16-32 d-i-block dark-button-background color-white border-r-big">
                    {{__('public/animals.filter')}}
                </button>
            </div>

            <label for="search-animals" class="sro">
                {{__('public/animals.animal_list')}}
            </label>
            <input type="search" name="search-animals" placeholder="Rechercher" id="search-animals"
                   class="search-input background-white border-r-big p-16-32 m-t-32 m-b-56">
        </div>


        <ul class="d-flex flex-gap-24 flex-wrap max-w-web pet-group margin-l-r-auto">
            @foreach($animals as $animal)
                <li>
                    <x-cards :petname="$animal->animal_name" :petstatus="$animal->state" :petage="$animal->age" :petrace="$animal->race" :petsex="$animal->sex" :animal="$animal"/>
                </li>
            @endforeach
        </ul>

    </section>

</x-public.app>
