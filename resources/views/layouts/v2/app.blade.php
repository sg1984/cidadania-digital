<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.v2.head')
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
                      height: 100%;
                      background-repeat: no-repeat";
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


