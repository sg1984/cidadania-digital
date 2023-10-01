<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.v2.head')
</head>
<body id="app-2023">
    <div id="app">
        <main>
            <div
                class="background-img"
                style="background-image:
                            linear-gradient(270deg,
                              rgba(245,70,66,0),
                              #090E1F), url('{{ url('/images/page-about.png') }}');
                              background-position-x: right;
                              height: 100%;
                              background-repeat: no-repeat;
                              top: 0";
            >
            </div>

            @include('layouts.v2.menu')

            <div class="container">
                <hr style="position: relative; margin-top: -2px">
                <div id="sobre-nos">
                    <div class="row">
                        <div class="col-xs-12 col-sm-10 col-md-9 text-container">
                            <div>
                                <h1 style="z-index: 99;position: relative;">Sobre a Plataforma de Cidadania Digital</h1>

                                <p>
                                    O advento das redes digitais de última geração ampliou as práticas e as formas de participação, oferecendo aos cidadãos comuns não somente as condições técnicas para o acesso imediato às informações públicas, mas também à palavra pública, isto é, a possibilidade de se expressar publicamente e com uma grande visibilidade, poder esse até então restrito aos líderes de opinião e aos grandes canais midiáticos.
                                </p>
                                <p>
                                    Contudo, além dessas qualitativas alterações das relações entre os cidadãos e as instituições em todo o mundo, o advento das redes de última geração começou a conectar as pessoas, além dos dispositivos tecnológicos e redes sociais, às coisas (Internet of things), aos bancos de dados ilimitados (Big Data) e a inteligências artificiais, gerando alterações importantes não apenas nas relações sociais, mas na própria morfologia do social.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div
                    id="about-part-2-img"
                    class="background-img"
                    style="background-image:
                            linear-gradient(90deg,
                              rgba(245,70,66,0),
                              #090E1F), url('{{ url('/images/page-about-2.png') }}');
                              height: 100%;
                              background-repeat: no-repeat;
                              top: auto;
                              left: 0";
                >
                </div>

                <div id="sobre-nos" style="margin-top: 0;">
                    <div class="pt-4">
                        <div class="offset-sm-2 offset-md-4 col-xs-12 col-sm-10 col-md-9 text-container">
                            <p>
                                Passamos a interagir em rede com algoritmos, bancos de dados autopoiéticos e inteligências relacionais não humanas. Ao lado das enormes possibilidades de participação direta por parte da população, facilitadas pela construção de plataformas e arquiteturas de interação, surgem problemáticas inéditas e complexas em suas características. De um lado, a progressiva diminuição da distinção entre esfera pública e esfera privada, dilema esse que, pela facilidade de acesso aos dados, torna possível o monitoramento e o acesso às informações pessoais dos usuários por parte de grupos privados e agências de informações. Dessa maneira, as formas de conectividade continuada tornam rastreáveis os próprios cidadãos, deixando-os vulneráveis a campanhas publicitárias invasivas e à divulgação de seus interesses e comportamentos particulares.
                            </p>
                            <p>
                                De outro lado, essa mesma dimensão conectiva e de acesso aos dados apresenta, também, a possibilidade de empoderar os indivíduos e os consumidores, oferecendo condições para acompanhar as atividades das empresas, das instituições e de seus próprios representantes. Se a tais transformações acrescentamos o papel ativo dos dados e dos algoritmos nas atividades cotidianas, assim como em nossa participação na vida pública, compreende-se a necessidade de formação e de pesquisa perante esse novo e complexo universo de interação entre pessoas, dados, dispositivos e redes inteligentes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                id="about-part-3-img"
                class="background-img"
                style="background-image:
                            linear-gradient(270deg,
                              rgba(245,70,66,0),
                              #090E1F), url('{{ url('/images/page-about-3.png') }}');
                              background-position-x: right;
                              height: 100%;
                              background-repeat: no-repeat;
                              top: auto;";
            >
            </div>

            <div class="container mt-5">
                <div id="sobre-nos" style="margin-top: 200px !important;">
                    <div class="pt-5">
                        <div class="col-sm-10 col-md-9 text-container">
                            <p>
                                A Plataforma de Cidadania Digital será fundada em um ambiente virtual com Recursos Educacionais Abertos e contará com um banco de dados de cursos, palestras, textos, blog interativo, podcasts, entrevistas, exemplos internacionais de práticas de cidadania digital. Ao longo de sua implementação, serão sediadas iniciativas físicas de impacto social com foco na população jovem e sua produção em rede. Para isso contará com cursos de ativação de estudantes, professores e outros profissionais interessados em promover uma iniciativa de cidadania digital. A plataforma contará com uma área de ativação cidadã onde será possível proporcionar atividades para que jovens identifiquem problemas em seus contextos que queiram resolver. Essas iniciativas podem ser compartilhadas tanto na plataforma, porém serão encorajados a publicar em outras redes para conectar outras ativações.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container">
                    <div id="sobre-nos">
                        <p>
                            O objetivo é compor um processo de cidadania disseminativo e participativo. Contará com 4 ambiente: o diretório de conteúdo, arquitetura de formação, wiki cidadania e o prêmio de cidadania digital
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container">
                    <div class="col-xs-12">
                        <iframe
                            src="https://www.youtube.com/embed/OBvgv-vn0wk"
                            width="100%"
                            height="600"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div id="about" class="content-team">
                <div class="container pt-5 pb-5">
                    <div class="justify-content-center">
                        <div class="col-12">
                            <div id="ecossistema" class="row pt-5 pb-5">
                                <h2>Ecossistema da Plataforma</h2>
                                <div class="row">
                                    <div id="ecossistema-diretorio-conteudos" class="ecossistema-item col-xs-12 col-sm-6 mb-4">
                                        <h3>
                                            <a href="{{ route('v2.showAll') }}">{{ __('Diretório de Conteúdos') }}</a>
                                        </h3>
                                        <p>
                                            O Diretório de Conteúdos (DC), em fase inicial de desenvolvimento, funciona como o core da plataforma de Cidadania Digital. Neste espaço estão sendo disponibilizados artigos, arquivos de áudio e vídeo (filmes, docs, entrevistas, podcasts, etc) e imagens relacionadas à temática da cidadania digital. Este banco de dados é alimentado manualmente por professores e pesquisadores que são responsáveis por preencher um conjunto de metadados relacionados a cada informação (artigo, vídeo, áudio ou imagem) que é indexada no DC. Inicialmente, a plataforma não irá armazenar nenhum conteúdo em servidores próprios e todas as informações já estão disponibilizadas online em outros repositórios. Seu funcionamento será como um hub de conteúdos pertinentes cabendo aos professores e pesquisadores a curadoria e alimentação da plataforma com os metadados necessários para o redirecionamento dos conteúdos.
                                            <br>
                                            Por Cidadania Digital ser um conceito guarda-chuva que envolve uma vasta gama de outros conceitos e áreas do conhecimento, todo conteúdo agregado à plataforma é categorizado em tags temáticas (verbetes) de responsabilidade dos professores e pesquisadores envolvidos com aquele específico campo do conhecimento. Apesar de partirmos de um número pré-definido de tags (condicionado pelos colaboradores que encabeçam essa iniciativa), outras serão criadas e as existentes ampliadas de acordo com as demandas de expansão da rede. Algumas das tags já trabalhadas envolvem governança digital, net-ativismo, mídias nativas, design, blockchain, algoritmos, green data e mudanças climáticas, regulação e acesso a dados, entre outros
                                            <br>
                                            Os metadados, por sua vez, se referem às informações específicas que estão sendo anexadas a cada uma das tags: tipo, sub-tema, título, autor, palavras chaves, descrição, canal de publicação, etc. Inicialmente estamos trabalhando com um grupo básico de metadados, mas à medida que os conteúdos forem se complexificando, pretendemos também expandir as informações referentes a cada um deles.
                                        </p>

                                        <a class="ecossistema-veja-mais">{{ __('Veja mais') }}</a>
                                        <a class="ecossistema-veja-menos hidden">{{ __('Veja menos') }}</a>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 mb-4">
                                        <h3>
                                            <a href="http://wiki.plataformacidadaniadigital.com.br/" target="_blank">{{ __('WikiCidadania') }}</a>
                                        </h3>
                                        <p>
                                            A plataforma WikiCidadania funciona como um glossário colaborativo no qual todos os verbetes e conceitos (muitos oriundos das tags) abordados na plataforma Cidadania Digital serão explicados em toda sua profundidade e extensão, bem como interrelacionados entre si e outros conteúdos. A proposta é que a WikiCidadania seja construída de maneira colaborativa mesclando contribuições de pesquisadores, professores e usuários e, por isso, é compreendida como uma plataforma distinta, com um conjunto de funcionalidades específico, mas que poderá facilmente se integrar ao complexo da Plataforma de Cidadania Digital.
                                        </p>

                                    </div>

                                    <div class="col-xs-12 col-sm-6 mb-4 hidden">
                                        <h3>Escola de Cidadania Digital</h3>
                                        <p>
                                            A Escola de Cidadania Digital é uma segunda ramificação voltada para cursos e capacitação, absorvendo todo o material do diretório de conteúdos e da WikiCidadania para aplicação em cursos online, aulas à distância, workshops presenciais, seminários, palestras, consultorias de projetos, etc. configurando um espaço de aprendizado coletivo com todo o ferramental necessário e disponível pelo sistema Moodle. Assim como em toda a plataforma de Cidadania Digital, os cursos serão categorizados por tags indicando os assuntos abordados e o modelo de curso (se workshop, seminários, consultorias ou outros).
                                        </p>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 mb-4 hidden">
                                        <h3>Prêmio Cidadania Digital</h3>
                                        <p>
                                            Por ser uma plataforma dedicada à promoção da Cidadania Digital, acreditamos ser fundamental o reconhecimento de iniciativas que possam servir de modelo e inspiração para outras. Portanto, a terceira área a ser desenvolvida é um espaço de divulgação e premiação das melhores experiências em cidadania digital coordenadas por usuários, empresas, organizações e municipalidades em todo o território nacional e internacional. Pretendemos também que o Prêmio de Cidadania Digital se converta em um evento sazonal para dar ainda mais visibilidade a todas essas iniciativas.
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" id="about-masterclass">
                <div class="row">
                    <div class="col-sm-12 col-md-6 mt-3">
                        <img src="{{ url('/images/logos/masterclasses.png') }}" alt="Masterclass Unico" width="80%">

                        <p class="content">
                            Se atualize sobre a Era Digital e compreenda as implicações atuais e futuras em nossas vidas, na carreira e na própria sociedade.
                        </p>

                        <div class="professores">
                            <p class="flex">
                                <i class="fa-solid fa-2x fa-people-group"></i>
                                Professores: Massimo Di Felice, Derrick de Kerckhove, Ysadora Córdova, Eliete Pereira, Sônia Guajajara
                            </p>

                            <p class="flex realizacao">
                                Realização:
                                <img src="{{ url('/images/logos/atopos.png') }}" alt="Atopos logo">
                                <img src="{{ url('/images/logos/cidig.png') }}" alt="Cidadania Digital logo">
                                <img src="{{ url('/images/logos/unico.png') }}" alt="Unico logo">
                                <img src="{{ url('/images/logos/usp.png') }}" alt="USP logo">
                            </p>

                        </div>

                        <a class="about-us-link" href="{{ route('v2.showSpecialPage', 'unico') }}">
                            Quero participar
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        <img src="{{ url('/images/page-about-masterclass.png') }}">
                    </div>
                </div>
            </div>

            <div id="about-atopos">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                <img src="{{ url('/images/logos/atopos-white.png') }}">

                                <p>
                                    O ATOPOS é uma rede internacional de pesquisa formada por pesquisadores de diversas áreas que, em diversos países, investigam o impacto das tecnologias digitais nos distintos âmbitos da sociedade atual.
                                </p>
                                <p>
                                    Surgido na Escola de Comunicações e Artes da Universidade de São Paulo (ECA-USP), em 2005, tem como objetivo a produção de conhecimento transdisciplinar e inovador, assumindo os compromissos de formar pesquisadores, de produzir publicações e de estender e compartilhar os resultados das investigações por meio de um diálogo com os mais variados setores da sociedade.
                                </p>
                                <p>
                                    O ATOPOS conta com pesquisadores em nível de graduação e pós-graduação procedentes das áreas de Ciências Sociais, Comunicação, História, Arquitetura, Artes, Biologia, Filosofia, Física e Educação.
                                </p>

                                <a class="about-us-link" href="http://www.atopos.com.br/" target="_blank">
                                    Ir para o site
                                </a>

                            </div>

                            <div class="col-sm-12 col-md-5">
                                <img src="{{ url('/images/logos/atopos-graph.png') }}"
                                     alt="Atopos logo"
                                     width="120%"
                                     style="margin-top: 150px"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="about-equipe">
                <div class="col-xs-12">
                    <div class="container pt-5 pb-5">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <h1 class="mb-4">Conheça a Equipe</h1>

                                <div class="row">
                                    <div class="col-12 mb-5">
                                        @isset($coordinators)
                                            <div id="coordinator-container" class="row mt-2">
                                                @foreach($coordinators['people'] as $coordinator)
                                                    <div class="col-xs-12 col-sm-6">
                                                        <img src="{{ url('/images/team/massimo-team.png') }}" alt="{{ $coordinator['name'] }}" class="mr-2">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <div class="media-body">
                                                            <h5>{{ $coordinators['title'] }} </h5>
                                                            <a href="{{ route('v2.authorPage', $coordinator['slug']) }}">
                                                                <h3 class="mt-4">{{ $coordinator['name'] }}</h3>
                                                                <p class="mt-0 description">{{ $coordinator['minibio'] }}</p>
                                                            </a>
                                                        </div>
                                                        <p>
                                                            <a href="{{ route('v2.authorPage', $coordinator['slug']) }}">
                                                                Ver mais...
                                                            </a>
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endisset
                                    </div>
                                </div>

                                <div class="row content-home">
                                    @isset($researchers)
                                        <div class="col-12">
                                            <h2>{{ $researchers['title'] }}</h2>
                                        </div>

                                        <div class="row flex col-12 researchers-list slider slider-verbete">
                                            @foreach($researchers['people'] as $researcher)
                                                <div class="person-container media mb-5 card-container">
                                                    <div class="card card-body person-content">
                                                        <hr>
                                                        <div class="">
                                                            <a  href="{{ route('v2.authorPage', $researcher['slug']) }}"
                                                                class="mr-2 rounded-circle"
                                                                style="height: 7em;width: 7em;display: block;"
                                                            >
                                                                <img src="{{ $researcher['picture_url'] }}" alt="{{ $researcher['name'] }}"
                                                                     class="team-person-picture rounded-circle mr-2" />
                                                            </a>
                                                        </div>

                                                        <div class="text-center text">
                                                            <h5 class="mt-4 person-name">{{ $researcher['name'] }}</h5>
                                                            <div class="mt-0 minibio">
                                                                {{ $researcher['minibio'] ?? '-' }}
                                                            </div>
                                                        </div>

                                                        <a target="{{ isset($researcher['website']) ? '_blank' : '' }}"
                                                           href="{{ isset($researcher['website']) ? $researcher['website'] : route('v2.authorPage', $researcher['slug']) }}"
                                                        >
                                                            <p>Ver mais</p>
                                                        </a>

                                                        <div class="mb-2 flex">
                                                            @if(isset($researcher['lattes_url']) || isset($researcher['orcid_url']) || isset($researcher['linkedin_url']))
                                                                @isset($researcher['lattes_url'])
                                                                    <a href="{{ $researcher['lattes_url'] }}" target="_blank" style="text-decoration: none">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 17 17" fill="none">
                                                                            <path d="M4.19597 15.1208C2.47687 11.5983 1.45412 9.471 1.45412 9.41821C1.45412 9.33206 1.55915 9.34401 2.59202 9.54657C4.40859 9.90324 5.37914 10.0039 6.997 10.0045C9.13751 10.005 10.8805 9.66603 12.2348 8.98482C12.9513 8.6244 13.3821 8.3049 13.735 7.8721C14.1697 7.33869 14.3093 6.97133 14.3143 6.353C14.3187 5.7649 14.2395 5.45479 13.8992 4.73518C13.7645 4.45081 13.6463 4.12441 13.635 4.00989C13.6173 3.82558 13.6324 3.79917 13.7683 3.78344C14.0652 3.74827 15.5308 5.17106 16.0705 6.01833C17.0008 7.47952 17.0763 9.0602 16.2888 10.5888C15.805 11.5279 15.2705 12.1776 14.3754 12.9161C12.8877 14.1427 11.1586 14.9969 8.77082 15.685C7.4883 16.0549 5.41442 16.5034 4.9873 16.5034C4.89677 16.5034 4.72686 16.2065 4.19723 15.1202L4.19597 15.1208V15.1208ZM4.6747 9.44017C3.00464 9.22381 1.60326 9.03568 1.55985 9.02188C1.48565 8.99799 1.22021 8.11236 1.07047 7.39148C1.03274 7.20906 0.977356 6.72596 0.947194 6.31716C0.812524 4.493 1.20945 3.23177 2.27312 2.09769C4.07395 0.179212 7.92978 -0.0541787 12.2801 1.49197C13.0436 1.76372 13.3469 1.95241 13.2066 2.07001C13.1029 2.15682 12.3996 2.15556 11.1843 2.06623C9.28472 1.92658 7.83863 2.19077 7.09327 2.81474C5.95848 3.76455 6.13151 5.84663 7.59522 8.85011C7.75375 9.17532 7.91353 9.4936 7.95 9.55833C8.03496 9.70743 7.9733 9.84585 7.82546 9.83891C7.7625 9.83591 6.34464 9.65668 4.67466 9.44025L4.6747 9.44017ZM10.2773 7.80606C8.94437 7.5664 7.7461 6.73983 7.35927 5.79447C7.1737 5.34034 7.18249 4.74779 7.38064 4.39309C7.5599 4.07225 8.02283 3.70119 8.43737 3.54578C9.12742 3.28727 10.3357 3.39041 11.2164 3.78358C12.0523 4.15662 12.7933 4.81264 13.0688 5.42278C13.4224 6.2059 13.1279 7.07963 12.3706 7.49666C11.8686 7.77279 10.893 7.91684 10.2766 7.8061L10.2773 7.80606Z" fill="white"/>
                                                                        </svg>
                                                                    </a>
                                                                @endisset

                                                                @isset( $researcher['orcid_url'] )
                                                                    <a href="{{ $researcher['orcid_url'] }}" target="_blank" style="text-decoration: none">
                                                                        <img src="{{ url('/images/logos/orcid.svg') }}" alt="ORCID logo" style="height: 1.5rem;">
                                                                    </a>
                                                                @endisset

                                                                @isset( $researcher['linkedin_url'] )
                                                                    <a href="{{ $researcher['linkedin_url'] }}" target="_blank" style="text-decoration: none">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 18 19" fill="none">
                                                                            <path d="M15.9291 10.5588V16.0931H12.8989V10.9293C12.8989 9.63181 12.4604 8.74681 11.3639 8.74681C10.5267 8.74681 10.028 9.34381 9.80913 9.92056C9.72909 10.1268 9.70855 10.4141 9.70855 10.7028V16.0931H6.67688C6.67688 16.0931 6.71796 7.34806 6.67688 6.44131H9.70855V7.80931L9.68871 7.84081H9.70855V7.80931C10.1109 7.15306 10.8298 6.21481 12.4399 6.21481C14.4338 6.21481 15.9291 7.59481 15.9291 10.5588ZM3.50638 1.78906C2.47009 1.78906 1.7915 2.50906 1.7915 3.45631C1.7915 4.38256 2.45025 5.12431 3.46671 5.12431H3.48655C4.54409 5.12431 5.20071 4.38256 5.20071 3.45631C5.1823 2.50906 4.54409 1.78906 3.50638 1.78906ZM1.97142 16.0931H5.00167V6.44131H1.97142V16.0931Z" fill="white"/>
                                                                        </svg>
                                                                    </a>
                                                                @endisset
                                                            @else
                                                                &nbsp;
                                                            @endif
                                                        </div>

                                                        <hr class="hr-bottom">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endisset

                                    <div id="ver-equipe">
                                        <a class="about-us-link" href="{{ route('v2.team') }}">
                                            Ver toda a equipe
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
