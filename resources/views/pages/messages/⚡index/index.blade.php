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
        Messages
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::adoption-requests.index', ['locale' => __('general.currentLocale')])}}"
                                  title="Ouvrir les emails">
                Ouvrir les emails
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
                Nom complet
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                Email
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                Date
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                Animal
            </x-admin.table.table-th>
        </tr>
        </thead>
        <tbody>
        @for( $i = 1; $i<= 10; $i++)
            <tr class="table-row table-row-flex">
                <x-admin.table.table-td class="">
                    <span class="show-web">Nom complet : </span>Sarah Bato
                </x-admin.table.table-td>
                <x-admin.table.table-td class=" fw-medium">
                    <span class="show-web">Email : </span>sarah@bato.com
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">Date : </span>11.11.25
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">Animal : </span>Bobby
                </x-admin.table.table-td>
            </tr>
        @endfor
        </tbody>
    </table>
</main>
