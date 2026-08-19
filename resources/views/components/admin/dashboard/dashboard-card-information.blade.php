@props([
    'card_title',
])

<div class="d-flex flex-c flex-j-c-space-between">
        <p class="dashboard-card-title">
            {{$card_title}}
        </p>
        <p class="big-number color-dark fw-700 ">
            {{ $slot }}
        </p>
</div>
