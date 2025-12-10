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
        {{__('admin/messages.messages')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::adoption-requests.index', ['locale' => __('general.currentLocale')])}}"
                                  title="Ouvrir les emails">
                {{__('admin/messages.open_emails')}}
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
                {{__('admin/messages.name')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.email')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.date')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.animal')}}
            </x-admin.table.table-th>
        </tr>
        </thead>
        <tbody>
        @for( $i = 1; $i<= 10; $i++)
            <tr class="table-row table-row-flex">
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.name_title')}}</span>Sarah Bato
                </x-admin.table.table-td>
                <x-admin.table.table-td class=" fw-medium">
                    <span class="show-web">{{__('admin/messages.email_title')}}</span>sarah@bato.com
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.date_title')}}</span>11.11.25
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.animal_title')}}</span>Bobby
                </x-admin.table.table-td>
            </tr>
        @endfor
        </tbody>
    </table>
</main>
