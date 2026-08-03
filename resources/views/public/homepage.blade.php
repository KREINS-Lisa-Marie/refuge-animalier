<x-public.app :title="$title">

        <section class="p-b-60 first-section" itemtype="https://schema.org/Organization" itemscope>
        <div class="p-l-r-24">
            <h2 class="homepage-title m-t-60 m-b-16" itemprop="legalName">
                {{__('public/home.homepage_big_title')}}
            </h2>
            <p class="interl-text fs-texte" itemprop="description">
                {{__('public/home.page_description')}}
            </p>
        </div>
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="{{__('public/home.image_of_dogs')}}" width="948" height="911" class="front-image" itemprop="image">
    </section>
    <section
        class="section background-dark p-l-r-24 p-t-b-60-150 flex-cr d-flex wrap-reverse flex-gap-32 title-text-img">
        <div class="title-text">
            <h2 class=" page-title p-b-32 fw-700 t-a-center color-dark">
                {{__('public/home.where_every_paw_counts')}}
            </h2>
            <p class="interl-text fs-texte" >
                {{__('public/home.where_every_paw_counts_text')}}
            </p>
        </div>
        <img src="{!! asset('assets/img/patte.jpg') !!}" alt="{{('public/home.image_of_dogpaw')}}" width="328" height="328"
             class="border-r-small">
    </section>
    <section class="p-t-b-60-150 background-light p-l-r-24 fs-texte home-adoption-section">
        <h2 class="page-title fw-700 p-b-32 t-a-center color-dark">
            {{__('public/home.adopt_us')}}
        </h2>

        <ul class="d-flex max-w-web margin-l-r-auto flex-gap-24 flex-wrap pet-group"  itemscope itemtype="https://schema.org/ItemList">
            @foreach($animals as $animal)
                <li itemprop="itemListElement">
                    <x-cards :petname="$animal->animal_name" :petstatus="$animal->state" :petage="$animal->age" :petrace="$animal->race" :petsex="$animal->sex" :animal="$animal" petimg="{{$animal->show_image}}"/>
                </li>
            @endforeach
        </ul>
        <a href="{{route("public.animals", ['locale' => app()->getLocale()])}}"
           title="{{('public/home.go_to_animals_page')}}" class="middle-button fs-button border-r-big  margin-l-r-auto m-t-60">{{__('public/home.discover_our_animals')}}</a>
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
               title="{{('public/home.go_to_contact_page')}}" class="public-button fs-button border-r-big ">
                {{__('public/home.contact_us')}}
            </a>
        </div>
        <img src="{!! asset('assets/img/dogs.jpg') !!}" alt="{{__('public/home.image_of_dogs')}}" width="948" height="911"
             class="m-l-auto d-block border-r-small">
    </section>
</x-public.app>
