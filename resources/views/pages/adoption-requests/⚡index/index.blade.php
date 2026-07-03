{{--@php

        $filter_options =[
           [
            'name' => 'ABC',
        'value' =>'ABC',
        ],
                   [
            'name' => 'ZYX',
        'value' =>'ZYX',
        ],
                   [
            'name' => 'latest',
        'value' =>'plus récents',
        ],
];

@endphp--}}


<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/adoption-requests.adoption_requests')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::adoption-requests.create', ['locale' => __('general.currentLocale')])}}"
                                  title="Aller sur la page 'Créer une demande'" class="">
                {{__('admin/adoption-requests.create_a_request')}}
            </x-admin.admin-button>
            <x-admin.search/>
        </div>
{{--        <div class="bottom-row bottom-row-volunteer">
            <div>
                <x-select select_name="filtering" label="Trier" :options="$filter_options" wire="filtering"/>
            </div>
        </div>--}}
    </div>
    <table class="table max-w-admin-web m-b-32">
        <thead>
        <tr>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('last_name')" :direction="$sortField === 'last_name'? $sortDirection : null" class="{{$sortField === 'last_name'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.name')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at'? $sortDirection : null" class="{{$sortField === 'created_at'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.date')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('animal_name')" :direction="$sortField === 'animal_name'? $sortDirection : null" class="{{$sortField === 'animal_name'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.animal')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('state')" :direction="$sortField === 'state'? $sortDirection : null" class="{{$sortField === 'state'? 'active-sort': ''}}">
                {{__('admin/adoption-requests.state')}}
            </x-admin.table.table-th-sort>
        </tr>
        </thead>
        <tbody>
        @forelse($this->searchedRequests as $request)
            <tr class="table-row table-row-flex">
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.name_title')}}</span>{!! $request->last_name !!} {!! $request->first_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class=" fw-medium">
                    <span class="show-web">{{__('admin/adoption-requests.date_title')}}</span>{!! $request->created_at->format('d.m.Y') !!}
                </x-admin.table.table-td>
                @php($animal = \App\Models\Animal::where('id', $request->animal_id)->first())
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.animal_title')}}</span>{!! $animal->animal_name !!}
                </x-admin.table.table-td>

                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.state_title')}}</span>
                    {!! $request->state == 'adopted'? __('admin/adoption-requests.adopted') : ($request->state == 'in_treatment' ? __('admin/adoption-requests.in_treatment') : ($request->state == 'refused' ? __('admin/adoption-requests.refused') :__('admin/adoption-requests.not_treated_yet') ) )!!}
                   {{--TO DO MODAL--}}
                    {{--<a href="{{route('pages::adoption-requests.show',  ['locale' => __('general.currentLocale'),  'request' => $request->id])}}" title="aller vers la page de l’animal" class="card-link">
                    </a>--}}
                </x-admin.table.table-td>
            </tr>
            @empty
                <tr class="table-row position-relative">
                    <x-admin.table.table-td class="table-img">
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-name fw-medium">
                        {{__('admin/adoption-requests.no_request_found')}}
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-state">
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-species">
                    </x-admin.table.table-td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-admin max-w-admin-web m-b-80">
        {{ $this->searchedRequests->links() }}
    </div>
</main>
