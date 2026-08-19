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
    @can('viewAny', \App\Models\Animal::class)
    <x-page-bar>
        {{__('admin/animals.animals')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            @can('create', \App\Models\Animal::class)
            <x-admin.admin-button href="{{route('pages::animals.create', ['locale' => __('general.currentLocale')])}}" title="{{__('admin/animals.got_to_create_animal')}}" class="">
                {{__('admin/animals.create_an_animal')}}
            </x-admin.admin-button>
            @endcan
            <x-admin.search/>
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
                    @if($animal->show_image)
                        <img src="{{Storage::disk('s3')->url('images/animals/variants/100x100/'.basename($animal->show_image))}}" alt="{{__('admin/animals.animal_image')}}"
                             class="border-r-big animal-img">
                    @else
                        <img src="{!! asset('assets/img/default.jpg') !!}" alt="{{__('admin/animals.animal_image')}}" width="100" height="100"
                             class="border-r-big animal-img">
                    @endif
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-name fw-medium">
                    <span class="show-web">{{__('admin/animals.animal_name_title')}}</span>{!! $animal->animal_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-state go_front">
                    <span class="show-web">{{__('admin/animals.state_title')}}</span>
                    @can('update', $animal)
                    <select name="state" id="state" wire:change="updateState({{ $animal->id }}, $event.target.value)">
                        <option value="adopted" @selected($animal->state === 'adopted')>{{__('admin/animals.adopted') }}</option>
                        <option value="adoptable" @selected($animal->state === 'adoptable')>{{__('admin/animals.adoptable') }}</option>
                        <option value="in_treatment" @selected($animal->state === 'in_treatment')>{{__('admin/animals.in_treatment')}}</option>
                        <option value="processing_adoption" @selected($animal->state === 'processing_adoption')>{{__('admin/animals.processing_adoption')}}</option>
                    </select>
                        @endcan
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-species">
                    <span class="show-web">{{__('admin/animals.species_title')}}</span>
                    {{ $animal->species  == 'dog'? __('admin/animals.dog') : ($animal->species  == 'cat'? __('admin/animals.cat') : ($animal->species  == 'rabbit'? __('admin/animals.bunny') : __('admin/animals.hamster'))) }}
                    <a href="{{route('pages::animals.show',  ['locale' => app()->getLocale(),  'animal' => $animal->id])}}" title="{{__('admin/animals.got_to_animal_page')}}" class="card-link">
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
        @endcan
</main>

{{--
@selected -> https://laravel.com/docs/13.x/blade#additional-attributes
--}}
