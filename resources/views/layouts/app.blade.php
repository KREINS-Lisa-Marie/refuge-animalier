<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="Les pattes heureuses, refuge, animal shelter, animals, cat, dog, chien, chat, animaux, bénévolat">
    <meta name="author" content="Lisa-Marie Kreins">
    <meta name="description" content="La page du réfuge 'Les pattes heureuses'">
    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="body-style">
<x-navigation></x-navigation>

<main class="body-content" id="content">
    {{ $slot }}
</main>

</body>
</html>
