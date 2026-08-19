<footer class="general-footer" itemscope itemtype="https://schema.org/Organization">
    <h2 class="sro" aria-level="2">
        {{__('footer.footer')}}
    </h2>
    <div class="web-flex flex-wrap flex-j-c-space-between">
        <section class="informations-footer m-b-56">
            <h3 class="footer-title" itemprop="legalName">
                LES PATTES HEUREUSES
            </h3>
            <p class="m-b-16" itemprop="owner" itemscope itemtype="https://schema.org/Person">
                {{__('footer.responsible')}}<span itemprop="givenName">Elise</span> <span itemprop="familyName">Lambot</span>
            </p>
            <p class="m-b-16" >
                {{__('footer.phone_number')}} <a href="tel:080546384" class="public-phone" title="{{__('admin/contacts.call')}}"><span itemprop="telephone">080 546 384</span></a>
            </p>
            <p class="m-b-16">
                {{__('footer.adress')}}
                <a href="https://maps.app.goo.gl/vqLbDAcdjfxH2FDy7" title="{{__('public/contact.maps')}}" class="public-phone" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><span itemprop="streetAddress">Rue des Bois 4,</span> <span itemprop="postalCode">4700</span> <span itemprop="addressLocality">Malmedy</span></a>
            </p>
            <p>
                {{__('footer.opening_hours')}}
            </p>
        </section>
        <nav>
            <h3 class="footer-title">
                {{__('footer.navigation')}} <span class="sro">{{__('footer.of_the_end_of_the_page')}}</span>
            </h3>
           <a href="{{route('public.homepage', ['locale' => app()->getLocale()])}}" class="d-block m-b-16" title="{{__('footer.go_to_homepage')}}">{{__('footer.home')}}</a>
            <a href="{{route('public.animals', ['locale' => app()->getLocale()])}}" class="d-block m-b-16" title="{{__('footer.go_to_page_our_animals')}}">{{__('footer.our_animals')}}</a>
            <a href="{{route('public.contact', ['locale' => app()->getLocale()])}}" class="d-block m-b-16"  title="{{__('footer.go_to_page_contact')}}">{{__('footer.contact')}}</a>
        </nav>
        <div class="footer-button">
            <a href="{{route('public.contact', ['locale' => app()->getLocale()])}}" class="fw-medium color-dark" title="{{__('footer.go_to_page_contact')}}">
                {{__('footer.contact_us')}}
            </a>
        </div>
    </div>
    <div class="legal-information">
        <a href="{{route('public.legals', ['locale' => app()->getLocale()])}}" class="d-block m-b-16" title="{{__('footer.go_to_page_legals')}}">
            {{__('footer.legal_information')}}
        </a>
        <p >
            {{__('footer.created_by')}} <a href="https://lisa-marie-kreins.com/" title="{{__('footer.go_to_website')}}">Lisa-Marie Kreins</a>
        </p>
    </div>

</footer>
