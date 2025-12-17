{{--
@php
    $role_options = [
        [
            'name' => 'Admin',
        'value' =>'admin',
        ],
        [
            'name' => 'Bénévole',
        'value' =>'volunteer',
        ],
]

@endphp
--}}

<main class="main-container" id="content">
    <x-page-bar>
        {{"Thomas"}}
    </x-page-bar>

    <section class="profile-information max-w-admin-web">
        <h2 aria-level="2" class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </h2>
        <dl class="information-list volunteer-info">
            <div>
                <x-definition-term>
                    {{__('admin/volunteers.firstname')}}
                </x-definition-term>
                <x-definition>
                    Elise
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.lastname')}}
                </x-definition-term>
                <x-definition>
                    Lambot
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.email')}}
                </x-definition-term>
                <x-definition>
                    elise@gmail.com
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.phone_number')}}
                </x-definition-term>
                <x-definition>
                    038847492
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.role')}}
                </x-definition-term>
                <x-definition>
                    Bénévole
                </x-definition>

{{--                <x-definition>
                        <x-select select_name="admin" label="Role" :options="$role_options"/>
                </x-definition>--}}
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.profile_image')}}
                </x-definition-term>
                <x-definition>
                    <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
                </x-definition>
            </div>
        </dl>

    </section>

        <section class="profile-information max-w-admin-web volunteer-times">
            <h2 aria-level="2" class="fw-700 admin-dashboard-title availabilities">
                {{__('admin/volunteers.availability_of')}}
            </h2>

            <div class="days-times">
                <x-fields.availability-input name="monday" id="monday" value="" placeholder="10-17h" wire="monday">
                    Lundi
                </x-fields.availability-input>
                <x-fields.availability-input name="tuesday" id="tuesday" value="" placeholder="10-17h" wire="tuesday">
                    Mardi
                </x-fields.availability-input>
                <x-fields.availability-input name="wednesday" id="wednesday" value="" placeholder="10-17h" wire="wednesday">
                    Mercredi
                </x-fields.availability-input>
                <x-fields.availability-input name="thursday" id="thursday" value="" placeholder="10-17h" wire="thursday">
                    Jeudi
                </x-fields.availability-input>
                <x-fields.availability-input name="friday" id="friday" value="" placeholder="10-17h" wire="friday">
                    Vendredi
                </x-fields.availability-input>
                <x-fields.availability-input name="saturday" id="saturday" value="" placeholder="10-17h" wire="saturday">
                    Samedi
                </x-fields.availability-input>
                <x-fields.availability-input name="sunday" id="sunday" value="" placeholder="10-17h" wire="sunday">
                    Dimanche
                </x-fields.availability-input>
            </div>
        </section>


        <div class=" max-w-admin-web volunteer-buttons">
            <div class="top-row">
                <x-admin.admin-button href="{{route('pages::profile.index', ['locale' => __('general.currentLocale')])}}"
                                      title="modifier les données" class="">
                    {{__('admin/volunteers.modify_info')}}
                </x-admin.admin-button>

                <form wire:submit="destroy" method="post">
                    @csrf
                    <x-admin.admin-button href="{{route('pages::profile.index', ['locale' => __('general.currentLocale')])}}"
                                          title="Supprimer la personne" class="delete_background delete-button">
                        {{__('admin/volunteers.delete_info')}}
                    </x-admin.admin-button>
                </form>
            </div>
        </div>

</main>
