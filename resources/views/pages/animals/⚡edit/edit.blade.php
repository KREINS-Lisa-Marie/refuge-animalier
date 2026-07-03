<main class="main-container" id="content">
    <x-page-bar>
        Modifier {{ $animal_name }}
    </x-page-bar>

    <form wire:submit="save" class="profile-form volunteers-edit">
        @csrf
    <fieldset class="profile-information max-w-admin-web  edit-inputs ">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </legend>
        <p class="obligations m-b-32 ">
            {{__('admin/general.mandatory_field')}}
        </p>
        <div>
            <x-fields.text id="animal_name" name="animal_name" placeholder="Ex: John" wire="animal_name">
                {{__('admin/animals.animal_name')}}
            </x-fields.text>
            <x-fields.text id="species" name="species" placeholder="Ex: Doe" wire="species">
                {{__('admin/animals.species')}}
            </x-fields.text>
            <x-fields.text id="sex" name="sex" placeholder="Ex: 038438293" wire="sex">
                {{__('admin/animals.sex')}}
            </x-fields.text>
            <x-fields.text id="fur" name="fur" placeholder="Ex: brun-blanc" wire="fur">
                {{__('admin/animals.fur')}}
            </x-fields.text>
            <x-fields.text id="age" name="age" placeholder="Ex: 12 ans" wire="age">
                {{__('admin/animals.age')}} an(s)
            </x-fields.text>
            <x-fields.text id="vaccinations" name="vaccinations" placeholder="Ex: Vaccin contre la rage"
                           wire="vaccinations">
                {{__('admin/animals.vaccination')}}
            </x-fields.text>
            <x-fields.text id="description" name="description" placeholder="Ex: Chien calme et faimilial..."
                           wire="description">
                {{__('admin/animals.description')}}
            </x-fields.text>
            <x-fields.text id="character" name="character" placeholder="Ex: joyeux, calme et bien éduqué"
                           wire="character">
                {{__('admin/animals.personality')}}
            </x-fields.text>
            <x-fields.text id="state" name="state" placeholder="Ex: Bénévole" wire="state">
                {{__('admin/animals.state')}}
            </x-fields.text>
        </div>
{{--        <x-fields.file name_id="show_image" wire="show_image" name="volunteer_img">
            {{__('admin/animals.animal_image')}}
        </x-fields.file>--}}
    </fieldset>

    <fieldset class="profile-information max-w-admin-web  edit-inputs ">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/animals.gallery')}}
        </legend>
       {{-- <x-fields.file name_id="volunteer_img" wire="volunteer_img" name="volunteer_img">
            {{__('admin/animals.animal_image')}}
        </x-fields.file>--}}
    </fieldset>


        <div class=" max-w-admin-web volunteer-buttons top-row">
            <x-admin.form-button>
                {{__('admin/animals.save')}}
            </x-admin.form-button>
        </div>
    </form>

</main>
