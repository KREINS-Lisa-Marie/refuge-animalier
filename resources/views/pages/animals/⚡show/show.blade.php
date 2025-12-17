<main class="main-container" id="content">
    <x-page-bar>
        {{"Thomas"}}
    </x-page-bar>

    <section class="profile-information max-w-admin-web">
        <h2 aria-level="2" class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </h2>
        <dl class="animal-information-list volunteer-info">
            <div>
                <x-definition-term>
                    {{__('admin/animals.animal_name')}}
                </x-definition-term>
                <x-definition>
                    Bobby
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.species')}}
                </x-definition-term>
                <x-definition>
                    Border collie
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.sex')}}
                </x-definition-term>
                <x-definition>
                    Masculin
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.fur')}}
                </x-definition-term>
                <x-definition>
                    Brun-blanc
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.age')}}
                </x-definition-term>
                <x-definition>
                    3 ans
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.vaccination')}}
                </x-definition-term>
                <x-definition>
                    rage
                </x-definition>
            </div>

            <div class="animal-description">
                <x-definition-term>
                    {{__('admin/animals.description')}}
                </x-definition-term>
                <x-definition>
                    Ce magnifique Border Collie est un chien à la fois doux, affectueux et plein d’énergie !
                    Toujours partant pour jouer ou partir en balade, il aura besoin d’une famille active qui saura lui offrir de longues promenades et des moments de stimulation mentale. Très sociable et patient avec les enfants, il fera un excellent compagnon pour une famille dynamique. En revanche, il ne conviendra pas vraiment à des personnes âgées. Il se retrouve aujourd’hui au refuge suite à la séparation de ses anciens propriétaires, et cherche désormais un nouveau foyer aimant où il pourra s’épanouir.
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.character')}}
                </x-definition-term>
                <x-definition>
                    Doux, mais très actif
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.state')}}
                </x-definition-term>
                <x-definition>
                    A adopter
                </x-definition>
            </div>
            <div>
                <x-definition-term>
                    {{__('admin/animals.animal_image')}}
                </x-definition-term>
                <x-definition>
                    <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
                </x-definition>
            </div>
        </dl>

    </section>

    <section class=" max-w-admin-web volunteer-times">
        <h2 aria-level="2" class="fw-700 admin-dashboard-title availabilities m-l-r-24">
            {{__('admin/animals.gallery')}}
        </h2>

        <div class="animals-gallery ">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image de profile" class="border-r-small profile-img">

        </div>
    </section>

    <div class=" max-w-admin-web volunteer-buttons m-lr-24">
        <div class="top-row">
            <x-admin.admin-button href="{{route('pages::profile.index', ['locale' => __('general.currentLocale')])}}"
                                  title="modifier les données" class="">
                {{__('admin/animals.modify_animal')}}
            </x-admin.admin-button>

            <form wire:submit="destroy" method="post">
                @csrf
                <x-admin.admin-button href="{{route('pages::profile.index', ['locale' => __('general.currentLocale')])}}"
                                      title="Supprimer la personne" class="delete_background delete-button">
                    {{__('admin/animals.delete_animal')}}
                </x-admin.admin-button>
            </form>
        </div>
    </div>
</main>
