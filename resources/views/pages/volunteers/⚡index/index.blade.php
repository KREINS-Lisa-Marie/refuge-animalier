@php
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
    ]
@endphp

<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/volunteers.volunteers')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::volunteers.create', ['locale' => __('general.currentLocale')])}}"
                                  title="Aller sur la page 'Créer un bénévole'" class="">
                {{__('admin/volunteers.create_a_volunteer')}}
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
            <x-admin.table.table-th scope="col">
                {{__('admin/volunteers.image')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('last_name')" :direction="$sortField === 'last_name'? $sortDirection : null" class="{{$sortField === 'last_name'? 'active-sort': ''}}">
                {{__('admin/volunteers.name')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('phone')" :direction="$sortField === 'phone'? $sortDirection : null" class="{{$sortField === 'phone'? 'active-sort': ''}}">
                {{__('admin/volunteers.phone_number')}}
            </x-admin.table.table-th-sort>
            <x-admin.table.table-th-sort scope="col" sortable wire:click="sortBy('is_admin')" :direction="$sortField === 'is_admin'? $sortDirection : null" class="{{$sortField === 'is_admin'? 'active-sort': ''}}">
                {{__('admin/volunteers.role')}}
            </x-admin.table.table-th-sort>
        </tr>
        </thead>
        <tbody>

        @forelse($this->searchedUsers() as $volunteer)
            <tr class="table-row position-relative">
                <x-admin.table.table-td class="table-img">
                    <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="image du chien" class="border-r-big">
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-name fw-medium">
                    <span class="show-web">{{__('admin/volunteers.name_title')}}</span>{!! $volunteer->last_name !!} {!! $volunteer->first_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-state">
                    <span class="show-web">{{__('admin/volunteers.phone_number_title')}}</span>{!! $volunteer->phone !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-species">
                    <span class="show-web">{{__('admin/volunteers.role_title')}}</span>{!! $volunteer->is_admin?   __('admin/volunteers.admin'): __('admin/volunteers.volunteer') !!}
                    <a href="{{route('pages::volunteers.show',  ['locale' => __('general.currentLocale'),  'volunteer' => $volunteer->id])}}" title="aller vers la page de l’animal" class="card-link">
                    </a>
                </x-admin.table.table-td>
            </tr>
            @empty
                <tr class="table-row position-relative">
                    <x-admin.table.table-td class="table-img">
                    </x-admin.table.table-td>
                    <x-admin.table.table-td class="table-name fw-medium">
                        {{__('admin/volunteers.no_volunteer_found')}}
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
        {{ $this->searchedUsers->links() }}
    </div>
</main>



