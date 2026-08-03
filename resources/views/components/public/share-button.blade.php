@props([
    'class'
])
<div class="max-w-web <!--margin-l-r-auto--> {{$class}}">
    <a href="{{ url()->current()}}" class="share-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M21 12L14 5V9C7 10 4 15 3 20C5.5 16.5 9 14.9 14 14.9V19L21 12Z" fill="#51594C"/>
        </svg>
        {{__('public/animal.share')}}
    </a>
</div>
