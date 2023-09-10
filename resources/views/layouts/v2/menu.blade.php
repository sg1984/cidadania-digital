<nav class="navbar navbar-expand-md navbar-light menu-navbar shadow-sm p-0">
    <div class="container">
        <a class="navbar-brand" href="{{ route('v2.index') }}">
            <img src="{{ url('/images/logos/logo-2023.png') }}" height="32px" alt="Logo Plataforma Cidadania Digital">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"> <i class="fa-solid fa-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('v2.index') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('v2.about') }}">{{ __('Sobre nós') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('v2.team') }}">{{ __('Equipe') }}</a>
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
