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
        {!! $volunteer->first_name !!}  {!! $volunteer->last_name !!}
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
                    {!! $volunteer->first_name !!}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.lastname')}}
                </x-definition-term>
                <x-definition>
                    {!! $volunteer->last_name !!}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.email')}}
                </x-definition-term>
                <x-definition>
                    {!! $volunteer->email !!}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.phone_number')}}
                </x-definition-term>
                <x-definition>
                    {!! $volunteer->phone !!}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.role')}}
                </x-definition-term>
                <x-definition>
                    {!! $volunteer->is_admin? __('admin/volunteers.admin'): __('admin/volunteers.volunteer') !!}
                </x-definition>
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
                {{__('admin/volunteers.availability_of')}}{!! $volunteer->first_name !!}
            </h2>


                <dl class= "days-times max-w-web flex-j-c-start phone-flex">
                    <div>
                        <dt class="field__label" wire="monday">
                            {{__('admin/volunteers.monday')}}
                        </dt>
                        <dd class="availability-input t-a-center min-w-130" name="monday" id="monday" wire="monday">
                            {{ $availabilities->monday??'/' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="field__label" wire="tuesday">
                            {{__('admin/volunteers.tuesday')}}
                        </dt>
                        <dd class="availability-input t-a-center min-w-130" name="tuesday" id="tuesday" wire="tuesday">
                            {{ $availabilities->tuesday??'/' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="field__label" wire="wednesday">
                            {{__('admin/volunteers.wednesday')}}
                        </dt>
                        <dd class="availability-input t-a-center min-w-130" name="wednesday" id="wednesday" wire="wednesday">
                            {{ $availabilities->wednesday??'/' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="field__label" wire="thursday">
                            {{__('admin/volunteers.thursday')}}
                        </dt>
                        <dd class="availability-input t-a-center min-w-130" name="thursday" id="thursday" wire="thursday">
                            {{ $availabilities->thursday??'/' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="field__label" wire="friday">
                            {{__('admin/volunteers.friday')}}
                        </dt>
                        <dd class="availability-input t-a-center min-w-130" name="friday" id="friday" wire="friday">
                            {{ $availabilities->friday??'/' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="field__label">
                            {{__('admin/volunteers.saturday')}}
                        </dt>
                        <dd class="availability-input t-a-center min-w-130" name="saturday" id="saturday" wire="saturday">
                            {{ $availabilities->saturday??'/' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="field__label">
                            {{__('admin/volunteers.sunday')}}
                        </dt>
                        <dd class="availability-input t-a-center min-w-130" name="sunday" id="sunday" wire="sunday">
                            {{ $availabilities->sunday??'/' }}
                        </dd>
                    </div>
                </dl>
        </section>


        <div class=" max-w-admin-web volunteer-buttons">
            <div class="top-row">
                <x-admin.admin-button href="{{route('pages::volunteers.edit', ['locale' => __('general.currentLocale'), 'volunteer' => $volunteer])}}"
                                      title="modifier les données" class="">
                    {{__('admin/volunteers.modify_info')}}
                </x-admin.admin-button>

                <form wire:submit="destroy" method="post">
                    @csrf
                    <x-admin.form-button title="Supprimer la personne" class="delete_background delete-button">
                        {{__('admin/volunteers.delete_info')}}
                    </x-admin.form-button>

                </form>
            </div>
        </div>

</main>
