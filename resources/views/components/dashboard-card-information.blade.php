@props([
    'card_title',
])

<div>
        <p class="dashboard-card-title">
            {{$card_title}}
        </p>
        <p class="big-number">
            {{ $slot }}
        </p>
</div>
