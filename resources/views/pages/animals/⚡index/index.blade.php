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

        $filter_options =[
           [
            'name' => 'age-down',
        'value' =>'Age descendant',
        ],
                   [
            'name' => 'age-up',
        'value' =>'Age ascendant',
        ],
                   [
            'name' => 'state-adopt',
        'value' =>'A adopter',
        ],
]

@endphp


<main class="main-container" id="content">
    <x-page-bar>
        Les animaux
    </x-page-bar>
    <div class="admin-filters-buttons">
        <x-admin.admin-button href="{{route('pages::animals.index')}}" title="Aller sur la page 'Créer un animal'">
            Créer un animal
        </x-admin.admin-button>
        <x-admin.search/>
        <form method="GET" action="{{ route('pages::animals.index') }}" class="filter-form">
            <div class="field-label">
                <x-select select_name="age" label="Age" :options="$age_options"/>
            </div>
            <div class="field-label">
                <x-select select_name="sex-animals" label="Sexe" :options="$sex_options"/>
            </div>
            <x-button>
                Filtrer
            </x-button>
        </form>
        <x-select select_name="filtering" label="Trier" :options="$filter_options"/>
    </div>
    <table class="table">
        <thead>
        <tr>
            <x-admin.table.table-th scope="col">
                Image
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                Nom de l'animal
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                Statut
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                Espèce
            </x-admin.table.table-th>
        </tr>
        </thead>
        <tbody>
        @for( $i = 1; $i<= 10; $i++)
            <tr class="table-row background-white">
                <x-admin.table.table-td class="table-img">
                    <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="image du chien" class="border-r-big">
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-name fw-medium">
                    <span class="show-web">Nom : </span>Balou
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-state">
                    <span class="show-web">Statut : </span>A adopter
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-species">
                    <span class="show-web">Espèce : </span>Chien
                </x-admin.table.table-td>
            </tr>
        @endfor
        </tbody>
    </table>
</main>
