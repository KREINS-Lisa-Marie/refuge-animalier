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
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="Image avec deux chiens" width="948" height="911" class="front-image">
    </section>
    <section class="section background-dark p-l-r-24 p-t-b-60-150 flex-cr d-flex wrap-reverse flex-gap-32 title-text-img">
        <div class="title-text">
            <h2 class=" page-title p-b-32 fw-700 t-a-center color-dark">
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

    <section class="p-t-b-60-150 background-light p-l-r-24 fs-texte home-adoption-section">
        <h2 class="page-title fw-700 p-b-32 t-a-center color-dark">
            Adoptez-nous
        </h2>

        <div class="d-flex max-w-web margin-l-r-auto">
            <x-cards petname="Balou" petstatus="A adopter" petage="6 ans" petrace="Frenchie" petsex="Masculin"/>
        </div>

    </section>
    <section class="p-t-b-60-150 p-l-r-24 fs-texte d-flex flex-gap-32 flex-cr more-info-section max-w-web margin-l-r-auto">
        <div class="">
            <h2 class="page-title fw-700 p-b-32 t-a-center color-dark">
                Besoin de plus d’infos?
            </h2>
            <p class="interl-text fs-texte m-b-32">
                Si vous avez besoin de plus d’informations sur le processus d’adoption, votre demande d’adoption en cours, si vous voulez devenir bénévole ou si vous avez besoin de plus d’informations générales, contactez-nous via notre formulaire de contact
            </p>
            <a href="/contact.blade.php" title="aller vers la page de Contact" class="public-button fs-button border-r-big ">
                Contactez-nous
            </a>
        </div>
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="Image avec deux chiens" width="948" height="911" class="m-l-auto d-block border-r-small">
    </section>
@endcomponent
