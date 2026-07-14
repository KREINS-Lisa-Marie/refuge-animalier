@php

    $animal_state_options =[
       [
        'name' => __('admin/animals.adopted'),
    'value' =>'adopted',
    ],
               [
        'name' => __('admin/animals.processing_adoption'),
    'value' =>'processing_adoption',
    ],
               [
        'name' => __('admin/animals.in_treatment'),
    'value' =>'in_treatment',
    ],
                   [
        'name' => __('admin/animals.adoptable'),
    'value' =>'adoptable',
    ],
];

@endphp


<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/animals.create_an_animal')}}
    </x-page-bar>

    <form wire:submit.prevent="store" class="profile-form volunteers-edit" enctype="multipart/form-data">
        @csrf
        <fieldset class="profile-information max-w-admin-web  edit-inputs ">
            <legend class="fw-700 admin-dashboard-title">
                {{__('admin/animals.general_information')}}
            </legend>
            <p class="obligations m-b-32 ">
                {{__('admin/general.mandatory_field')}}
            </p>
            <div class="d-flex flex-r flex-wrap edit-inputs flex-gap-24">
                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <x-fields.text id="animal_name" name="animal_name" value="" placeholder="Ex: John"
                                   wire="animal_name">
                        {{__('admin/animals.animal_name')}}*
                    </x-fields.text>
                    <x-fields.text id="species" name="species" value="" placeholder="Ex: Doe" wire="species">
                        {{__('admin/animals.species')}}*
                    </x-fields.text>
                    <x-select select_name="sex" :options="$gender" wire="sex" label="{{__('admin/animals.sex')}}*">
                    </x-select>
                    <x-fields.text id="fur" name="fur" value="" placeholder="{{__('admin/animals.fur_placeholder')}}" wire="fur">
                        {{__('admin/animals.fur')}}
                    </x-fields.text>
                </div>

                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <div class="text-field">
                        <label for="age" class="field__label">
                            {{__('admin/animals.birthday')}}*
                        </label>
                        <input type="date" name="age" id="age" {{--value="{!! $old_date !!}"--}} class="field__input" wire:model.blur="age">
                        @error('age')
                        <p class="error mb-32">{{$message}}</p>
                        @enderror
                    </div>

                    <x-fields.text id="vaccinations" name="vaccinations" value="" placeholder="Ex: Guardtec" wire="vaccinations">
                        {{__('admin/animals.vaccination')}}
                    </x-fields.text>
                    <x-fields.text id="description" name="description" value="" placeholder="Ex: Bénévole" wire="description">
                        {{__('admin/animals.description')}}
                    </x-fields.text>
                    <x-fields.text id="character" name="character" value="" placeholder="{{__('admin/animals.character_placeholder')}}" wire="character">
                        {{__('admin/animals.personality')}}
                    </x-fields.text>
                </div>
                {{--            <x-fields.text id="state" name="state" value="" placeholder="Ex: Bénévole" wire="state">
                                {{__('admin/animals.state')}}
                            </x-fields.text>--}}
                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <x-select select_name="state" label="{{__('admin/animals.state')}}" wire="state"
                              :options="$animal_state_options">
                    </x-select>
                    <x-fields.file name_id="volunteer-img" wire="volunteer-img" name="volunteer-img">
                        {{__('admin/animals.animal_image')}}
                    </x-fields.file>
                </div>
            </div>
        </fieldset>

        <fieldset class="profile-information max-w-admin-web  edit-inputs ">
            <legend class="fw-700 admin-dashboard-title m-b-16">
                {{__('admin/animals.gallery')}}
            </legend>
            <x-fields.file name_id="volunteer-img" wire="volunteer-img" name="volunteer-img">
                {{__('admin/animals.animal_image')}}
            </x-fields.file>
        </fieldset>


        <div class=" max-w-admin-web volunteer-buttons top-row profile-information">
            <x-admin.form-button>
                {{__('admin/animals.save')}}
            </x-admin.form-button>
        </div>
    </form>

</main>
