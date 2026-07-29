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

<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/adoption-requests.modify_a_request')}}
    </x-page-bar>

    <form wire:submit="save" class="profile-form volunteers-edit">
        @csrf
        <fieldset class="profile-information max-w-admin-web  edit-inputs ">
            <legend class="fw-700 admin-dashboard-title">
                {{__('admin/animals.general_information')}}
            </legend>
            <p class="obligations m-b-32 ">
                {{__('admin/general.mandatory_field')}}
            </p>
            <div class="profile-information">
                <div class="d-flex flex-r flex-wrap edit-inputs flex-gap-24">
                    <div class="d-flex flex-dir flex-gap-24 col-inputs">
                <x-fields.text id="last_name" name="last_name" placeholder="Ex: John" wire="last_name"
                               value="{!! $request->last_name !!}">
                    {{__('admin/adoption-requests.adoptant_last_name')}}*
                </x-fields.text>
                <x-fields.text id="first_name" name="first_name" placeholder="Ex: John" wire="first_name"
                               value="{!! $request->first_name !!}">
                    {{__('admin/adoption-requests.adoptant_first_name')}}*
                </x-fields.text>
                <x-fields.text id="address" name="address" placeholder="Ex: Rue de l’école 3, 4000 Liège" wire="address">
                    {{__('admin/adoption-requests.adress')}}
                </x-fields.text>
                <x-fields.email value="{!! $request->email !!}" wire="email">
                    {{__('admin/adoption-requests.email')}}*
                </x-fields.email>

                    </div>
                    <div class="d-flex flex-dir flex-gap-24 col-inputs">
                        <x-fields.phone wire="phone" name="phone" id="phone" placeholder="038948927" value="{!! $request->phone !!}">
                            {{__('admin/adoption-requests.phone')}}*
                        </x-fields.phone>
                        <x-select select_name="animal_id" label="{{__('admin/adoption-requests.animal_name')}}*"
                                  :options="$animal_options" wire="animal_id"/>
                        <x-select select_name="state" label="{{__('admin/adoption-requests.state')}}"
                                  :options="$state_options"
                                  wire="state"/>
                    </div>
                    <div class="d-flex flex-dir flex-gap-24 col-inputs">

                        <x-fields.textarea wire="message" id="message" name="message"
                                           placeholder="{{__('admin/adoption-requests.placeholder_message')}}" old_values="">
                            {{__('admin/adoption-requests.adoption_message')}}
                        </x-fields.textarea>
                    </div>
                    </div>
            </div>
        </fieldset>
        <fieldset class="profile-information max-w-admin-web edit-inputs  request-edit-comment">
            <x-fields.textarea wire="comment" id="comment" name="comment" placeholder="{{__('admin/adoption-requests.placeholder_comment')}}" >
                {{__('admin/adoption-requests.adoption_comment')}}
            </x-fields.textarea>
        </fieldset>

        <div class=" max-w-admin-web volunteer-buttons top-row">
            <x-admin.form-button>
                {{__('admin/animals.save')}}
            </x-admin.form-button>
        </div>
    </form>

</main>
