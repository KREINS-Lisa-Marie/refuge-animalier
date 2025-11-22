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


        <h2 class="page-title m-t-110 m-b-60 fw-700 t-a-center">
            Nos animaux
        </h2>

        <section class="background-light p-t-b-60 p-l-r-24 ">
            <h3 class="sro" aria-level="3" role="heading">
                Liste des animaux
            </h3>
            <div class="d-flex flex-c flex-gap-24 max-w-web">
                <div><x-select select_name="select-animals" label="Age" :options="$age_options"/>
                </div>

            <div>
            <x-select select_name="sex-animals" label="Sexe" :options="$sex_options"/>
            </div>


            <button class="p-16-32 d-i-block dark-button-background color-white border-r-big">
                Filter
            </button>
            </div>

            <label for="search-animals" class="sro">
              Rechercher
            </label>
            <input type="search" name="search-animals" placeholder="Rechercher" id="search-animals" class="background-white min-w-full border-r-big p-16-32 m-t-32 m-b-56">



            <ul class="d-flex  flex-gap-24 flex-wrap max-w-web pet-group">
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
