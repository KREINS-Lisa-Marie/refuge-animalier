<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Les pattes heureuses, refuge, animal shelter, animals, cat, dog, chien, chat, animaux, bénévolat">
    <meta name="author" content="Lisa-Marie Kreins">
    <meta name="description" content="La page du réfuge 'Les pattes heureuses'">
    <title>{{ $title ?? 'Page Title' }}</title>
</head>
<body>
@component('layouts.navigation')
@endcomponent

{{ $slot }}

@component('layouts.footer')
@endcomponent
</body>
</html>
