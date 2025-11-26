<div class="card">
    <img src="{!! asset('assets/img/frenchie.png') !!}" alt="Image du chien" class="border-r-small m-b-24 card-img">
    <div>
        <div class="d-flex flex-r flex-j-c-space-between flex-a-i-center pb-24">
            <p class="card-petname fw-700 d-block">
                {{$petname}}
            </p>
            <p class="d-block border-1-dark p-lr-24-tb-8 border-r-big">
                {{$petstatus}}
            </p>
        </div>
        <div class="infos p-b-32">
            <p  class="p-b-16">
                {{$petage}}

            </p>
            <p  class="p-b-16">
                {{$petrace}}

            </p>
            <p>
                {{$petsex}}
            </p>
        </div>
        <p class="d-flex flex-r flex-a-i-center flex-j-c-end fw-700 link_discover">
            Voir plus d'infos
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="26" viewBox="0 0 36 26" fill="none" class="arrow_discover">
                <path d="M7.375 13.0013H28.0196M28.0196 13.0013L17.6973 5.41797M28.0196 13.0013L17.6973 20.5846" stroke="#51594C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </p>
    </div>
    <a href="{{route('public.animal')}}" title="aller vers la page de l’animal" class="card-link">
    </a>
</div>
