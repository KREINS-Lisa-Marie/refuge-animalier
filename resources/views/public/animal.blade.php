@props(
    [
        'animal'
]
)
<x-public.app :title="$title">

<x-public.return-button class="max-w-web margin-l-r-auto"></x-public.return-button>
    <section class="p-l-r-24 m-t-110 m-b-60-150" itemscope itemtype="https://schema.org/Thing">
        <div class="animal-description-img d-flex flex-cr flex-wrap max-w-web margin-l-r-auto">
            <div>
                <div class="name-share">
                    <h2 class="page-title fw-700 color-dark" itemprop="name">
                        {!! $animal->animal_name !!}
                    </h2>
                    <x-public.share-button class=""></x-public.share-button>
                </div>
                <p class="interl-text animal-description" itemprop="description">
                    {!! $animal->description !!}
                </p>
            </div>
            {{--<img src="{!! asset('assets/img/border-collie.jpg') !!}" alt="Image du chien"
                 class="animal-img border-r-small border-xl" width="327" height="327">--}}
            @if($animal->show_image)
                <img src="{{Storage::disk('s3')->url('images/animals/variants/400x400/'.basename($animal->show_image))}}" alt="{{__('admin/animals.animal_image')}}" class="animal-img border-r-small border-xl" width="400" height="400" itemprop="image">
            @else
                <img src="{!! asset('assets/content/default.jpg') !!}" alt="{{__('admin/animals.animal_image')}}" width="400" height="400" class="animal-img border-r-small border-xl" itemprop="image">
            @endif


        </div>
        <div class="animal-section max-w-web margin-l-r-auto ">
            <dl class="fs-texte dl:last-child max-h-384 d-flex flex-c flex-wrap">
                <x-definition-term>
                    {{__('public/animals.species')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->species !!}
                </x-definition>

                <x-definition-term>
                    {{__('public/animal.race')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->race !!}
                </x-definition>

                <x-definition-term>
                    {{__('public/animal.sex')}}
                </x-definition-term>
                <x-definition>
                    {!! $animal->sex =='male'? __('public/animals.male') : __('public/animals.female')  !!}
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
                <x-definition>
                    {{abs(floor(now()->diffInYears($animal->age))) >= 1 ? abs(floor(now()->diffInYears($animal->age))) :  '<1 An(s)'  }}



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
            <div class="animal-buttons d-flex flex-r flex-gap-24 flex-wrap">
                <p class="animal-state fw-700 p-16-32 background-light d-i-block border-r-big m-b-32">
                    {{--{{__('public/animal.to_adopt')}}--}}
                    {{ $animal->state == 'processing_adoption'? __('admin/animals.processing_adoption') : ($animal->state == 'adopted'? __('admin/animals.adopted'): ($animal->state == 'in_treatment'? __('admin/animals.in_treatment') : __('admin/animals.adoptable') ))}}
                </p>
                @if($animal->state == 'adoptable')
                <a href="#request" class="public-button fs-button border-r-big m-b-32">
                    {{__('public/animal.schedule_meeting')}}
                </a>
                @endif
            </div>
        </div>
    </section>
    <section class="background-light p-l-r-24 p-b-60-150">
        <h2 class="page-title fw-700 max-w-web margin-l-r-auto color-dark">
            {{__('public/animal.galery_of')}}<span itemprop="name">{!! $animal->animal_name !!}</span>
        </h2>
        <ul class="m-t-32 d-flex flex-r flex-gap-32 flex-wrap max-w-web margin-l-r-auto">

            @if(!empty($animal->gallery_images))
                @foreach($animal->gallery_images as $image )
                    <li class="flex-gap-32">
                        <img src="{{Storage::disk('s3')->url('images/animals/variants/300x300/'.basename($image))}}" alt="Image de {{$animal->animal_name}}" class="border-xl public-animals-circles" width="300" height="300">
                    </li>
                @endforeach
            @else
                <p>
                    {{__('admin/animals.no_image_available')}}
                </p>
            @endif
        </ul>
    </section>
    @if($animal->state == 'adoptable')
    <section id="request" class="p-l-r-24">
        <h2 class="page-title fw-700 max-w-web margin-l-r-auto color-dark">
            {{__('public/animal.want_to_adopt')}}{{$animal->animal_name}}?
        </h2>
        <form action="{{route('public.animal.store', ['locale'=>app()->getLocale(), 'animal'=>$animal])}}" method="POST" class="form  web-margin-l-r-auto background-light border-r-small m-lr-24 m-b-60-150 public-form">
        @csrf
            <h3 class=" fw-700 p-b-32 t-a-center color-dark form-title">
                {{__('public/animal.adoption_form')}}
            </h3>
            <p class="italic m-b-32 interl-text">
                {{__('public/animal.fill_out_form')}}
            </p>

            <fieldset>

                <p class="obligations m-b-32">
                    {{__('public/contact.mandatory_fields')}}
                </p>

                <div class="d-flex flex-gap-24  flex-wrap">
                    <div class="web-flex flex-gap-24 flex-wrap">

                        <x-fields.text name="first_name" id="first_name" value="" placeholder="John" wire="">
                            {{__('public/contact.first_name_mandatory')}}
                        </x-fields.text>

                        <x-fields.text name="last_name" id="last_name" value="" placeholder="Doe" wire="">
                            {{__('public/contact.lastname_mandatory')}}
                        </x-fields.text>

                        <x-fields.phone name="phone" id="phone" value="" placeholder="0393908237" wire="">
                            {{__('public/contact.phone_mandatory')}}
                        </x-fields.phone>

                        <x-fields.email value="" wire="">
                            {{__('public/contact.email_mandatory')}}
                        </x-fields.email>


                        <div class="field sro">
                            <label for="animal_name" class="field__label" aria-required="true" aria-hidden="true">
                                {{__('public/contact.concerning')}}
                            </label>
                            <input type="text" name="animal_name" id="animal_name" value="{{$animal->animal_name}}" class="field__input sro"  placeholder="{{$animal->animal_name}}" aria-required="true" aria-hidden="true" readonly disabled>
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
            <button type="submit" class="btn contact-form-btn background-dark color-white dark-button-background min-w-130 border-r-big margin-l-r-auto m-t-32 d-block p-16-32">{{__('public/contact.send')}}
            </button>
            @if(session('successMessage'))
                <p class="success">
                    {{ session('successMessage') }}
                </p>
            @endif
        </form>
    </section>
    @endif
</x-public.app>
