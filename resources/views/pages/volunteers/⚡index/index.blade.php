@php
    /*$age_options = [
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
        ];*/

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
            <x-admin.admin-button href="{{route('pages::animals.index', ['locale' => __('general.currentLocale')])}}"
                                  title="Aller sur la page 'Créer un bénévole'" class="">
                {{__('admin/volunteers.create_a_volunteer')}}
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
                {{__('admin/volunteers.image')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/volunteers.name')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/volunteers.phone_number')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/volunteers.role')}}
            </x-admin.table.table-th>
        </tr>
        </thead>
        <tbody>
        @for( $i = 1; $i<= 10; $i++)
            <tr class="table-row ">
                <x-admin.table.table-td class="table-img">
                    <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="image du chien" class="border-r-big">
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-name fw-medium">
                    <span class="show-web">{{__('admin/volunteers.name_title')}}</span>Thomas Fortin
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-state">
                    <span class="show-web">{{__('admin/volunteers.phone_number_title')}}</span>039483820
                </x-admin.table.table-td>
                <x-admin.table.table-td class="table-species">
                    <span class="show-web">{{__('admin/volunteers.role_title')}}</span>Bénévole
                </x-admin.table.table-td>
            </tr>
        @endfor
        </tbody>
    </table>
</main>
