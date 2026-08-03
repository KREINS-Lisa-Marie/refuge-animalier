<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/animals.create_an_animal')}}
    </x-page-bar>

    <form wire:submit.prevent="store" class="admin-form volunteers-edit" enctype="multipart/form-data">
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
                    <x-select select_name="species" :options="$species_options" wire="species" label="{{__('admin/animals.species')}}*">
                    </x-select>
                    <x-fields.text id="race" name="race" value="" placeholder="Ex: Dalmatien" wire="race">
                        {{__('admin/animals.race')}}*
                    </x-fields.text>
                    <x-select select_name="sex" :options="$gender" wire="sex" label="{{__('admin/animals.sex')}}*">
                    </x-select>

                </div>

                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <x-fields.text id="fur" name="fur" value="" placeholder="{{__('admin/animals.fur_placeholder')}}" wire="fur">
                        {{__('admin/animals.fur')}}
                    </x-fields.text>
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
                </div>
                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <x-fields.text id="character" name="character" value="" placeholder="{{__('admin/animals.character_placeholder')}}" wire="character">
                        {{__('admin/animals.personality')}}
                    </x-fields.text>
                    <x-select select_name="state" label="{{__('admin/animals.state')}}" wire="state"
                              :options="$animal_state_options">
                    </x-select>
                    <x-fields.file name_id="show_image" wire="show_image" name="show_image">
                        {{__('admin/animals.animal_image')}}
                    </x-fields.file>
                </div>
            </div>
        </fieldset>

        <fieldset class="profile-information max-w-admin-web  edit-inputs ">
            <legend class="fw-700 admin-dashboard-title m-b-16">
                {{__('admin/animals.gallery')}}
            </legend>
            <x-fields.multifile name_id="new_gallery_images" wire="new_gallery_images" name="new_gallery_images">
                {{__('admin/animals.animal_image')}}
            </x-fields.multifile>
            @if(!empty($gallery_images))
                <div class="gallery-preview">
                    @foreach($gallery_images as $index=>$image)
                        <div>
                            <img src="{{ $image->temporaryUrl() }}" alt="Gallery image" width="100" height="100">       {{--temporaryUrl parce que sinon ça ne marche pas parce que l'image n'est pas encore enregistré --}}
                            <button type="button" wire:click="removeFromGallery({{$index}})" class="remove-img-btn" title="Delete image">
                                X
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <p>{{__('admin/animals.no_images_chosen')}}</p>
            @endif
        </fieldset>
        <fieldset class="profile-information max-w-admin-web edit-inputs edit-textarea-big request-edit-comment">
            <x-fields.textarea wire="internal_notes" id="internal_notes" name="internal_notes" placeholder="{{__('admin/animals.internal_notes')}}" >
                {{__('admin/animals.internal_notes')}}
            </x-fields.textarea>
            <x-fields.textarea wire="modification_request" id="modification_request" name="modification_request" placeholder="{{__('admin/animals.modification_request')}}" >
                {{__('admin/animals.modification_request')}}
            </x-fields.textarea>
            @can('createLimited', \App\Models\Animal::class)
                <x-select select_name="published_animal" :options="$published_animal_options" wire="published_animal" label="{{__('admin/animals.published_animal')}}*">
                </x-select>
            @endcan
        </fieldset>
        <div class=" max-w-admin-web volunteer-buttons top-row">


        <div class=" max-w-admin-web volunteer-buttons top-row profile-information">

            <x-admin.form-button>
                {{__('admin/animals.save')}}
            </x-admin.form-button>
        </div>
        </div>
    </form>

</main>
