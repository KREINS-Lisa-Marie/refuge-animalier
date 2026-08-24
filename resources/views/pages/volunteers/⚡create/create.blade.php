@php
    $role_options = [
        [
            'name' => 'Admin',
            'value' => "1",
        ],
        [
            'name' => 'Bénévole',
            'value' => "0",
        ],
]
@endphp
@can('create', \App\Models\User::class)
<main class="main-container admin" id="content">
    <x-page-bar>
        {{__('admin/volunteers.create_a_volunteer')}}
    </x-page-bar>

    <form wire:submit.prevent="store" class="profile-form volunteers-edit" enctype="multipart/form-data">
        @csrf

        <fieldset class="profile-information max-w-admin-web">
            <legend class="fw-700 admin-dashboard-title">
                {{__('admin/volunteers.general_information')}}
            </legend>
            <p class="obligations m-b-32 ">
                {{__('admin/general.mandatory_field')}}
            </p>
            <div class="volunteers-fields">
                <div class="col">
                    <x-fields.text id="first_name" name="first_name" value="" placeholder="Ex: John" wire="first_name">
                        {{__('admin/volunteers.firstname')}}*
                    </x-fields.text>
                    <x-fields.text id="last_name" name="last_name" value="" placeholder="Ex: Doe" wire="last_name">
                        {{__('admin/volunteers.lastname')}}*
                    </x-fields.text>
                    <x-fields.email id="email" name="email" value="" placeholder="Ex: doe@doe.com" wire="email">
                        {{__('admin/volunteers.email')}}*
                    </x-fields.email>
                    <x-fields.phone id="phone" name="phone" value="" placeholder="Ex: 038438293" wire="phone">
                        {{__('admin/volunteers.phone_number')}}*
                    </x-fields.phone>
                </div>
                <div class="col">
                    <x-select select_name="is_admin" label="{{__('admin/volunteers.role')}}*" :options="$role_options" wire="is_admin"/>
                    <x-fields.password wire="password">
                        {{__('admin/volunteers.password')}}*
                    </x-fields.password>
                    <x-fields.password-confirmation wire="password_confirmation">
                        {{__('admin/profile.password_confirmation')}}*
                    </x-fields.password-confirmation>
                    <x-fields.file name_id="profile_image" wire="profile_image" name="profile_image">
                        {{__('admin/volunteers.profile_image')}}
                    </x-fields.file>
                </div>
            </div>
        </fieldset>


        <fieldset class="profile-information max-w-admin-web volunteer-times">
            <legend class="fw-700 admin-dashboard-title availabilities">
                {{__('admin/volunteers.availabilities')}}
            </legend>
            <div class="days-times">
                <x-fields.availability-input name="monday" id="monday" value="" placeholder="10-17h" wire="monday">
                    {{__('admin/general.monday')}}
                </x-fields.availability-input>
                <x-fields.availability-input name="tuesday" id="tuesday" value="" placeholder="10-17h" wire="tuesday">
                    {{__('admin/general.tuesday')}}
                </x-fields.availability-input>
                <x-fields.availability-input name="wednesday" id="wednesday" value="" placeholder="10-17h" wire="wednesday">
                    {{__('admin/general.wednesday')}}
                </x-fields.availability-input>
                <x-fields.availability-input name="thursday" id="thursday" value="" placeholder="10-17h" wire="thursday">
                    {{__('admin/general.thursday')}}
                </x-fields.availability-input>
                <x-fields.availability-input name="friday" id="friday" value="" placeholder="10-17h" wire="friday">
                    {{__('admin/general.friday')}}
                </x-fields.availability-input>
                <x-fields.availability-input name="saturday" id="saturday" value="" placeholder="10-17h" wire="saturday">
                    {{__('admin/general.saturday')}}
                </x-fields.availability-input>
                <x-fields.availability-input name="sunday" id="sunday" value="" placeholder="10-17h" wire="sunday">
                    {{__('admin/general.sunday')}}
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
