@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-transparent">
        <div class="container text-center">
            <h1>Uma iniciativa internacional para a promoção e educação para a Cidadania Digital</h1>
            <hr/>
            <p>
                Uma iniciativa do Centro Internacional de Pesquisa Atopos (ECA/USP) em parceria com outras instituições de ensino e pesquisa, a Plataforma de Cidadania Digital pretende ser um ambiente virtual com recursos educacionais abertos, a contar com um banco de dados de cursos, palestras, textos, podcasts, entrevistas e exemplos internacionais de práticas de Cidadania Digital. O objetivo é compor uma rede ampla formada não apenas por professores e pesquisadores, mas por qualquer pessoa interessada em promover uma iniciativa de cidadania digital, disseminativa e participativa, contando com quatro ambientes: o diretório de conteúdos, a arquitetura de formação denominada Escola de Cidadania Digital, o glossário WikiCidadania e o reconhecimento das práticas e iniciativas por meio do Prêmio da Cidadania Digital.
            </p>
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
            <div class="container pt-5 pb-5">
                {{ view('series.series-wrapper', compact('series')) }}
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
