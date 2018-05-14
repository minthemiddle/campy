<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-brand-lightest font-sans font-normal">
    <div class="flex flex-col">
        @if(Route::has('login'))
            <div class="absolute pin-t pin-r mt-4 mr-4">
                @auth
                    <a href="{{ url('/home') }}" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase">Home</a>
                @else
                    <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase pr-6">Login</a>
                    <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase">Registrieren</a>
                @endauth
            </div>
        @endif

        <div class="min-h-screen flex items-center justify-center">
            <div class="flex flex-col justify-around h-full">
                <div>
                    <h1 class="text-grey-darker text-center font-hairline tracking-wide text-7xl mb-6">
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                    <p class="text-center mb-6 text-grey-darker">Hier kannst du dich für Camps anmelden.</p>
                    <div class="text-center mb-8 font-bold">
                @auth
                    <a href="{{ url('/home') }}" class="no-underline hover:underline text-sm text-brand-dark uppercase">Home</a>
                @else
                    <a href="{{ route('login') }}" class="no-underline hover:underline text-sm bg-brand-dark text-white rounded-lg p-2 uppercase">Login</a>
                    <a href="{{ route('register') }}" class="no-underline hover:underline text-sm  bg-brand-dark text-white rounded-lg p-2 uppercase">Registrieren</a>
                @endauth

                <ul class="hidden mt-8 list-reset">
                        <li class="inline pr-8">
                            <a href="https://code.design" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Webseite" target="_blank">Webseite</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://www.instagram.com/codeunddesign/" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Instagram" target="_blank">Instagram</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://twitter.com/codeunddesign?lang=de" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Twitter" target="_blank">Twitter</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://www.youtube.com/channel/UCuT3xJjPZFqQEEpleHBxVuA" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="Youtube" target="_blank">Youtube</a>
                        </li>
                        <li class="inline pr-8">
                            <a href="https://github.com/CodeDesignInitiative" class="no-underline hover:underline text-sm font-normal text-brand-dark uppercase" title="GitHub" target="_blank">GitHub</a>
                        </li>
                    </ul>
            </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
