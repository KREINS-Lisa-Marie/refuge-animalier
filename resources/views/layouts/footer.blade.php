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
                {{__('footer.phone_number')}} <a href="tel:080546384" class="public-phone" title="{{__('admin/contacts.call')}}">080 546 384</a>
            </p>
            <p class="m-b-16">
                {{__('footer.adress')}}
                <a href="https://maps.app.goo.gl/vqLbDAcdjfxH2FDy7" title="{{__('public/contact.maps')}}" class="public-phone">{{__('footer.adress-name')}}</a>
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
        <a href="{{route('public.legals', ['locale' => app()->getLocale()])}}" class="d-block m-b-16">
            {{__('footer.legal_information')}}
        </a>
        <p >
            {{__('footer.created_by')}} <a href="https://lisa-marie-kreins.com/" title="{{__('footer.go_to_website')}}">Lisa-Marie Kreins</a>
        </p>
    </div>

</footer>
