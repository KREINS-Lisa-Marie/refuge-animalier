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
    <div class="max-w-admin-web return-admin">
        <x-public.return-button></x-public.return-button>
    </div>

    <section class="section-w-return max-w-admin-web">
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
                    <a href="mailto:{!! $volunteer->email !!}" title="{{__('admin/contacts.send_mail_to')}}">
                        {!! $volunteer->email !!}
                    </a>
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/volunteers.phone_number')}}
                </x-definition-term>
                <x-definition>
                    <a href="tel:{!! $volunteer->phone !!}" title="{{__('admin/contacts.call')}}">
                        {!! $volunteer->phone !!}
                    </a>
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
                    <img src="{!! asset('assets/img/frenchie.png') !!}" alt="{{__('admin/volunteers.profile_image')}}" class="border-r-small profile-img">
                </x-definition>
            </div>
        </dl>

    </section>

        <section class="profile-information max-w-admin-web volunteer-times">
            <h2 aria-level="2" class="fw-700 admin-dashboard-title availabilities">
                {{__('admin/volunteers.availability_of')}}{!! $volunteer->first_name !!}
            </h2>
                <x-fields.availability-timetable availabilities="{{$availabilities}}">
                </x-fields.availability-timetable>
        </section>


        <div class=" max-w-admin-web volunteer-buttons">
            <div class="top-row">
                <x-admin.admin-button href="{{route('pages::volunteers.edit', ['locale' => app()->getLocale(), 'volunteer' => $volunteer])}}"
                                      title="{{__('admin/volunteers.modify_info')}}" class="">
                    {{__('admin/volunteers.modify_info')}}
                </x-admin.admin-button>

                <form wire:submit="destroy" method="post">
                    @csrf
                    <x-admin.form-button title="{{__('admin/volunteers.delete_info')}}" class="delete_background delete-button">
                        {{__('admin/volunteers.delete_info')}}
                    </x-admin.form-button>

                </form>
            </div>
        </div>

</main>
