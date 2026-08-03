<x-public.app :title="$title">

    <h2 class="page-title m-b-60-94 fw-700 t-a-center color-dark p-b-0">
        {{__('public/animals.our_animals')}}
    </h2>

    <section class="background-dark p-t-b-60-150 p-l-r-24 ">
        <h3 class="sro" aria-level="3" role="heading">
            {{__('public/animals.animal_list')}}
        </h3>
        <div class="animal-filters text-white border-radius-16 admin-primary-button bold max-w-web margin-l-r-auto m-b-80">
            <input type="checkbox" id="lang-switch"
                   class="animal-filters--input sro">
            <label class="animal-filters--label background-public border-r-medium p-16" for="lang-switch">
                {{__('public/animals.search_and_filters')}}
            </label>
            <div class="text__container">
                <div class="d-flex flex-wrap flex-j-c-space-between max-w-web margin-l-r-auto">
                    <div>
                        <form method="GET" action="" class="animal-filters">
                            <div class="d-flex flex-wrap flex-c flex-gap-24 filters">
                                <div class="select text-black">
                                    <x-select select_name="age" label="{{__('public/animals.age')}}" :options="$age_options"
                                              wire="select_animals"/>
                                </div>
                                <div class="select text-black">
                                    <x-select select_name="sex" label="{{__('public/animals.gender')}}" :options="$sex_options" wire="sex"/>
                                </div>
                                <div class="select text-black">
                                    <x-select select_name="species" label="{{__('public/animals.species')}}" :options="$species_options"
                                              wire="species"/>
                                </div>


                                <button type="submit"
                                        class="p-16-32 d-i-block dark-button-background color-white border-r-big">
                                    {{__('public/animals.filter')}}
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="">
                        {{-- GET parce que c'est pas vraiment des données secrètes ou qui ne peuvent pas passer dans l'url --}}

                        <form method="GET" action="" class="search-animals-form m-b-56">
                            <label for="search" class="sro ">
                                {{__('public/animals.animal_list')}}
                            </label>
                            <input type="text" name="search" id="search"
                                   class="search-input background-white border-r-big p-16-32"
                                   placeholder="{{__('public/animals.searching')}}"
                                   value="{{request('search')}}"> {{--ça garde le mot cherché --}}
                            <button type="submit"
                                    class="bold d-block  p-16-32 d-i-block dark-button-background color-white border-r-big public-submit-button">
                                {{__('public/animals.search')}}
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <div class="max-w-web margin-l-r-auto m-b-80">
            <a href="{{route('public.animals',  ['locale' => app()->getLocale()])}}"
                  title="{{__('public/animals.reset')}}" class="reset-button d-i-block ">
                {{__('public/animals.reset')}}
            </a>
        </div>

        <ul class="d-flex flex-gap-24 flex-wrap max-w-web pet-group margin-l-r-auto" itemscope itemtype="https://schema.org/ItemList">
            @forelse($animals as $animal)
                <li itemprop="itemListElement">
                    <x-cards :petname="$animal->animal_name" :petstatus="$animal->state" :petage="$animal->age" :petrace="$animal->race" :petsex="$animal->sex" :animal="$animal" :petimg="$animal->show_image"/>
                </li>
            @empty
                <li>
                    <p class="error-no-animal text-white  uppercase bold">
                        {{__('public/animals.no_animal_found')}}
                    </p>
                </li>
            @endforelse
        </ul>
        <div class="pagination-public max-w-admin-web">
            {{ $animals->links() }}
        </div>
    </section>
    <section class=" p-b-150">
        <h3 class="page-title fw-700 p-b-32 t-a-center color-dark p-l-r-24">
            {{__('public/animals.similar_animals')}}
        </h3>

        <ul class="d-flex flex-gap-24 flex-wrap max-w-web pet-group margin-l-r-auto" itemscope itemtype="https://schema.org/ItemList">
            @forelse($similar_animals as $similar_animal)
                <li itemprop="itemListElement">
                    <x-cards :petname="$similar_animal->animal_name" :petstatus="$similar_animal->state" :petage="$similar_animal->age" :petrace="$similar_animal->race" :petsex="$similar_animal->sex" :animal="$similar_animal" :petimg="$similar_animal->show_image"/>
                </li>
            @empty
                @foreach($random_animals as $random_animal)
                    <li itemprop="itemListElement">
                        <x-cards :petname="$random_animal->animal_name" :petstatus="$random_animal->state" :petage="$random_animal->age" :petrace="$random_animal->race" :petsex="$random_animal->sex" :animal="$random_animal" :petimg="$random_animal->show_image"/>
                    </li>
                    @endforeach
            @endforelse
        </ul>
    </section>


</x-public.app>
