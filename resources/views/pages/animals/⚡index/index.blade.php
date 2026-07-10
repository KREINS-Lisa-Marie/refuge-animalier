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


<main class="main-container mb-80" id="content">
    <x-page-bar>
        {{__('admin/animals.animals')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::animals.create', ['locale' => __('general.currentLocale')])}}"
                                  title="{{__('admin/animals.got_to_create_animal')}}" class="">
                {{__('admin/animals.create_an_animal')}}
            </x-admin.admin-button>
            <x-admin.search/>
        </div>
        <div class="bottom-row">
            <form method="GET" action="{{ route('pages::animals.index', ['locale' => __('general.currentLocale')]) }}"
                  class="filter-form">
                <div class="field-label">
                    <x-select select_name="age" label="Age" :options="$age_options" wire="age"/>
                </div>
                <div class="field-label">
                    <x-select select_name="sex-animals" label="Sexe" :options="$sex_options" wire="sex"/>
                </div>
                <x-button>
                    {{__('admin/animals.filter')}}
                </x-button>
            </form>
{{--            <div>
                <x-select select_name="filtering" label="Trier" :options="$filter_options" wire="filtering"/>
            </div>--}}
        </div>
    </div>
    <table class="table max-w-admin-web m-b-32">
        <thead>
        <tr>
            <x-admin.table.table-th scope="col">
                {{__('admin/animals.image')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('animal_name')" :direction="$sortField === 'animal_name'? $sortDirection : null" class="{{$sortField === 'animal_name'? 'active-sort': ''}}">
                {{__('admin/animals.animal_name')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('state')" :direction="$sortField === 'state'? $sortDirection : null" class="{{$sortField === 'state'? 'active-sort': ''}}">
                {{__('admin/animals.state')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('species')" :direction="$sortField === 'species'? $sortDirection : null" class="{{$sortField === 'species'? 'active-sort': ''}}">
                {{__('admin/animals.species')}}
            </x-admin.table.table-th-sort>
        </tr>
        </thead>
        <tbody>

        @forelse($this->searchedAnimals as $animal)
            <tr class="table-row position-relative">
                <x-admin.table.table-td class="table-img">
                    <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="image du chien" class="border-r-big">
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-name fw-medium">
                    <span class="show-web">{{__('admin/animals.animal_name_title')}}</span>{!! $animal->animal_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-state">
                    <span class="show-web">{{__('admin/animals.state_title')}}</span>{!! $animal->state == 'adopted'? __('admin/animals.adopted') : ($animal->state == 'in_treatment' ? __('admin/animals.in_treatment') : __('admin/animals.processing_adoption') )!!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-species">
                    <span class="show-web">{{__('admin/animals.species_title')}}</span>{!! $animal->species !!}
                    <a href="{{route('pages::animals.show',  ['locale' => __('general.currentLocale'),  'animal' => $animal->id])}}" title="{{__('admin/animals.got_to_animal_page')}}" class="card-link">
                    </a>
                </x-admin.table.table-td>

            </tr>
            @empty
            <tr class="table-row position-relative">
                <x-admin.table.table-td class="table-img">
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-name fw-medium">
                    {{__('admin/animals.no_animal_found')}}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-state">
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-species">
                </x-admin.table.table-td>

            </tr>
        @endforelse

        </tbody>
    </table>
    <div class="pagination-admin max-w-admin-web">
        {{ $this->searchedAnimals->links() }}
    </div>
</main>
