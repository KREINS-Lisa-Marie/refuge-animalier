@component('layouts.app')

    <section class="p-b-60 first-section">
        <div class="p-l-r-24">
            <h2 class="homepage-title m-t-60 m-b-16">
                LES PATTES HEUREUSES
            </h2>
            <p class="interl-text fs-texte">
                Ici nous soignons et donnent de l’espoir aux animaux abandonnés ou maltraités de la région de Malmedy et
                ses environs.
            </p>
        </div>
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="Image avec deux chiens" width="948" height="911">
    </section>
    <section class="section background-dark p-l-r-24 p-t-b-60 d-flex wrap-reverse flex-gap-32 ">
        <div class="title-text">
            <h2 class=" page-title p-b-32 fw-700 t-a-center">
                Là où chaque patte compte
            </h2>
            <p class="interl-text fs-texte">
                Depuis 15 ans, le refuge "Les Pattes Heureuses" accueille et soigne les animaux abandonnés ou maltraités
                de Malmedy et ses environs. Fondé par Élise Lambot, le refuge offre un havre de paix où compassion et
                engagement se rencontrent. Chiens, chats et petits rongeurs y trouvent soins, chaleur et amour, en
                attendant une nouvelle famille, grâce à une équipe passionnée et au soutien des adoptants et donateurs.
            </p>
        </div>
        <img src="{!! asset('assets/img/patte.jpg') !!}" alt="image du chien" width="328" height="328" class="border-r-small">
    </section>

    <section class="p-t-b-60 background-light p-l-r-24 fs-texte">
        <h2 class="page-title fw-700 p-b-32 t-a-center">
            Adoptez-nous
        </h2>
{{--        @component('components.cards', ['petname'=> "Balou", 'petstatus' => 'A adopter', 'petage' => '6 ans', 'petrace' => 'Frenchie', 'petsex' => 'Masculin' ])
        @endcomponent--}}

        <x-cards petname="Balou" petstatus="A adopter" petage="6 ans" petrace="Frenchie" petsex="Masculin"/>
        {{--<x-cards petname="Balou" />--}}
{{--        <div class="card">
            <img src="" alt="">
            <div>
                <div class="d-flex flex-r flex-j-c-space-between flex-a-i-center pb-24">
                    <p class="card-petname fw-700 d-block">
                        Balou
                    </p>
                    <p class="d-block border-1-dark p-lr-24-tb-8 border-r-big">
                        A adopter
                    </p>
                </div>
                <div class="infos p-b-32">
                    <p class="pb-16">
                        6 ans
                    </p>
                    <p class="pb-16">
                        Frenchie
                    </p>
                    <p>
                        Masculin
                    </p>
                </div>
                <a href="" class="d-flex flex-r flex-a-i-center flex-j-c-end fw-700">
                    Voir plus d'infos
                    <svg width="35" height="26" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 35 26"
                         class="arrow_discover color-dark p-l-8">
                        <path class="st0" d="M2.2,13.3h28M30.2,13.3L16.2,2.3M30.2,13.3l-14,11.1"/>
                    </svg>
                </a>
            </div>
        </div>--}}
    </section>
    <section class="p-t-b-60 p-l-r-24 fs-texte d-flex flex-gap-32 flex-cr">
        <div class="">
            <h2 class="page-title fw-700 p-b-32 t-a-center">
                Besoin de plus d’infos?
            </h2>
            <p class="interl-text fs-texte m-b-32">
                Si vous avez besoin de plus d’informations sur le processus d’adoption, votre demande d’adoption en cours, si vous voulez devenir bénévole ou si vous avez besoin de plus d’informations générales, contactez-nous via notre formulaire de contact
            </p>
            <a href="/contact.blade.php" title="aller vers la page de Contact" class="public-button fs-button border-r-big ">
                Contactez-nous
            </a>
        </div>
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="Image avec deux chiens" width="948" height="911" class="m-l-auto d-block">
    </section>
@endcomponent
