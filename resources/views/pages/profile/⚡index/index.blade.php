<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/profile.profile')}}
    </x-page-bar>
    <div class="admin-filters-buttons max-w-admin-web">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::profile.index', ['locale' => __('general.currentLocale')])}}"
                                  title="Ouvrir les emails" class="">
                {{__('admin/profile.modify_info')}}
            </x-admin.admin-button>

            <form wire:submit="destroy" method="post">
                @csrf
                <x-admin.admin-button href="{{route('pages::profile.index', ['locale' => __('general.currentLocale')])}}"
                                      title="Supprimer mon compte" class="delete_background delete-button">
                    {{__('admin/profile.delete_info')}}
                </x-admin.admin-button>
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
                    Elise Lambot
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.email')}}
                </x-definition-term>
                <x-definition>
                    elise@gmail.com
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.phone_number')}}
                </x-definition-term>
                <x-definition>
                    038847492
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.password')}}
                </x-definition-term>
                <x-definition>
                    {{__('admin/profile.change_my_password')}}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/profile.image')}}
                </x-definition-term>
                <x-definition>
                    <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small">
                </x-definition>
            </div>
        </dl>

        <div>
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>

            <a href="{{route("pages::profile.index", ['locale' => __('general.currentLocale')])}}" class="change_language_link">
                {{__('admin/profile.change_language')}}
            </a>
        </div>

    </section>
</main>
