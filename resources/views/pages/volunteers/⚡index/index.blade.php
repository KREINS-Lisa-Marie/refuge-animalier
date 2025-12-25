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

        @foreach($volunteers as $volunteer)
            <tr class="table-row ">
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
                </x-admin.table.table-td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>



