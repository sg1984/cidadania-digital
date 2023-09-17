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
                        <a class="nav-link login-button" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>

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
