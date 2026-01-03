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
        {{__('admin/adoption-requests.modify_a_request')}}
    </x-page-bar>

    <form wire:submit="save" class="profile-form volunteers-edit">
        @csrf
        <fieldset class="profile-information max-w-admin-web  edit-inputs ">
            <legend class="fw-700 admin-dashboard-title">
                {{__('admin/animals.general_information')}}
            </legend>
            <x-fields.text id="adoptant-last-name" name="adoptant-last-name"  placeholder="Ex: John" wire="last_name" value="{!! $request->last_name !!}">
                {{__('admin/adoption-requests.adoptant_last_name')}}
            </x-fields.text>
            <x-fields.text id="first_name" name="adoptant-first-name"  placeholder="Ex: John" wire="first_name" value="{!! $request->first_name !!}">
                {{__('admin/adoption-requests.adoptant_first_name')}}
            </x-fields.text>
            <x-fields.text id="address" name="address"  placeholder="Ex: Rue de l’école 3, 4000 Liège" wire="address">
                {{__('admin/adoption-requests.adress')}}
            </x-fields.text>
            <x-fields.phone wire="phone" name="adoptant-phone" id="adoptant-phone" placeholder="038948927" value="{!! $request->phone !!}">
                {{__('admin/adoption-requests.phone')}}
            </x-fields.phone>
            <x-select select_name="animal_name" label="{{__('admin/adoption-requests.animal_name')}}" :options="$animal_options" wire="animal_id"/>

            <x-fields.textarea wire="message" id="adoption-message" name="message" placeholder="Bonjour, Je voudrais bien rencontrer Jimmy." old_values="">
                {{__('admin/adoption-requests.adoption_message')}}
            </x-fields.textarea>
            <x-select select_name="state" label="{{__('admin/adoption-requests.state')}}" :options="$state_options" wire="state"/>
        </fieldset>
        <fieldset class="profile-information max-w-admin-web  edit-inputs ">
            <x-fields.textarea wire="comment" id="adoption-comment" name="adoption-comment" placeholder="Camille semble sérieux. La rencontre s'est bien passée." >
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
