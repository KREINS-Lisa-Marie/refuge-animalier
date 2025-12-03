@props([
'card_title',
'animal_card_img_src',
'animal_card_img_alt',
'animal_card_img_h_w',
'animal_name',
'animal_card_age',
'animal_card_date',
])

<div class="dashboard-animal-card">
    <img src="{{$animal_card_img_src}}" alt="{{$animal_card_img_alt}}" height="{{$animal_card_img_h_w}}" width="{{$animal_card_img_h_w}}" class="dashboard_animal_card_img">
    <div class="animal-dashboard-information">
        <h3 class="fw-medium">
            {{$animal_name}}
        </h3>
        <p class="dashboard-card-title">
            Age : {{$animal_card_age}}
        </p>
        <p class="dashboard-card-date">
            Date d’accueil : {{ $animal_card_date }}
        </p>
    </div>
</div>
