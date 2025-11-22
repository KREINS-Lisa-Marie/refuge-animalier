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


@component('layouts.app')


        <h2 class="">
            Nos animaux
        </h2>

        <section class="">
            <h3 class="" aria-level="3" role="heading">
                Liste des animaux
            </h3>
            <div class="">
                <div><x-select select_name="select-animals" label="Age" :options="$age_options"/>
                </div>

            <div>
            <x-select select_name="sex-animals" label="Sexe" :options="$sex_options"/>
            </div>


            <button class="">
                Filter
            </button>
            </div>

            <label for="search-animals" class="">
              Rechercher
            </label>
            <input type="search" name="search-animals" placeholder="Rechercher" id="search-animals" class="">



            <ul class="">
                <li>
                    <x-cards  petname="Balou" petstatus="A adopter" petage="5" petrace="Frenchie" petsex="Masculin"   />
                </li>

                <li>
                    <x-cards  petname="Balou" petstatus="A adopter" petage="5" petrace="Frenchie" petsex="Masculin"   />
                </li>

                <li>
                    <x-cards  petname="Balou" petstatus="A adopter" petage="5" petrace="Frenchie" petsex="Masculin"   />
                </li>

                <li>
                    <x-cards  petname="Balou" petstatus="A adopter" petage="5" petrace="Frenchie" petsex="Masculin"   />
                </li>

                <li>
                    <x-cards  petname="Balou" petstatus="A adopter" petage="5" petrace="Frenchie" petsex="Masculin"   />
                </li>

                <li>
                    <x-cards  petname="Balou" petstatus="A adopter" petage="5" petrace="Frenchie" petsex="Masculin"   />
                </li>

                <li>
                    <x-cards  petname="Balou" petstatus="A adopter" petage="5" petrace="Frenchie" petsex="Masculin"   />
                </li>
            </ul>

        </section>

@endcomponent
