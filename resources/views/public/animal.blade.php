@component('layouts.app')

    <a href="{{route('public.animals')}}" class=""><svg xmlns="http://www.w3.org/2000/svg" width="23" height="18" viewBox="0 0 23 18" fill="none">
            <path d="M21.6445 8.58464L0.999944 8.58463M0.999944 8.58463L11.3222 16.168M0.999944 8.58463L11.3222 1.0013" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg> Retour</a>
    <section class="">
        <div class="">
            <div>
                <h2 class="">
                    Bobby
                </h2>
                <p class="">
                    Ce magnifique Border Collie est un chien à la fois doux, affectueux et plein d’énergie&nbsp;!
                    Toujours partant pour jouer ou partir en balade, il aura besoin d’une famille active qui saura lui offrir de longues promenades et des moments de stimulation mentale. Très sociable et patient avec les enfants,
                    il fera un excellent compagnon pour une famille dynamique. En revanche, il ne conviendra pas vraiment à
                    des personnes âgées. Il se retrouve aujourd’hui au refuge suite à la séparation de ses anciens
                    propriétaires, et cherche désormais un nouveau foyer aimant où il pourra s’épanouir.
                </p>
            </div>
            <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class=""  width="327" height="327">
        </div>
        <div class="">
            <dl class="">
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
            <p class="">
                A adopter
            </p>
        </div>
{{--        <a href="{{route('public.contact')}}" title="Aller vers la page Contact">
            Demander de rencontrer Balou
        </a>--}}
    </section>
    <section class="">
        <h2 class="">
            Galerie de Balou
        </h2>
        <ul class="">
            <li class="">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class=""  width="300" height="300">
            </li>
            <li class="flex-gap-32">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class=""  width="300" height="300">
            </li>
            <li class="flex-gap-32">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien" class=""  width="300" height="300">
            </li>
        </ul>
    </section>

@endcomponent
