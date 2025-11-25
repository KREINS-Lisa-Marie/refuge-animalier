@component('layouts.app')

    <div class="max-w-web margin-l-r-auto">
        <a href="{{route('public.animals')}}" class="return-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="18" viewBox="0 0 23 18" fill="none">
                <path
                    d="M21.6445 8.58464L0.999944 8.58463M0.999944 8.58463L11.3222 16.168M0.999944 8.58463L11.3222 1.0013"
                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Retour
        </a>
    </div>
    <section class="p-l-r-24 m-t-110 m-b-60-150">
        <div class="animal-description-img d-flex flex-cr flex-wrap max-w-web margin-l-r-auto">
            <div>
                <h2 class="page-title fw-700 color-dark">
                    Bobby
                </h2>
                <p class="interl-text animal-description">
                    Ce magnifique Border Collie est un chien à la fois doux, affectueux et plein d’énergie&nbsp;!
                    Toujours partant pour jouer ou partir en balade, il aura besoin d’une famille active qui saura lui offrir de longues promenades et des moments de stimulation mentale. Très sociable et patient avec les enfants,
                    il fera un excellent compagnon pour une famille dynamique. En revanche, il ne conviendra pas vraiment à
                    des personnes âgées. Il se retrouve aujourd’hui au refuge suite à la séparation de ses anciens
                    propriétaires, et cherche désormais un nouveau foyer aimant où il pourra s’épanouir.
                </p>
            </div>
            <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class="animal-img border-r-small border-xl"  width="327" height="327">
        </div>
        <div class="animal-section max-w-web margin-l-r-auto ">
            <dl class="fs-texte dl:last-child max-h-384 d-flex flex-c flex-wrap">
                <x-definition-term>
                    Race
                </x-definition-term>
                <x-definition>
                    Border collie
                </x-definition>

                <x-definition-term>
                    Sexe
                </x-definition-term>
                <x-definition>
                    Masculin
                </x-definition>

                <x-definition-term>
                    Pelage
                </x-definition-term>
                <x-definition>
                    Brun-blanc
                </x-definition>

                <x-definition-term>
                    Age
                </x-definition-term>
                <x-definition>
                    4 ans
                </x-definition>

                <x-definition-term>
                    Vaccins
                </x-definition-term>
                <x-definition>
                    rage
                </x-definition>

                <x-definition-term>
                    Caractère
                </x-definition-term>
                <x-definition>
                    Doux, mais très actif
                </x-definition>

            </dl>
            <p class="animal-state fw-700 p-16-32 background-light d-i-block border-r-big m-b-32">
                A adopter
            </p>
        </div>
{{--        <a href="{{route('public.contact')}}" title="Aller vers la page Contact">
            Demander de rencontrer Balou
        </a>--}}
    </section>
    <section class="background-light p-l-r-24 p-b-60-150">
        <h2 class="page-title fw-700 max-w-web margin-l-r-auto">
            Galerie de Balou
        </h2>
        <ul class="m-t-32 d-flex flex-r flex-gap-32 flex-wrap max-w-web margin-l-r-auto">
            <li class="flex-gap-32 ">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class="border-r-small border-xl"  width="300" height="300">
            </li>
            <li class="flex-gap-32">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class="border-r-small border-xl"  width="300" height="300">
            </li>
            <li class="flex-gap-32">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class="border-r-small border-xl"  width="300" height="300">
            </li>
        </ul>
    </section>

@endcomponent
