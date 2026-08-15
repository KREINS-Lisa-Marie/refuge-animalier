@php
    $role_options = [
        [
            'name' => 'Admin',
        'value' => "1",
        ],
        [
            'name' => 'Bénévole',
            'value' =>"0",
        ],
]

@endphp
@can('update', $volunteer)
<main class="main-container" id="content">
    <x-page-bar>
{{__('admin/volunteers.modify')}} {!! $volunteer->first_name !!} {!! $volunteer->last_name !!}
</x-page-bar>

    <form wire:submit.prevent="save" class="profile-form volunteers-edit" enctype="multipart/form-data">
        @csrf

    <fieldset class="profile-information max-w-admin-web">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </legend>
        <p class="obligations m-b-32 ">
            {{__('admin/general.mandatory_field')}}
        </p>
        <div class="d-flex flex-r flex-wrap edit-inputs flex-gap-24">
            <div class="d-flex flex-dir flex-gap-24 col-inputs">
            <x-fields.text id="first_name" name="first_name" value="{!! $volunteer->first_name !!}"
                           placeholder="Ex: John" wire="first_name">
                {{__('admin/volunteers.firstname')}}*
            </x-fields.text>
            <x-fields.text id="last_name" name="last_name" value="{!! $volunteer->last_name !!}" placeholder="Ex: Doe"
                           wire="last_name">
                {{__('admin/volunteers.lastname')}}*
            </x-fields.text>
            <x-fields.phone id="phone" name="phone" value="{!! $volunteer->phone !!}" placeholder="Ex: 038438293"
                           wire="phone">
                {{__('admin/volunteers.phone_number')}}*
            </x-fields.phone>
        </div>
            <div class="d-flex flex-dir flex-gap-24 col-inputs">
            <x-select select_name="is_admin" label="{{__('admin/volunteers.role')}}" :options="$role_options"
                      wire="is_admin"/>
            <x-fields.file name_id="profile_image" wire="profile_image" name="profile_image">
                {{__('admin/volunteers.profile_image')}}
            </x-fields.file>
        </div>
        </div>
    </fieldset>


    <fieldset class="profile-information max-w-admin-web volunteer-times">
        <legend class="fw-700 admin-dashboard-title availabilities">
            {{__('admin/volunteers.availability_of')}} {!! $volunteer->first_name !!}
        </legend>
        <div class="days-times">
            <x-fields.availability-input name="monday" id="monday" value="{{ $availabilities->monday??'' }}" placeholder="10-17h" wire="monday">
                {{__('admin/volunteers.monday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="tuesday" id="tuesday" value="{{ $availabilities->tuesday??'' }}" placeholder="10-17h" wire="tuesday">
                {{__('admin/volunteers.tuesday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="wednesday" id="wednesday" value="{{ $availabilities->wednesday??'' }}" placeholder="10-17h" wire="wednesday">
                {{__('admin/volunteers.wednesday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="thursday" id="thursday" value="{{ $availabilities->thursday??'' }}" placeholder="10-17h" wire="thursday">
                {{__('admin/volunteers.thursday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="friday" id="friday" value="{{ $availabilities->friday??'' }}" placeholder="10-17h" wire="friday">
                {{__('admin/volunteers.friday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="saturday" id="saturday" value="{{ $availabilities->saturday??'' }}" placeholder="10-17h" wire="saturday">
                {{__('admin/volunteers.saturday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="sunday" id="sunday" value="{{ $availabilities->sunday??'' }}" placeholder="10-17h" wire="sunday">
                {{__('admin/volunteers.sunday')}}
            </x-fields.availability-input>
        </div>
    </fieldset>


<div class=" max-w-admin-web volunteer-buttons top-row">
    <x-admin.form-button>
        {{__('admin/volunteers.save')}}
    </x-admin.form-button>
</div>
    </form>

</main>
@endcan
