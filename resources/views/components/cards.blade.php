@props(
    [
        'petname',
        'petstatus',
        'petage',
        'petrace',
        'petsex',
        'petimg',
        'animal',
]
)

<div class="card" itemscope itemtype="https://schema.org/Thing">
{{--    <img src="{!! asset('assets/img/frenchie.png') !!}" alt="{{__('public/home.image_of_dog')}}" class="border-r-small m-b-24 card-img">--}}
    @if($petimg)
        <img src="{{Storage::disk('s3')->url('images/animals/variants/334x334/'.basename($petimg))}}" alt="Image de {{$petimg}}" class="border-r-small m-b-24 card-img" width="288" height="288" itemprop="image">
    @else
        <img src="{!! asset('assets/content/default.jpg') !!}" alt="{{__('admin/animals.animal_image')}}" class="border-r-small m-b-24 card-img" height="288" width="288" itemprop="image">
    @endif

    <div>
        <div class="d-flex flex-r flex-j-c-space-between flex-a-i-center pb-24 flex-wrap">
            <p class="card-petname fw-700 d-block" itemprop="name">
                {{$petname}}
            </p>
            <p class="d-block border-1-dark p-lr-24-tb-8 border-r-big background-light">
                {{$petstatus == 'adoptable'? __('public/animal.adoptable') : ($petstatus == 'in_treatment'?__('public/animal.in_treatment') : __('public/animal.reserved') )}}
            </p>
        </div>
        <div class="infos p-b-32">
            <p  class="p-b-16">
                {{\Carbon\Carbon::parse($petage)->age}} {{__('public/home.years')}}
            </p>
            <p  class="p-b-16">
                {{$petrace}}

            </p>
            <p>
                {{$petsex =='male'? __('public/animals.male') : __('public/animals.female')  }}
            </p>
        </div>
        <p class="d-flex flex-r flex-a-i-center flex-j-c-end fw-700 link_discover">
           {{__('components/cards.see_more')}}
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="26" viewBox="0 0 36 26" fill="none" class="arrow_discover">
                <path d="M7.375 13.0013H28.0196M28.0196 13.0013L17.6973 5.41797M28.0196 13.0013L17.6973 20.5846" stroke="#51594C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </p>
    </div>
    <a href="{{route('public.animal',  ['locale' => app()->getLocale(),  'animal' => $animal->id])}}" title="{{__('components/cards.go_to_animal_page')}}" class="card-link">
    </a>

</div>
