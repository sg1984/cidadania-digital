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
            <hr style="margin-top: -2em;">

            <div id="sobre-nos">
                <div class="row">
                    <div class="col-xs-12 col-md-7 text-container">
                        <div>
                            <h3>Uma iniciativa internacional para a promoção e educação para a Cidadania Digital</h3>

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

            <hr>

            <div id="home-realizacao">
                <h2 class="home-title">Realização</h2>
                <div class="logo-realizacao">
                    <img src="{{ url('/images/logos/realizacao-logo.png') }}" alt="Logo Realização">
                </div>
            </div>

            <hr>

            <div id="masterclass">
                <hr>
                <div class="row">
                    <h2 class="home-title">Masterclasses</h2>

                    <div class="row flex">
                        <div class="col-12 mb-3 card-container">
                            <div class="card card-body p-0 masterclass-image">
                                <a class="access-link" href="/special/unico">
                                    <img src="{{ url('/images/masterclass-carroussel.png') }}" alt="Masterclass Unico" width="100%">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="webseries">
                <h2 class="home-title home-title-sections">Webséries</h2>

                <div class="row flex slider slider-verbete">
                    @foreach($series as $serie)
                        <div class="col-md-3 mb-3 card-container">
                            <div class="card card-body p-0">
                                <hr>
                                <a class="access-link" href="{{ $serie['url'] }}">
                                    <img src="{{ $serie['thumbnail'] }}" alt="{{ $serie['id'] }}" width="100%" height="210px">
                                    <p>{{ $serie['title'] }}</p>
                                </a>
                                <hr class="hr-bottom">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="verbetes">
                <h2 class="home-title home-title-sections">Verbetes</h2>

                <div class="tags-list">
                    @foreach((array_slice($tagsToShow, 0, 10) ?? []) as $tag)
                        <a href="{{ route('searchByTag', $tag['id']) }}" class="label">
                            {{ $tag['name'] }}
                        </a>
                    @endforeach
                </div>

                <div class="row flex slider slider-verbete">
                    @foreach($subjects as $key => $subject)
                        @if(!isset($subject['inactive']))
                            <div class="col-md-3 mb-3 card-container">
                                <div class="card card-body p-0">
                                    <hr>
                                    <a href="{{ route('showSpecialPage', $key) }}">
                                        <img class="img-fluid" src="{{ $subject['image'] }}" alt="Video thumbnail">
                                        <p>{{ $subject['name'] }}</p>
                                    </a>
                                    <hr class="hr-bottom">
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <hr>

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
