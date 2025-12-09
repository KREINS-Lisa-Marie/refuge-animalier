<footer class="general-footer">
    <h2 class="sro" aria-level="2">
        {{__('footer.footer')}}
    </h2>
    <div class="web-flex flex-wrap flex-j-c-space-between">
        <div class="informations-footer m-b-56">
            <h3 class="footer-title">
                {{__('footer.shelter_name')}}
            </h3>
            <p class="m-b-16">
                {{__('footer.responsible')}}
            </p>
            <p class="m-b-16">
                {{__('footer.phone_number')}}
            </p>
            <p class="m-b-16">
                {{__('footer.adress')}}
            </p>
            <p >
                {{__('footer.opening_hours')}}
            </p>
        </div>
        <nav>
            <h3 class="footer-title">
                {{__('footer.navigation')}} <div class="sro">{{__('footer.of_the_end_of_the_page')}}</div>
            </h3>
           <a href="{{route('public.homepage', ['locale' => __('general.currentLocale')])}}" class="d-block m-b-16">{{__('footer.home')}}</a>
            <a href="{{route('public.animals', ['locale' => __('general.currentLocale')])}}" class="d-block m-b-16">{{__('footer.our_animals')}}</a>
            <a href="{{route('public.contact', ['locale' => __('general.currentLocale')])}}" class="d-block m-b-16" >{{__('footer.contact')}}</a>
        </nav>
        <div class="footer-button">
            <a href="{{route('public.contact', ['locale' => __('general.currentLocale')])}}" class="fw-medium color-dark">
                {{__('footer.contact_us')}}
            </a>
        </div>
    </div>
    <div class="legal-information">
        <a href="" class="d-block m-b-16">
            {{__('footer.legal_information')}}
        </a>
        <p >
            {{__('footer.created_by')}}
        </p>
    </div>

</footer>
