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
        {{__('admin/adoption-requests.adoption_requests')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::adoption-requests.index', ['locale' => __('general.currentLocale')])}}"
                                  title="Aller sur la page 'Créer une demande'">
                {{__('admin/adoption-requests.create_a_request')}}
            </x-admin.admin-button>
            <x-admin.search/>
        </div>
        <div class="bottom-row bottom-row-volunteer">
            <div>
                <x-select select_name="filtering" label="Trier" :options="$filter_options"/>
            </div>
        </div>
    </div>
    <table class="table max-w-admin-web">
        <thead>
        <tr>
            <x-admin.table.table-th scope="col">
                {{__('admin/adoption-requests.name')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/adoption-requests.date')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/adoption-requests.animal')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/adoption-requests.state')}}
            </x-admin.table.table-th>
        </tr>
        </thead>
        <tbody>
        @for( $i = 1; $i<= 10; $i++)
            <tr class="table-row table-row-flex">
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.name_title')}}</span>Thomas Fortin
                </x-admin.table.table-td>
                <x-admin.table.table-td class=" fw-medium">
                    <span class="show-web">{{__('admin/adoption-requests.date_title')}}</span>11.11.25
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.animal_title')}}</span>Bobby
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/adoption-requests.state_title')}}</span>En cours d’adoption
                </x-admin.table.table-td>
            </tr>
        @endfor
        </tbody>
    </table>
</main>
