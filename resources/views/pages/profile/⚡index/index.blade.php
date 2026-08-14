<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/profile.profile')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::profile.edit', ['locale' => __('general.currentLocale'),  $user->id,])}}" title=" {{__('admin/profile.open_mails')}}" class="">
                {{__('admin/profile.modify_info')}}
            </x-admin.admin-button>

            <form wire:submit="destroy" method="post">
                @csrf
                <x-admin.form-button title="{{__('admin/profile.delete_account')}}" class="delete_background delete-button">
                    {{__('admin/profile.delete_info')}}
                </x-admin.form-button>
            </form>
        </div>
    </div>
    <section class="profile-information max-w-admin-web">
        <h2 class="sro" aria-level="2">
            {{__('admin/profile.profile_information')}}
        </h2>
        <dl class="information-list">
            <div>
                <x-definition-term>
                    {{__('admin/profile.complete_name')}}
                </x-definition-term>
                <x-definition>
                    {!! $user->first_name !!} {!! $user->last_name !!}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.email')}}
                </x-definition-term>
                <x-definition>
                    <a href="mailto:{!! $user->email !!}" title="{{__('admin/contacts.send_mail_to')}}">
                        {!! $user->email !!}
                    </a>
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.phone_number')}}
                </x-definition-term>
                <x-definition>
                    <a href="tel:{!! $user->phone !!}" title="{{__('admin/contacts.call')}}">
                        {!! $user->phone !!}
                    </a>
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.password')}}
                </x-definition-term>
                <x-definition>
                    <a href="{{route('pages::profile.edit', ['locale' => __('general.currentLocale'),  $user->id,])}}" title=" {{__('admin/profile.change_my_password')}}" class="">{{__('admin/profile.change_my_password')}}</a>
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.image')}}
                </x-definition-term>
                <x-definition>
                    @if($user->profile_image)
                        <img src="{!! asset('storage/images/users/variants/300x300/'.basename($user->profile_image)) !!}" alt="{{__('admin/volunteers.profile_image')}}"
                             class="border-r-small profile-img">
                    @else
                        <img src="{!! asset('assets/img/default.jpg') !!}" alt="{{__('admin/volunteers.profile_image')}}"
                             class="border-r-small profile-img">
                    @endif
                </x-definition>
            </div>
        </dl>

        <div>
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
           <x-admin.language-switch/>
        </div>

    </section>
</main>
