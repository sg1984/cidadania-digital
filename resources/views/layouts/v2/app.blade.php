<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '2023 Cidadania Digital') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app-2023.css') }}" rel="stylesheet">
    <link href="{{ mix('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/slick/slick-theme.css') }}" rel="stylesheet" />

    <link href="{{ asset('/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('/fontawesome/css/solid.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/app-2023.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('js/select2/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ asset('js/slick/slick.min.js') }}" defer></script>

    @stack('css')
</head>
<body id="app-2023">
    <div id="app">
        @isset($seriesData['background-img'])
            <div
                id="background-img"
                style="background-image:
                    linear-gradient(270deg,
                      rgba(245,70,66,0),
                      #090E1F), url('{{ url($seriesData['background-img']) }}');
                      height: 100%"
            >

            </div>
        @endisset

        @include('layouts.v2.menu')

        <div class="container">
            <hr style="position: relative; margin-top: -2px">
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer>
        {{ view('v2.footer') }}
    </footer>

    @auth
        {{ view('tickets.modals') }}
    @endauth

    @yield('inline_scripts')
</body>
</html>


