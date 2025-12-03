@props([
'card_title',
'animal_card_img_src',
])

<div class="dashboard-statictics-card border-r-big background-white">
        <h3 class="fw-medium">
            {{$animal_name}}
        </h3>
        <p class="big-number">
            Age : {{$animal_card_age}}
        </p>
</div>
