@php
    $state_options = [
        [
            'name' => 'Refusée',
            'value' =>'refusée',
        ],
        [
            'name' => 'Adopté',
            'value' =>'adopté',
        ],
                [
            'name' => 'En cours d’adoption',
            'value' =>'en cours d’adoption',
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
        {{__('admin/adoption-requests.new_adoption_request')}}
    </x-page-bar>

    <form wire:submit="save" class="profile-form volunteers-edit ">
        @csrf
        <fieldset class="profile-information max-w-admin-web  edit-inputs requests-fields">
            <legend class="fw-700 admin-dashboard-title">
                {{__('admin/animals.general_information')}}
            </legend>
            <x-fields.text id="adoptant-last-name" name="adoptant-last-name" value="" placeholder="Ex: John" wire="last_name">
                {{__('admin/adoption-requests.adoptant_last_name')}}
            </x-fields.text>
            <x-fields.text id="adoptant-first-name" name="adoptant-first-name" value="" placeholder="Ex: John" wire="first_name">
                {{__('admin/adoption-requests.adoptant_first_name')}}
            </x-fields.text>
            <x-fields.text id="adress" name="adress" value="" placeholder="Ex: Rue de l’école 3, 4000 Liège" wire="address">
                {{__('admin/adoption-requests.adress')}}
            </x-fields.text>
            <x-fields.email value="" wire="email">
                {{__('admin/adoption-requests.email')}}
            </x-fields.email>
            <x-fields.phone wire="phone" name="adoptant-phone" id="adoptant-phone" value="" placeholder="038948927">
                {{__('admin/adoption-requests.phone')}}
            </x-fields.phone>
            <x-select select_name="animal_name" label="{{__('admin/adoption-requests.animal_name')}}" :options="$animal_options" wire="animal_id"/>
            <x-fields.textarea wire="message" id="adoption-message" name="adoption-message" placeholder="Bonjour, Je voudrais bien rencontrer Jimmy." old_values="">
                {{__('admin/adoption-requests.adoption_message')}}
            </x-fields.textarea>
            <x-select select_name="state" label="{{__('admin/adoption-requests.state')}}" :options="$state_options" wire="state"/>
        </fieldset>
        <fieldset class="profile-information max-w-admin-web  edit-inputs ">
            <x-fields.textarea wire="comment" id="adoption-comment" name="adoption-comment" placeholder="Camille semble sérieux. La rencontre s'est bien passée." old_values="">
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
