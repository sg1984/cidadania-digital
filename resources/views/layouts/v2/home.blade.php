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
        <video src="{{ url('/videos/binary-home.mov') }}" muted autoplay loop></video>

        @include('layouts.v2.menu')

        <div class="container">
            <hr style="position: relative; margin-top: -2px">
            <div id="sobre-nos">
                <div class="row">
                    <div class="col-xs-12 col-md-7 text-container">
                        <div>
                            <h3>Uma iniciativa internacional para a promoção e formação para a Cidadania Digital</h3>

                            <p>
                                Uma iniciativa do Centro Internacional de Pesquisa Atopos (ECA/USP) em parceria com outras instituições de ensino e pesquisa, a Plataforma de Cidadania Digital pretende ser um ambiente virtual com recursos educacionais abertos, a contar com um banco de dados de cursos, palestras, textos, podcasts, entrevistas e exemplos internacionais.
                            </p>

                            <div class="flex buttons">
                                <a class="about-us-link" href="/about">
                                    Sabia mais
                                </a>

                                <a class="leia-manifesto-link"
                                   href="https://34d58460-6c5d-4ec9-80bb-e7055249a338.filesusr.com/ugd/e30c33_7cc8e6a2745d4993b530e2cc4eb3dd12.pdf"
                                >
                                    <i class="fa fa-book"></i> Leia nosso manifesto
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</body>
</html>


