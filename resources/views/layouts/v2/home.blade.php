<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.v2.head')
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


