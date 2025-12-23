<x-public.app>
    <section class="p-b-60 first-section">
        <div class="p-l-r-24">
            <h2 class="homepage-title m-t-60 m-b-16">
                {{__('public/home.homepage_big_title')}}
            </h2>
            <p class="interl-text fs-texte">
                {{__('public/home.page_description')}}
            </p>
        </div>
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="Image avec deux chiens" width="948" height="911"
             class="front-image">
    </section>
    <section
        class="section background-dark p-l-r-24 p-t-b-60-150 flex-cr d-flex wrap-reverse flex-gap-32 title-text-img">
        <div class="title-text">
            <h2 class=" page-title p-b-32 fw-700 t-a-center color-dark">
                {{__('public/home.where_every_paw_counts')}}
            </h2>
            <p class="interl-text fs-texte">
                {{__('public/home.where_every_paw_counts_text')}}
            </p>
        </div>
        <img src="{!! asset('assets/img/patte.jpg') !!}" alt="image du chien" width="328" height="328"
             class="border-r-small">
    </section>

    <section class="p-t-b-60-150 background-light p-l-r-24 fs-texte home-adoption-section">
        <h2 class="page-title fw-700 p-b-32 t-a-center color-dark">
            {{__('public/home.adopt_us')}}
        </h2>

        <ul class="d-flex max-w-web margin-l-r-auto flex-gap-24 flex-wrap pet-group">
            <li>
                <x-cards petname="Balou" petstatus="A adopter" petage="6 ans" petrace="Frenchie" petsex="Masculin"/>
            </li>
            <li>
                <x-cards petname="Balou" petstatus="A adopter" petage="6 ans" petrace="Frenchie" petsex="Masculin"/>
            </li>
            <li>
                <x-cards petname="Balou" petstatus="A adopter" petage="6 ans" petrace="Frenchie" petsex="Masculin"/>
            </li>
        </ul>

    </section>
    <section
        class="p-t-b-60-150 p-l-r-24 fs-texte d-flex flex-gap-32 flex-cr more-info-section max-w-web margin-l-r-auto">
        <div class="">
            <h2 class="page-title fw-700 p-b-32 t-a-center color-dark">
                {{__('public/home.need_more_info')}}
            </h2>
            <p class="interl-text fs-texte m-b-32">
                {{__('public/home.need_more_info_description')}}
            </p>
            <a href="{{route("public.contact", ['locale' => __('general.currentLocale')])}}"
               title="aller vers la page de Contact" class="public-button fs-button border-r-big ">
                {{__('public/home.contact_us')}}
            </a>
        </div>
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="Image avec deux chiens" width="948" height="911"
             class="m-l-auto d-block border-r-small">
    </section>
</x-public.app>
