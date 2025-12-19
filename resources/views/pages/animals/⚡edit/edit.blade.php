<main class="main-container" id="content">
    <x-page-bar>
        Modifier
    </x-page-bar>

    <form wire:submit="save" class="profile-form volunteers-edit">
        @csrf
    <fieldset class="profile-information max-w-admin-web  edit-inputs ">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </legend>
        <x-fields.text id="animal-name" name="animal-name" value="" placeholder="Ex: John" wire="animal-name">
            {{__('admin/animals.animal_name')}}
        </x-fields.text>
        <x-fields.text id="species" name="species" value="" placeholder="Ex: Doe" wire="species">
            {{__('admin/animals.species')}}
        </x-fields.text>
        <x-fields.text id="sex-animals" name="sex-animals" value="" placeholder="Ex: 038438293" wire="sex-animals">
            {{__('admin/animals.sex')}}
        </x-fields.text>
        <x-fields.text id="fur" name="fur" value="" placeholder="Ex: Bénévole" wire="fur">
            {{__('admin/animals.fur')}}
        </x-fields.text>
        <x-fields.text id="age" name="age" value="" placeholder="Ex: Bénévole" wire="age">
            {{__('admin/animals.age')}}
        </x-fields.text>
        <x-fields.text id="vaccination" name="vaccination" value="" placeholder="Ex: Bénévole" wire="vaccination">
            {{__('admin/animals.vaccination')}}
        </x-fields.text>
        <x-fields.text id="description" name="description" value="" placeholder="Ex: Bénévole" wire="description">
            {{__('admin/animals.description')}}
        </x-fields.text>
        <x-fields.text id="personality" name="personality" value="" placeholder="Ex: Bénévole" wire="personality">
            {{__('admin/animals.personality')}}
        </x-fields.text>
        <x-fields.text id="state" name="state" value="" placeholder="Ex: Bénévole" wire="state">
            {{__('admin/animals.state')}}
        </x-fields.text>
        <x-fields.file name_id="volunteer-img" wire="volunteer-img" name="volunteer-img">
            {{__('admin/animals.animal_image')}}
        </x-fields.file>
    </fieldset>

    <fieldset class="profile-information max-w-admin-web  edit-inputs ">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/animals.gallery')}}
        </legend>
        <x-fields.file name_id="volunteer-img" wire="volunteer-img" name="volunteer-img">
            {{__('admin/animals.animal_image')}}
        </x-fields.file>
    </fieldset>


        <div class=" max-w-admin-web volunteer-buttons top-row">
            <x-admin.form-button>
                {{__('admin/animals.save')}}
            </x-admin.form-button>
        </div>
    </form>

</main>
