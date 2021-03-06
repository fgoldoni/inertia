<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="baseUrl" content="{{ env('APP_URL') }}">
        <meta name="frontendDomain" content="{{ env('FRONTEND_DOMAIN') }}">
        <meta name="frontendHttp" content="{{ env('FRONTEND_HTTP', 'http://') }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/manifest.js') }}" defer></script>
        <script src="{{ mix('js/vendor.js') }}" defer></script>
        @inertiaHead
    </head>
    <body class="h-full font-sans antialiased">
        @inertia

        <x-translations></x-translations>
    </body>
</html>
