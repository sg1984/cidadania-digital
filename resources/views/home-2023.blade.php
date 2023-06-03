@extends('layouts.app-2023')

@section('content')
    <div class="content-home">
        @if (session('status'))
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <div class="container">
            <div id="masterclass">
                <hr>
                <div class="row">
                    <div class="col-7">
                        <div class="label">Masterclass</div>
                        <h1 style="margin-top: 40px;">
                            Identidade e Cidadania Digital <small>(Unico e Atopos/USP)</small>
                        </h1>
                        <p>
                            Se atualize sobre a Era Digital e compreenda as implicações atuais e futuras em nossas vidas, na carreira e na própria sociedade.
                        </p>
                        <div class="flex">
                            <i class="fa-sharp fa-3x fa-solid fa-people-group mr-2"></i>
                            <p>
                                Professores: Massimo Di Felice, Derrick de Kerckhove, Ysadora Córdova, Eliete Pereira, Sônia Guajajara
                            </p>
                        </div>

                        <a class="join-cta" href="{{ route('showSpecialPage', 'unico') }}">
                            Quero participar
                        </a>
                    </div>

                    <div class="col-5 img-container"></div>
                </div>
            </div>

            <div id="webseries">
                <h2 class="home-title home-title-sections">Webséries</h2>

                <div class="row flex slider slider-verbete">
                    @foreach($series as $serie)
                        <div class="col-md-3 mb-3 card-container">
                            <div class="card card-body p-0">
                                <a class="access-link" href="{{ $serie['url'] }}">
                                    <img src="{{ $serie['thumbnail'] }}" alt="{{ $serie['id'] }}" width="100%" height="210px">
                                    <p>{{ $serie['title'] }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="verbetes">
                <h2 class="home-title home-title-sections">Verbetes</h2>

                <div class="row flex slider slider-verbete">
                    @foreach($subjects as $key => $subject)
                        @if(!isset($subject['inactive']))
                            <div class="col-md-3 mb-3 card-container">
                                <div class="card card-body p-0">
                                    <a href="{{ route('showSpecialPage', $key) }}">
                                        <img class="img-fluid" src="{{ $subject['image'] }}" alt="Video thumbnail">
                                        <p>{{ $subject['name'] }}</p>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <hr>

            <div id="sobre-nos">
                <h2 class="home-title">Sobre nós</h2>

                <div class="row">
                    <div class="col-5 img-container">
                        <img src="{{ url('/images/about-us-home.png') }}" alt="Sobre Nós Ilustrativa">
                    </div>

                    <div class="col-7 text-container">
                        <div>
                            <h3>Uma iniciativa internacional para a promoção e educação para a Cidadania Digital</h3>

                            <p>
                                Uma iniciativa do Centro Internacional de Pesquisa Atopos (ECA/USP) em parceria com outras instituições de ensino e pesquisa, a Plataforma de Cidadania Digital pretende ser um ambiente virtual com recursos educacionais abertos, a contar com um banco de dados de cursos, palestras, textos, podcasts, entrevistas e exemplos internacionais de práticas de Cidadania Digital. O objetivo é compor uma rede ampla formada não apenas por professores e pesquisadores, mas por qualquer pessoa interessada em promover uma iniciativa de cidadania digital, disseminativa e participativa, contando com quatro ambientes: o diretório de conteúdos, a arquitetura de formação denominada Escola de Cidadania Digital, o glossário WikiCidadania e o reconhecimento das práticas e iniciativas por meio do Prêmio da Cidadania Digital.
                            </p>

                            <div class="flex buttons">
                                <a class="about-us-link" href="/about">
                                    Sabia mais
                                </a>

                                <a class="leia-manifesto-link"
                                   href="https://34d58460-6c5d-4ec9-80bb-e7055249a338.filesusr.com/ugd/e30c33_7cc8e6a2745d4993b530e2cc4eb3dd12.pdf"
                                >
                                    Leia nosso manifesto
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div id="home-realizacao">
                <h2 class="home-title">Realização</h2>
                <div class="logo-realizacao">
                    <img src="{{ url('/images/logos/realizacao-logo.png') }}" alt="Logo Realização">
                </div>
            </div>

            <div id="home-parceiros">
                <h2 class="home-title">Parceiros</h2>
                <div class="row">
                    @foreach($partners as $key => $partner)
                        <div class="col-sm-3 img-container">
                            <img src="{{ $partner }}" alt="Logo Parceiro">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{ view('video-target') }}
    </div>
@endsection
