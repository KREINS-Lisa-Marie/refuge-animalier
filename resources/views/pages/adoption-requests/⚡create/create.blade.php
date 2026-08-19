@php
    $state_options = [
        [
            'name' => __('admin/adoption-requests.refused'),
            'value' =>'refused',
        ],
        [
            'name' => __('admin/adoption-requests.adopted'),
            'value' =>'adopted',
        ],
                [
            'name' => __('admin/adoption-requests.in_treatment'),
            'value' =>'in_treatment',
        ],
                [
            'name' => __('admin/adoption-requests.not_treated_yet'),
            'value' =>'not_treated_yet',
        ],
];

    $animals= \App\Models\Animal::where('state', 'adoptable')->get();

    $animal_options = [];
        foreach($animals as $animal){
           $animal_options[] = [
            'name' => $animal->animal_name,
            'value' =>$animal->id,
        ];
        }

@endphp

<main class="main-container admin" id="content">
    @can('create', \App\Models\Request::class)
    <x-page-bar>
        {{__('admin/adoption-requests.new_adoption_request')}}
    </x-page-bar>

    <form wire:submit="save" class="admin-form volunteers-edit ">
        @csrf
        <fieldset class=" max-w-admin-web  edit-inputs requests-fields m-t-80">
            <legend class="profile-information fw-700 admin-dashboard-title">
                {{__('admin/animals.general_information')}}
            </legend>
            <p class="profile-information obligations m-b-32 ">
                {{__('admin/general.mandatory_field')}}
            </p>
            <div class="profile-information request-form-fields d-flex flex-r flex-wrap edit-inputs flex-gap-24">
                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <x-fields.text id="last_name" name="last_name" value="" placeholder="Ex: John" wire="last_name">
                        {{__('admin/adoption-requests.adoptant_last_name')}}*
                    </x-fields.text>
                    <x-fields.text id="first_name" name="first_name" value="" placeholder="Ex: John" wire="first_name">
                        {{__('admin/adoption-requests.adoptant_first_name')}}*
                    </x-fields.text>
                    <x-fields.text id="address" name="address" value="" placeholder="Ex: Rue de l’école 3, 4000 Liège"
                                   wire="address">
                        {{__('admin/adoption-requests.adress')}}
                    </x-fields.text>
                    <x-fields.email value="" wire="email">
                        {{__('admin/adoption-requests.email')}}*
                    </x-fields.email>
                </div>
                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <x-fields.phone wire="phone" name="phone" id="phone" value="" placeholder="038948927">
                        {{__('admin/adoption-requests.phone')}}*
                    </x-fields.phone>
                    <x-select select_name="animal_id" label="{{__('admin/adoption-requests.animal_name')}}"
                              :options="$animal_options" wire="animal_id"/>
                    <x-select select_name="state" label="{{__('admin/adoption-requests.state')}}*" :options="$state_options" wire="state"/>
                </div>
                <div class="d-flex flex-dir flex-gap-24 col-inputs">
                    <x-fields.textarea wire="message" id="message" name="message"
                                       placeholder="{{__('admin/adoption-requests.placeholder_message')}}"
                                       old_values="">
                        {{__('admin/adoption-requests.adoption_message')}}
                    </x-fields.textarea>
                </div>

            </div>
        </fieldset>
        <fieldset class="profile-information max-w-admin-web edit-inputs edit-textarea-big request-edit-comment ">
            <x-fields.textarea wire="comment" id="comment" name="comment" placeholder="{{__('admin/adoption-requests.placeholder_comment')}}" old_values="">
                {{__('admin/adoption-requests.adoption_comment')}}
            </x-fields.textarea>
        </fieldset>

        <div class="profile-information max-w-admin-web volunteer-buttons top-row">
            <x-admin.form-button>
                {{__('admin/animals.save')}}
            </x-admin.form-button>
        </div>
    </form>
    @endcan
</main>
