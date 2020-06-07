@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-transparent">
        <div class="container">
            <h1>Uma iniciativa internacional para a promoção e educação para a Cidadania Digital</h1>
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

        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Diretório de Conteúdos</h2>
                    <p>
                        O Diretório de Conteúdos (DC), em fase inicial de desenvolvimento, funciona como o core da plataforma de Cidadania Digital. Neste espaço estão sendo disponibilizados artigos, arquivos de áudio e vídeo (filmes, docs, entrevistas, podcasts, etc) e imagens relacionadas à temática da cidadania digital. Este banco de dados é alimentado manualmente por professores e pesquisadores que são responsáveis por preencher um conjunto de metadados relacionados a cada informação (artigo, vídeo, áudio ou imagem) que é indexada no DC. Inicialmente, a plataforma não irá armazenar nenhum conteúdo em servidores próprios e todas as informações já estão disponibilizadas online em outros repositórios. Seu funcionamento será como um hub de conteúdos pertinentes cabendo aos professores e pesquisadores a curadoria e alimentação da plataforma com os metadados necessários para o redirecionamento dos conteúdos.
                    </p>
                    <p>
                        Por <em>Cidadania Digital</em> ser um conceito guarda-chuva que envolve uma vasta gama de outros conceitos e áreas do conhecimento, todo conteúdo agregado à plataforma é categorizado em tags temáticas (verbetes) de responsabilidade dos professores e pesquisadores envolvidos com aquele específico campo do conhecimento. Apesar de partirmos de um número pré-definido de tags (condicionado pelos colaboradores que encabeçam essa iniciativa), outras serão criadas e as existentes ampliadas de acordo com as demandas de expansão da rede. Algumas das tags já trabalhadas envolvem <em>governança digital, net-ativismo, mídias nativas, design, blockchain, algoritmos, green data e mudanças climáticas, regulação e acesso a dados</em>, entre outros
                    </p>
                    <p>
                        Os metadados, por sua vez, se referem às informações específicas que estão sendo anexadas a cada uma das tags: tipo, sub-tema, título, autoria, palavras chaves, descrição, canal de publicação, etc. Inicialmente estamos trabalhando com um grupo básico de metadados, mas à medida que os conteúdos forem se complexificando, pretendemos também expandir as informações referentes a cada um deles.
                    </p>
                    <p>
                        Este é Diretório de Conteúdos.
                    </p>
                </div>
                <div class="col-md-4 pr-0">
                    <div class="push-top">
                        @foreach($resources->items() as $resource)
                            {{ view('resources.content', compact('resource')) }}
                        @endforeach
                        <div class="col-12 pb-2 p-0">
                            <div class="float-right">
                                <a href="{{ route('showAll') }}" class="btn btn-sm btn-outline-info">
                                    {{ __('Acessar Diretório') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row pt-5 pb-5">
            <h3>Está por vir...</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">WikiCidadania</h5>
                            <hr>
                            <p>
                                A plataforma WikiCidadania funciona como um glossário colaborativo no qual todos os verbetes e conceitos (muitos oriundos das tags) abordados na plataforma Cidadania Digital serão explicados em toda sua profundidade e extensão, bem como interrelacionados entre si e outros conteúdos. A proposta é que a WikiCidadania seja construída de maneira colaborativa mesclando contribuições de pesquisadores, professores e usuários e, por isso, é compreendida como uma plataforma distinta, com um conjunto de funcionalidades específico, mas que poderá facilmente se integrar ao complexo da Plataforma de Cidadania Digital.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Escola de Cidadania Digital</h5>
                            <hr>
                            <p>
                                A Escola de Cidadania Digital é uma segunda ramificação voltada para cursos e capacitação, absorvendo todo o material do diretório de conteúdos e da WikiCidadania para aplicação em cursos online, aulas à distância, workshops presenciais, seminários, palestras, consultorias de projetos, etc. configurando um espaço de aprendizado coletivo com todo o ferramental necessário e disponível pelo sistema Moodle. Assim como em toda a plataforma de Cidadania Digital, os cursos serão categorizados por tags indicando os assuntos abordados e o modelo de curso (se workshop, seminários, consultorias ou outros).
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Prêmio Cidadania Digital</h5>
                            <hr>
                            <p>
                                Por ser uma plataforma dedicada à promoção da Cidadania Digital, acreditamos ser fundamental o reconhecimento de iniciativas que possam servir de modelo e inspiração para outras. Portanto, a terceira área a ser desenvolvida é um espaço de divulgação e premiação das melhores experiências em cidadania digital coordenadas por usuários, empresas, organizações e municipalidades em todo o território nacional e internacional. Pretendemos também que o Prêmio de Cidadania Digital se converta em um evento sazonal para dar ainda mais visibilidade a todas essas iniciativas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
