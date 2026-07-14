@php
    $animal = \App\Models\Animal::findOrFail($animal_id);
@endphp

<main class="main-container" id="content">
    <x-page-bar>
        {{ $animal->animal_name }}
    </x-page-bar>
    <div class="max-w-admin-web return-admin">
        <x-public.return-button></x-public.return-button>
    </div>


    <section class="section-w-return max-w-admin-web">
        <h2 aria-level="2" class="fw-700 admin-dashboard-title">
            {{__('admin/volunteers.general_information')}}
        </h2>
        <dl class="animal-information-list volunteer-info">
            <div>
                <x-definition-term>
                    {{__('admin/animals.animal_name')}}
                </x-definition-term>
                <x-definition>
                   {{ $animal->animal_name }}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.species')}}
                </x-definition-term>
                <x-definition>
                    {{ $animal->species  == 'dog'? __('admin/animals.dog') : ($animal->species  == 'cat'? __('admin/animals.cat') : ($animal->species  == 'bunny'? __('admin/animals.bunny') : __('admin/animals.hamster'))) }}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.sex')}}
                </x-definition-term>
                <x-definition>
                    {{ $animal->sex  =='male' ? __('admin/animals.male') : __('admin/animals.female') }}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.fur')}}
                </x-definition-term>
                <x-definition>
                    {{ $animal->fur }}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.age')}}
                </x-definition-term>
                <x-definition>
                    {{ $age }} an(s)
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.vaccination')}}
                </x-definition-term>
                <x-definition>
                    {{ $animal->vaccinations }}
                </x-definition>
            </div>

            <div class="animal-description">
                <x-definition-term>
                    {{__('admin/animals.description')}}
                </x-definition-term>
                <x-definition>
                    {{ $animal->description }}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.character')}}
                </x-definition-term>
                <x-definition>
                    {{ $animal->character }}
                </x-definition>
            </div>

            <div>
                <x-definition-term>
                    {{__('admin/animals.state')}}
                </x-definition-term>
                <x-definition>
                   {{ $animal->state == 'processing_adoption'? __('admin/animals.processing_adoption') : ($animal->state == 'adopted'? __('admin/animals.adopted'): ($animal->state == 'in_treatment'? __('admin/animals.in_treatment') : __('admin/animals.adoptable') ))}}
                </x-definition>
            </div>
            <div>
                <x-definition-term>
                    {{__('admin/animals.animal_image')}}
                </x-definition-term>
                <x-definition>
                    <img src="{!! asset('assets/img/frenchie.png') !!}" alt="{{__('admin/animals.animal_image')}}" class="border-r-small profile-img">
                </x-definition>
            </div>
        </dl>

    </section>

    <section class=" max-w-admin-web volunteer-times">
        <h2 aria-level="2" class="fw-700 admin-dashboard-title availabilities m-l-r-24">
            {{__('admin/animals.gallery')}}
        </h2>

        <div class="animals-gallery ">
            <img src="{!! asset('assets/img/frenchie.png') !!}" alt="{{__('admin/animals.animal_image')}}" class="border-r-small profile-img">
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
            <x-admin.admin-button href="{{route('pages::animals.edit', ['locale' => __('general.currentLocale'),  'animal'=> $animal])}}"
                                  title="{{__('admin/animals.modify_animal')}}" class="">
                {{__('admin/animals.modify_animal')}}
            </x-admin.admin-button>

            <form wire:submit="destroy" method="post">
                @csrf
                <x-admin.form-button title="{{__('admin/animals.delete_animal')}}" class="delete_background delete-button">
                    {{__('admin/animals.delete_animal')}}
                </x-admin.form-button>
            </form>
        </div>
    </div>
</main>
