@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="container text-center mb-3">
            <h1>Uma iniciativa internacional para a promoção e educação para a Cidadania Digital</h1>
            <hr/>
            <p>
                Uma iniciativa do Centro Internacional de Pesquisa Atopos (ECA/USP) em parceria com outras instituições de ensino e pesquisa, a Plataforma de Cidadania Digital pretende ser um ambiente virtual com recursos educacionais abertos, a contar com um banco de dados de cursos, palestras, textos, podcasts, entrevistas e exemplos internacionais de práticas de Cidadania Digital. O objetivo é compor uma rede ampla formada não apenas por professores e pesquisadores, mas por qualquer pessoa interessada em promover uma iniciativa de cidadania digital, disseminativa e participativa, contando com quatro ambientes: o diretório de conteúdos, a arquitetura de formação denominada Escola de Cidadania Digital, o glossário WikiCidadania e o reconhecimento das práticas e iniciativas por meio do Prêmio da Cidadania Digital.
            </p>
            <div class="row">
                <div class="col-6">
                    <p class="text-center mt-5">
                        <a class="btn btn-primary"
                           href="https://34d58460-6c5d-4ec9-80bb-e7055249a338.filesusr.com/ugd/e30c33_7cc8e6a2745d4993b530e2cc4eb3dd12.pdf"
                           target="_blank"
                           style="background-color: #224a59;border-color: #224a59;"
                        >
                            {{ __('Leia o Manifesto da Cidadania Digital') }}
                        </a>
                    </p>
                </div>
                <div class="col-6">
                    <p class="mb-0">Realização:</p>
                    <img src="{{ url('/images/logos/atopos-logo.png') }}" alt="Atopos Logo" style="height: 7em;">
                    <img src="{{ url('/images/logos/usp-logo.png') }}" alt="USP Logo" style="height: 7em;">
                </div>
            </div>
        </div>
    </div>

    <div class="parallax">
        @if (session('status'))
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @if ($series)
            <div class="row jumbotron">
                <div class="container pb-5">
                    {{ view('series.series-wrapper', compact('series')) }}
                </div>
            </div>
        @endif

        <div class="container pt-5 pb-5">
            {{ view('subjects.carrousel-wrapper', compact('subjects')) }}
        </div>

        <div class="container pt-5 pb-5">
            {{ view('partners', compact('partners')) }}
        </div>

        {{ view('video-target') }}
    </div>
@endsection
