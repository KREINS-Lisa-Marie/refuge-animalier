<main class="main-container" id="content">
    <x-page-bar>
        Modifier {{ $animal_name }}
    </x-page-bar>

    <form wire:submit.prevent="save" class="profile-form volunteers-edit" enctype="multipart/form-data">
        @csrf
    <fieldset class="profile-information max-w-admin-web  edit-inputs ">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </legend>
        <p class="obligations m-b-32 ">
            {{__('admin/general.mandatory_field')}}
        </p>
        <div class="d-flex flex-r flex-wrap edit-inputs flex-gap-24">
            <div class="d-flex flex-dir flex-gap-24 col-inputs">
                <x-fields.text id="animal_name" name="animal_name" placeholder="Ex: John" wire="animal_name">
                    {{__('admin/animals.animal_name')}}*
                </x-fields.text>
                <x-select select_name="species" :options="$species_options" wire="species" label="{{__('admin/animals.species')}}*">
                </x-select>
                <x-fields.text id="race" name="race" placeholder="{{__('admin/animals.race_placeholder')}}" wire="race">
                    {{__('admin/animals.race')}}
                </x-fields.text>
                <x-select select_name="sex" :options="$gender" wire="sex" label="{{__('admin/animals.sex')}}*">
                </x-select>

            </div>
            <div class="d-flex flex-dir flex-gap-24 col-inputs">
                <x-fields.text id="fur" name="fur" placeholder="{{__('admin/animals.fur_placeholder')}}" wire="fur">
                    {{__('admin/animals.fur')}}
                </x-fields.text>
                <div class="text-field">
                    <label for="age" class="field__label">
                        {{__('admin/animals.birthday')}}*
                    </label>
                    <input type="date" name="age" id="age" class="field__input" wire:model.blur="age">
                    @error('age')
                    {{$message}}
                    @enderror
                </div>

                <x-fields.text id="vaccinations" name="vaccinations"
                               placeholder="{{__('admin/animals.vaccination_placeholder')}}"
                               wire="vaccinations">
                    {{__('admin/animals.vaccination')}}
                </x-fields.text>
                <x-fields.text id="description" name="description"
                               placeholder="{{__('admin/animals.second_character_placeholder')}}"
                               wire="description">
                    {{__('admin/animals.description')}}
                </x-fields.text>

            </div>
            <div class="d-flex flex-dir flex-gap-24 col-inputs">
                <x-fields.text id="character" name="character"
                               placeholder="{{__('admin/animals.second_character_placeholder')}}"
                               wire="character">
                    {{__('admin/animals.personality')}}
                </x-fields.text>
                <x-select select_name="state" label="{{__('admin/animals.state')}}" wire="state"
                          :options="$animal_state_options">
                </x-select>
            </div>
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
