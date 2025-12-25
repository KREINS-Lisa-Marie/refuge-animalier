@php
    $role_options = [
        [
            'name' => 'Admin',
        'value' =>'admin',
        ],
        [
            'name' => 'Bénévole',
        'value' =>'volunteer',
        ],
]

@endphp

<main class="main-container" id="content">
    <x-page-bar>
{{__('admin/volunteers.modify')}} {!! $volunteer->first_name !!} {!! $volunteer->last_name !!}
</x-page-bar>

    <form wire:submit="update" class="profile-form volunteers-edit">
        @csrf

    <fieldset class="profile-information edit-inputs max-w-admin-web">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </legend>
        <x-fields.text id="firstname" name="firstname" value="{!! $volunteer->first_name !!}" placeholder="Ex: John" wire="firstname">
            {{__('admin/volunteers.firstname')}}
        </x-fields.text>
        <x-fields.text id="lastname" name="lastname" value="{!! $volunteer->last_name !!}" placeholder="Ex: Doe" wire="lastname">
            {{__('admin/volunteers.lastname')}}
        </x-fields.text>
        <x-fields.text id="userphone" name="userphone" value="{!! $volunteer->phone !!}" placeholder="Ex: 038438293" wire="userphone">
            {{__('admin/volunteers.phone_number')}}
        </x-fields.text>
        <x-select select_name="role" label="{{__('admin/volunteers.role')}}" :options="$role_options"/>
        <x-fields.file name_id="volunteer-img" wire="volunteer-img" name="volunteer-img">
            {{__('admin/volunteers.profile_image')}}
        </x-fields.file>
    </fieldset>


    <fieldset class="profile-information max-w-admin-web volunteer-times">
        <legend class="fw-700 admin-dashboard-title availabilities">
            {{__('admin/volunteers.availability_of')}} {!! $volunteer->first_name !!}
        </legend>
        <div class="days-times">
            <x-fields.availability-input name="monday" id="monday" value="{{ $availabilities->monday }}" placeholder="10-17h" wire="monday">
                {{__('admin/volunteers.monday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="tuesday" id="tuesday" value="{{ $availabilities->tuesday }}" placeholder="10-17h" wire="tuesday">
                {{__('admin/volunteers.tuesday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="wednesday" id="wednesday" value="{{ $availabilities->wednesday }}" placeholder="10-17h" wire="wednesday">
                {{__('admin/volunteers.wednesday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="thursday" id="thursday" value="{{ $availabilities->thursday }}" placeholder="10-17h" wire="thursday">
                {{__('admin/volunteers.thursday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="friday" id="friday" value="{{ $availabilities->friday }}" placeholder="10-17h" wire="friday">
                {{__('admin/volunteers.friday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="saturday" id="saturday" value="{{ $availabilities->saturday }}" placeholder="10-17h" wire="saturday">
                {{__('admin/volunteers.saturday')}}
            </x-fields.availability-input>
            <x-fields.availability-input name="sunday" id="sunday" value="{{ $availabilities->sunday }}" placeholder="10-17h" wire="sunday">
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
