<main class="main-container" id="content">
    @can('update', $animal)
    <x-page-bar>
        {{__('admin/volunteers.modify')}} {{ $animal_name }}
    </x-page-bar>

    <form wire:submit.prevent="save" class="admin-form volunteers-edit" enctype="multipart/form-data">
        @csrf

    <fieldset class="profile-information max-w-admin-web  edit-inputs ">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </legend>
        <p class="obligations m-b-32 ">
            {{__('admin/general.mandatory_field')}}
        </p>

        <div class="d-flex flex-r flex-wrap edit-inputs flex-gap-24">
            @can('updateLimited', $animal)
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
            @endcan
            <div class="d-flex flex-dir flex-gap-24 col-inputs">
                @can('updateLimited', $animal)
                <x-fields.text id="character" name="character"
                               placeholder="{{__('admin/animals.second_character_placeholder')}}"
                               wire="character">
                    {{__('admin/animals.personality')}}
                </x-fields.text>
                @endcan
                <x-select select_name="state" label="{{__('admin/animals.state')}}" wire="state"
                          :options="$animal_state_options">
                </x-select>
                @can('updateLimited', $animal)
                <x-fields.file name_id="show_image" wire="show_image" name="show_image">
                    {{__('admin/animals.animal_image')}}
                </x-fields.file>
                @endcan
            </div>
        </div>
    </fieldset>

    <fieldset class="profile-information max-w-admin-web  edit-inputs ">
        <legend class="fw-700 admin-dashboard-title">
            {{__('admin/animals.gallery')}}
        </legend>

        <x-fields.multifile name_id="new_gallery_images" wire="new_gallery_images" name="new_gallery_images">
            {{__('admin/animals.animal_image')}}
        </x-fields.multifile>
        @error('gallery_images')
        <p class="error">
            {{$message}}
        </p>
        @enderror
        @error('gallery_images'.'.*')
        <p class="error">
            {{$message}}
        </p>
        @enderror
        @if(!empty($gallery_images))
            <div class="gallery-preview">
                @foreach($gallery_images as $index=>$image)
                    <div>
                        @if(is_string($image))
                            <img src="{{ Storage::disk('s3')->url($image) }}" alt="Gallery image" width="100" height="100">
                        @else
                            @if($image->isPreviewable())
                                <img src="{{ $image->temporaryUrl() }}" alt="Gallery image" width="100" height="100">
                            @else
                                <p>
                                    {{__('admin/animals.image_cant_be_previewed')}}
                                </p>
                            @endif
                        @endif

                           {{--temporaryUrl parce que sinon ça ne marche pas parce que l'image n'est pas encore enregistré --}}
                        <button type="button" wire:click="removeFromGallery({{$index}})" class="remove-img-btn" title="Delete image">
                            X
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <p class="m-t-16">{{__('admin/animals.no_images_chosen')}}</p>
        @endif
    </fieldset>
        <fieldset class="profile-information max-w-admin-web edit-inputs edit-textarea-big request-edit-comment">
            <x-fields.textarea wire="internal_notes" id="internal_notes" name="internal_notes" placeholder="{{__('admin/animals.internal_notes')}}" >
                {{__('admin/animals.internal_notes')}}
            </x-fields.textarea>
            <x-fields.textarea wire="modification_request" id="modification_request" name="modification_request" placeholder="{{__('admin/animals.modification_request')}}" >
                {{__('admin/animals.modification_request')}}
            </x-fields.textarea>
        </fieldset>

        <div class=" max-w-admin-web volunteer-buttons top-row profile-information">
            @can('updateLimited', $animal)
            <x-select select_name="published_animal" :options="$published_animal_options" wire="published_animal" label="{{__('admin/animals.published_animal')}}*">
            </x-select>
            @endcan
            <x-admin.form-button>
                {{__('admin/animals.save')}}
            </x-admin.form-button>
        </div>
    </form>
    @endcan
</main>

{{--

isPreviewable()  ->  TemporaryUploadedFile (namespace Livewire\Features\SupportFileUploads)
https://livewire.laravel.com/docs/4.x/uploads#handling-multiple-files
https://livewire.laravel.com/docs/4.x/uploads#temporary-preview-urls


--}}
