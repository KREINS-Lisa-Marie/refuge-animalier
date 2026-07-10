@props(
    [
        'animal'
]
)
<x-public.app :title="$title">

    <div class="max-w-web margin-l-r-auto">
        <a href="{{route('public.animals', ['locale' => __('general.currentLocale')])}}" class="return-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="18" viewBox="0 0 23 18" fill="none">
                <path
                    d="M21.6445 8.58464L0.999944 8.58463M0.999944 8.58463L11.3222 16.168M0.999944 8.58463L11.3222 1.0013"
                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{__('public/animal.return')}}
        </a>
    </div>
    <section class="p-l-r-24 m-t-110 m-b-60-150">
        <div class="animal-description-img d-flex flex-cr flex-wrap max-w-web margin-l-r-auto">
            <div>
                <h2 class="page-title fw-700 color-dark">
                    {!! $animal->animal_name !!}
                </h2>
                <p class="interl-text animal-description">
                    {!! $animal->description !!}
                    {{--Ce magnifique Border Collie est un chien à la fois doux, affectueux et plein d’énergie&nbsp;!
                    Toujours partant pour jouer ou partir en balade, il aura besoin d’une famille active qui saura lui
                    offrir de longues promenades et des moments de stimulation mentale. Très sociable et patient avec
                    les enfants,
                    il fera un excellent compagnon pour une famille dynamique. En revanche, il ne conviendra pas
                    vraiment à
                    des personnes âgées. Il se retrouve aujourd’hui au refuge suite à la séparation de ses anciens
                    propriétaires, et cherche désormais un nouveau foyer aimant où il pourra s’épanouir.--}}
                </p>
            </div>
            <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien"
                 class="animal-img border-r-small border-xl" width="327" height="327">
        </div>
        <div class="animal-section max-w-web margin-l-r-auto ">
            <dl class="fs-texte dl:last-child max-h-384 d-flex flex-c flex-wrap">
                <x-definition-term>
                    {{__('public/animal.race')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->species !!}
                </x-definition>

                <x-definition-term>
                    {{__('public/animal.sex')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->sex !!}
                </x-definition>

                <x-definition-term>
                    {{__('public/animal.furr')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->fur !!}
                </x-definition>

                <x-definition-term>
                    {{__('public/animal.age')}}
                </x-definition-term>
                <x-definition>{!! $animal->age !!} An(s)
                </x-definition>

                <x-definition-term>
                    {{__('public/animal.vaccinations')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->vaccinations !!}
                </x-definition>

                <x-definition-term>
                    {{__('public/animal.character')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->character !!}
                </x-definition>

            </dl>
            <p class="animal-state fw-700 p-16-32 background-light d-i-block border-r-big m-b-32">
                {{--{{__('public/animal.to_adopt')}}--}}
                {!! $animal->state !!}
            </p>
        </div>
        {{--        <a href="{{route('public.contact')}}" title="Aller vers la page Contact">
                    Demander de rencontrer Balou
                </a>--}}
    </section>
    <section class="background-light p-l-r-24 p-b-60-150">
        <h2 class="page-title fw-700 max-w-web margin-l-r-auto color-dark">
            {{__('public/animal.galery_of')}}{!! $animal->animal_name !!}
        </h2>
        <ul class="m-t-32 d-flex flex-r flex-gap-32 flex-wrap max-w-web margin-l-r-auto">
            <li class="flex-gap-32 ">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="{{__('public/animal.animal_image')}}"
                     class="border-r-small border-xl" width="300" height="300">
            </li>
            <li class="flex-gap-32">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="{{__('public/animal.animal_image')}}"
                     class="border-r-small border-xl" width="300" height="300">
            </li>
            <li class="flex-gap-32">
                <img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="{{__('public/animal.animal_image')}}"
                     class="border-r-small border-xl" width="300" height="300">
            </li>
        </ul>
    </section>
    @if($animal->state == 'adoptable')
    <section>
        <h2 class="page-title fw-700 max-w-web margin-l-r-auto color-dark">
            {{__('public/animal.want_to_adopt')}}{{$animal->animal_name}}?
        </h2>
        <form action="" method="POST" class="form  web-margin-l-r-auto background-light border-r-small m-lr-24 m-b-60-150 public-form">

            <h2 class=" fw-700 p-b-32 t-a-center color-dark form-title">
                {{__('public/animal.adoption_form')}}
            </h2>
            <p class="italic m-b-32 interl-text">
                {{__('public/animal.fill_out_form')}}
            </p>

            <fieldset>

                <p class="obligations m-b-32">
                    {{__('public/contact.mandatory_fields')}}
                </p>

                <div class="d-flex flex-gap-24  flex-wrap">
                    <div class="web-flex flex-gap-24 flex-wrap">

                        <x-fields.text name="firstname" id="firstname" value="" placeholder="John" wire="">

                            {{__('public/contact.first_name_mandatory')}}
                        </x-fields.text>

                        <x-fields.text name="lastname" id="lastname" value="" placeholder="Doe" wire="">

                            {{__('public/contact.lastname_mandatory')}}
                        </x-fields.text>

                        <x-fields.email value="" wire="">
                            {{__('public/contact.email_mandatory')}}
                        </x-fields.email>


                        <div class="field  sro">
                            <label for="subject" class="field__label" aria-required="true" aria-hidden="true">
                                {{__('public/contact.concerning')}}
                            </label>
                            <input wire:model.blur="{{$animal->id}}" type="text" name="animal_name" id="animal_name"
                                   value="{{$animal->animal_name}}" class="field__input sro"
                                   placeholder="{{$animal->animal_name}}" aria-required="true" aria-hidden="true"
                                   disabled>
                            @error("animal_name")
                            {{$message}}
                            @enderror
                        </div>
                    </div>

                @component('components.fields.textarea', ['name' => 'message', 'id'=>'message', 'value' =>'',
                'placeholder' => __('public/animal.contact_message'), 'old_values' =>  "", 'wire'=>""])
                    {{__('public/contact.message')}}
                @endcomponent

                </div>
            </fieldset>
            <button type="submit"
                    class="btn contact-form-btn background-dark color-white dark-button-background min-w-130 border-r-big margin-l-r-auto m-t-32 d-block p-16-32">{{__('public/contact.send')}}
            </button>
        </form>
    </section>
    @endif
</x-public.app>
