<!DOCTYPE html>
<html lang="tg">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="msapplication-config" content="{{ asset('msapplication-config.xml') }}">

        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/icons/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icons/favicon-32x32.png') }}">

        {{-- COnfig Safari browser --}}
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/icons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/icons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('img/icons/apple-icon-167x167.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/apple-icon-180x180.png') }}">

        {{-- Hide Safari User Interface Components & Change status bar color --}}
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="#02716A">

        <title>@hasSection('title')@yield('title'){{ ' — Хирад' }}@else{{'Хирад'}}@endif</title>

        <meta name="keywords" content="китоб, книги, бесплатные книги, онлайн библиотека, купить книги в Таджикистане, читать книги онлайн"/>
        <meta property="og:site_name" content="Хирад">
        <meta property="og:type" content="object" />
        <meta name="twitter:card" content="summary_large_image">

        @hasSection ('meta-tags')
            @yield('meta-tags')
        @else
            <meta name="description" content="“Хирад” — маъбади аҳли илм ва меҳроби поки донишҷӯӣ ва илмомӯзӣ аст. Ҳарки аз китоб ва мутолиа бегона аст, ғариб ва бемӯнис аст.">
            <meta property="og:title" content="Хирад" />
            <meta property="og:description" content="“Хирад” — маъбади аҳли илм ва меҳроби поки донишҷӯӣ ва илмомӯзӣ аст. Ҳарки аз китоб ва мутолиа бегона аст, ғариб ва бемӯнис аст.">
            <meta property="og:image" content="{{ asset('img/main/logo-share.png') }}">
            <meta property="og:image:alt" content="Хирад — Лого">
        @endif

        {{-- Google Roboto & Roboto Condensed Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,700&family=Roboto:wght@300;400;500;700&display=swap">

        {{-- Material Icons --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined">

        {{-- Owl Carousel --}}
        <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.theme.default.min.css') }}">

        {{-- JQformstyler --}}
        <link rel="stylesheet" href="{{ asset('plugins/jqformstyler/jquery.formstyler.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jqformstyler/jquery.formstyler.theme.css') }}">

        {{-- Selectize --}}
        <link rel="stylesheet" href="{{ asset('plugins/selectize/selectize.css') }}">

        {{-- Normalize CSS --}}
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>

    <body>
        @include('layouts.header')
        <main class="main">
            @yield('main')
            <x-scroll-top-button />
        </main>
        @include('layouts.footer')

        {{-- JQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        {{-- Owl Carousel --}}
        <script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>

        {{-- Yandex share buttons --}}
        <script src="https://yastatic.net/share2/share.js"></script>

        {{-- JQformstyler --}}
        <script src="{{ asset('plugins/jqformstyler/jquery.formstyler.min.js') }}"></script>

        {{-- Selectize --}}
        <script src="{{ asset('plugins/selectize/selectize.min.js') }}"></script>

        @if (request()->route()->getName() == 'contacts')
            {{-- Google Maps --}}
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAneCOkP0fjY3gOXV9DYFTdA59yWXDvNLw&callback=initMap"></script>

            {{-- Google Recaptcha v3--}}
            <script src="https://www.google.com/recaptcha/api.js"></script>
        @endif

        <script src="{{ mix('js/app.js') }}"></script>

        @production
            @include('layouts.analytics')
        @endproduction
    </body>
</html>
