<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>

    <body>
        <div>
            <section class="px-8 py-4 mb-6">
                <header class="container mx-auto">
                    <img src="/images/logo.svg" alt="Tweety logo">

                </header>
            </section>

            {{$slot}}
        </div>
    </body>

    <footer>
        <div class="bg-gray-100 mt-8 flex" style="height: 70px;">
            <div class="w-1/2 mt-4">
                <ul class="ml-20 flex">
                    <li class="mr-6">About us</li>
                    <li class="mr-6">Contact us</li>
                    <li class="mr-6">Terms & Conditions</li>
                    <li class="mr-6">Policies</li>
                </ul>
            </div>
            <div class="mt-4" style="float:right">
                <p>&copy;Copyright Tweety.</p>
            </div>
        </div>
    </footer>
</html>
