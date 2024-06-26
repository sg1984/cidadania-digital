<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cidadania Digital') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('js/select2/select2.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light menu-navbar shadow-sm p-0">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/images/logo_cidig_new.png') }}" height="80em" alt="Logo Plataforma Cidadania Digital">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">{{ __('Sobre') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('team') }}">{{ __('Equipe') }}</a>
                        </li>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="http://www.atopos.com.br/" target="_blank">{{ __('Atopos') }}</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownLogin" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Login') }}
                                </a>

                                <div id="navbarDropdownLoginForm" class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="navbarDropdownLogin">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                            <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                            <label for="password" class="col-form-label text-md-right">{{ __('Senha') }}</label>
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                            <label class="form-check-label" for="remember">
                                                {{ __('Lembrar de mim') }}
                                            </label>
                                        </div>
                                        <div class="form-group mt-1">
                                            <button type="submit" class="btn btn-outline-info">
                                                {{ __('Entrar') }}
                                            </button>
                                        </div>
                                    </form>
                                    <a href="{{ route('password.request') }}">{{ __('Esqueci minha senha') }}</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownHelp" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Ajuda') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownHelp">
                                    <a class="dropdown-item" href="{{ route('tickets.index') }}">{{ __('Tickets') }}</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#bugReportHelp" href="#">{{ __('Tenho uma dúvida') }}</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#bugReportForm" href="#">{{ __('Reportar um erro') }}</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->isAdmin())
                                        <a class="dropdown-item" href="{{ route('showUsers') }}">{{ __('Pesquisadores') }}</a>
                                        <a class="dropdown-item" href="{{ route('subjects.index') }}">{{ __('Verbetes') }}</a>
                                        <a class="dropdown-item" href="{{ route('tags.index') }}">{{ __('Tags') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('home') }}">{{ __('Meus Conteúdos') }}</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <span class="text-muted">© {{ now()->format('Y') }} Cidadania Digital. Todos os direitos reservados.</span>
            </div>
        </div>
    </footer>
    @auth
        {{ view('tickets.modals') }}
    @endauth
</body>
</html>
