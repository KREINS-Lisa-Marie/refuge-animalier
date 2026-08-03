<x-public.app title="{{__('general.legals')}}">
            <h2 class="page-title fw-700 t-a-center color-dark p-b-0">
                {{__('public/legals.legal-title')}}
            </h2>
            <p class="legal-info-date">
                {{__('public/legals.last_updated')}} 26.07.2026
            </p>
    <section class="background-light p-t-b-60-150 p-l-r-24 ">
        <h3 class="sro" aria-level="3" role="heading">
            {{__('public/legals.legals-definition')}}
        </h3>
        <div class="max-w-web margin-l-r-auto legals-text">

            <div class="identity">
                <h4 class="identity__title" aria-level="3" role="heading">
                    {{__('public/legals.general_info')}}
                </h4>
                <div itemscope itemtype="https://schema.org/Organization">
                    <span itemprop="legalName">Les pattes heureuses</span><br>
                    <p itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><span itemprop="streetAddress">Rue des Bois 4,</span> <span itemprop="postalCode">4700</span> <span itemprop="addressLocality">Malmedy</span><br>
                </p>
                    <p>
                        <span itemprop="email">lespattesheureuses@info.be</span>
                    </p>
                </div>
            </div>

            <div class="hosting">
                <h4 class="hosting__title" aria-level="3" role="heading">
                    {{__('public/legals.hosting')}}
                </h4>
                <div class="hosting_text" itemscope itemtype="https://schema.org/Organization">
                    <p>
                        <span itemprop="legalName">Infomaniak Network SA</span>
                        <br>
                        <span itemprop="address">{{__('public/legals.head_office')}} 1227 Les Acacias (Genève), Suisse</span>
                        <br>
                        {{__('public/legals.more_info_please')}}
                    </p>
                    <a href="https://www.infomaniak.com/" title="                 {{__('public/legals.go_to_infomaniak')}}" itemprop="url">Infomaniak</a>
                </div>

            </div>

            <div class="intellectual_property">
                <h4 class="intellectual_property__title" aria-level="3" role="heading">
                    {{__('public/legals.intellectual_property')}}
                </h4>
                <p>
                    {{__('public/legals.intellectual_property_text')}}
                </p>
            </div>

            <div class="privacy_extern_links">
                <h4 class="privacy_extern_links__title" aria-level="3" role="heading">
                    {{__('public/legals.external_links')}}
                </h4>
                <p>
                    {{__('public/legals.external_links_text')}}

                </p>
            </div>

            <div class="personal_data">
                <h4 class="personal_data__title" aria-level="3" role="heading">
                    {{__('public/legals.personal_data')}}
                </h4>
                <p>
                    {{__('public/legals.personal_data_text')}}
                </p>
            </div>

        </div>
    </section>
</x-public.app>
