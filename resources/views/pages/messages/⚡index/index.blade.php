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
                                  title="Ouvrir les emails" class="">
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
                {{__('admin/messages.subject')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.email')}}
            </x-admin.table.table-th>
            <x-admin.table.table-th scope="col">
                {{__('admin/messages.date')}}
            </x-admin.table.table-th>

        </tr>
        </thead>
        <tbody>

        @foreach($messages as $message)
            <tr class="table-row table-row-flex">
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.name_title')}}</span>{!! $message->last_name !!} {!! $message->first_name !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.subject_title')}}</span>{!! $message->subject !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class=" fw-medium">
                    <span class="show-web">{{__('admin/messages.email_title')}}</span>{!! $message->email !!}
                </x-admin.table.table-td>
                <x-admin.table.table-td class="">
                    <span class="show-web">{{__('admin/messages.date_title')}}</span>{!! $message->created_at->format('d.m.Y') !!}
                </x-admin.table.table-td>

            </tr>
        @endforeach
        </tbody>
    </table>
</main>
