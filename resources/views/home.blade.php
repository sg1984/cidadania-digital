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

        @foreach($homeVideos as $moduleName => $videos)
            <div class="container pt-5 pb-5">
                {{ view('carousel-videos', ['videosData' => $videos, 'sessionTitle' => $moduleName, 'carouselId' => Illuminate\Support\Str::of($moduleName)->slug('-')]) }}
            </div>
            @endforeach

        <div class="modal fade modal-home-video-target" id="modal-video" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-video-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="width:auto">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-video-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <iframe width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
