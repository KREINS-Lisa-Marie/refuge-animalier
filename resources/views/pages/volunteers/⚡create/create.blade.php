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
        {{__('admin/volunteers.create_a_volunteer')}}
    </x-page-bar>

    <form wire:submit="save" class="profile-form volunteers-edit">
        @csrf

        <fieldset class="profile-information edit-inputs max-w-admin-web">
            <legend class="fw-700 admin-dashboard-title">
                {{__('admin/volunteers.general_information')}}
            </legend>
            <x-fields.text id="firstname" name="firstname" value="" placeholder="Ex: John" wire="firstname">
                {{__('admin/volunteers.firstname')}}
            </x-fields.text>
            <x-fields.text id="lastname" name="lastname" value="" placeholder="Ex: Doe" wire="lastname">
                {{__('admin/volunteers.lastname')}}
            </x-fields.text>
            <x-fields.text id="userphone" name="userphone" value="" placeholder="Ex: 038438293" wire="userphone">
                {{__('admin/volunteers.phone_number')}}
            </x-fields.text>
            <x-select select_name="role" label="{{__('admin/volunteers.role')}}" :options="$role_options"/>
            <x-fields.password wire="password">
                {{__('admin/volunteers.password')}}
            </x-fields.password>
            <x-fields.file name_id="volunteer-img" wire="volunteer-img" name="volunteer-img">
                {{__('admin/volunteers.profile_image')}}
            </x-fields.file>
        </fieldset>


        <fieldset class="profile-information max-w-admin-web volunteer-times">
            <legend class="fw-700 admin-dashboard-title availabilities">
                {{__('admin/volunteers.availabilities')}}
            </legend>
            <div class="days-times">
                <x-fields.availability-input name="monday" id="monday" value="" placeholder="10-17h" wire="monday">
                    Lundi
                </x-fields.availability-input>
                <x-fields.availability-input name="tuesday" id="tuesday" value="" placeholder="10-17h" wire="tuesday">
                    Mardi
                </x-fields.availability-input>
                <x-fields.availability-input name="wednesday" id="wednesday" value="" placeholder="10-17h" wire="wednesday">
                    Mercredi
                </x-fields.availability-input>
                <x-fields.availability-input name="thursday" id="thursday" value="" placeholder="10-17h" wire="thursday">
                    Jeudi
                </x-fields.availability-input>
                <x-fields.availability-input name="friday" id="friday" value="" placeholder="10-17h" wire="friday">
                    Vendredi
                </x-fields.availability-input>
                <x-fields.availability-input name="saturday" id="saturday" value="" placeholder="10-17h" wire="saturday">
                    Samedi
                </x-fields.availability-input>
                <x-fields.availability-input name="sunday" id="sunday" value="" placeholder="10-17h" wire="sunday">
                    Dimanche
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
