@extends('layouts.app')

@section('content')
    <div class="bg-image content-bg-image content-team">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-10" style="margin-top: 30%">
                    <h1>Sobre a Plataforma de Cidadania Digital</h1>
                    <hr/>
                    <p>
                        O advento das redes digitais de última geração ampliou as práticas e as formas de participação, oferecendo aos cidadãos comuns não somente as condições técnicas para o acesso imediato às informações públicas, mas também à palavra pública, isto é, a possibilidade de se expressar publicamente e com uma grande visibilidade, poder esse até então restrito aos líderes de opinião e aos grandes canais midiáticos.
                    </p>
                    <p>
                        Contudo, além dessas qualitativas alterações das relações entre os cidadãos e as instituições em todo o mundo, o advento das redes de última geração começou a conectar as pessoas, além dos dispositivos tecnológicos e redes sociais, às coisas (Internet of things), aos bancos de dados ilimitados (Big Data) e a inteligências artificiais, gerando alterações importantes não apenas nas relações sociais, mas na própria morfologia do social.
                    </p>
                    <p>
                        Passamos a interagir em rede com algoritmos, bancos de dados autopoiéticos e inteligências relacionais não humanas. Ao lado das enormes possibilidades de participação direta por parte da população, facilitadas pela construção de plataformas e arquiteturas de interação, surgem problemáticas inéditas e complexas em suas características. De um lado, a progressiva diminuição da distinção entre esfera pública e esfera privada, dilema esse que, pela facilidade de acesso aos dados, torna possível o monitoramento e o acesso às informações pessoais dos usuários por parte de grupos privados e agências de informações. Dessa maneira, as formas de conectividade continuada tornam rastreáveis os próprios cidadãos, deixando-os vulneráveis a campanhas publicitárias invasivas e à divulgação de seus interesses e comportamentos particulares.
                    </p>
                    <p>
                        De outro lado, essa mesma dimensão conectiva e de acesso aos dados apresenta, também, a possibilidade de empoderar os indivíduos e os consumidores, oferecendo condições para acompanhar as atividades das empresas, das instituições e de seus próprios representantes. Se a tais transformações acrescentamos o papel ativo dos dados e dos algoritmos nas atividades cotidianas, assim como em nossa participação na vida pública, compreende-se a necessidade de formação e de pesquisa perante esse novo e complexo universo de interação entre pessoas, dados, dispositivos e redes inteligentes.
                    </p>
                    <p>
                        A Plataforma de Cidadania Digital será fundada em um ambiente virtual com Recursos Educacionais Abertos e contará com um banco de dados de cursos, palestras, textos, blog interativo, podcasts, entrevistas, exemplos internacionais de práticas de cidadania digital. Ao longo de sua implementação, serão sediadas iniciativas físicas de impacto social com foco na população jovem e sua produção em rede. Para isso contará com cursos de ativação de estudantes, professores e outros profissionais interessados em promover uma iniciativa de cidadania digital. A plataforma contará com uma área de ativação cidadã onde será possível proporcionar atividades para que jovens identifiquem problemas em seus contextos que queiram resolver. Essas iniciativas podem ser compartilhadas tanto na plataforma, porém serão encorajados a publicar em outras redes para conectar outras ativações.
                    </p>
                    <p>
                        O objetivo é compor um processo de cidadania disseminativo e participativo. Contará com 4 ambiente: o diretório de conteúdo, arquitetura de formação, wiki cidadania e o prêmio de cidadania digital
                    </p>
                </div>
                <div class="col-md-10">
                    <div class="pt-5 pb-5">
                        <h2>Ecossistema da Plataforma</h2>
                        <hr/>
                        <div class="mb-4">
                            <h3>Diretório de Conteúdos</h3>
                            <p>
                                O Diretório de Conteúdos (DC), em fase inicial de desenvolvimento, funciona como o core da plataforma de Cidadania Digital. Neste espaço estão sendo disponibilizados artigos, arquivos de áudio e vídeo (filmes, docs, entrevistas, podcasts, etc) e imagens relacionadas à temática da cidadania digital. Este banco de dados é alimentado manualmente por professores e pesquisadores que são responsáveis por preencher um conjunto de metadados relacionados a cada informação (artigo, vídeo, áudio ou imagem) que é indexada no DC. Inicialmente, a plataforma não irá armazenar nenhum conteúdo em servidores próprios e todas as informações já estão disponibilizadas online em outros repositórios. Seu funcionamento será como um hub de conteúdos pertinentes cabendo aos professores e pesquisadores a curadoria e alimentação da plataforma com os metadados necessários para o redirecionamento dos conteúdos.
                            </p>
                            <p>
                                Por Cidadania Digital ser um conceito guarda-chuva que envolve uma vasta gama de outros conceitos e áreas do conhecimento, todo conteúdo agregado à plataforma é categorizado em tags temáticas (verbetes) de responsabilidade dos professores e pesquisadores envolvidos com aquele específico campo do conhecimento. Apesar de partirmos de um número pré-definido de tags (condicionado pelos colaboradores que encabeçam essa iniciativa), outras serão criadas e as existentes ampliadas de acordo com as demandas de expansão da rede. Algumas das tags já trabalhadas envolvem governança digital, net-ativismo, mídias nativas, design, blockchain, algoritmos, green data e mudanças climáticas, regulação e acesso a dados, entre outros
                            </p>
                            <p>
                                Os metadados, por sua vez, se referem às informações específicas que estão sendo anexadas a cada uma das tags: tipo, sub-tema, título, autor, palavras chaves, descrição, canal de publicação, etc. Inicialmente estamos trabalhando com um grupo básico de metadados, mas à medida que os conteúdos forem se complexificando, pretendemos também expandir as informações referentes a cada um deles.
                            </p>
                        </div>

                        <div class="mb-4">
                            <h3>WikiCidadania</h3>
                            <p>
                                A plataforma WikiCidadania funciona como um glossário colaborativo no qual todos os verbetes e conceitos (muitos oriundos das tags) abordados na plataforma Cidadania Digital serão explicados em toda sua profundidade e extensão, bem como interrelacionados entre si e outros conteúdos. A proposta é que a WikiCidadania seja construída de maneira colaborativa mesclando contribuições de pesquisadores, professores e usuários e, por isso, é compreendida como uma plataforma distinta, com um conjunto de funcionalidades específico, mas que poderá facilmente se integrar ao complexo da Plataforma de Cidadania Digital.
                            </p>
                        </div>

                        <div class="mb-4">
                            <h3>Escola de Cidadania Digital</h3>
                            <p>
                                A Escola de Cidadania Digital é uma segunda ramificação voltada para cursos e capacitação, absorvendo todo o material do diretório de conteúdos e da WikiCidadania para aplicação em cursos online, aulas à distância, workshops presenciais, seminários, palestras, consultorias de projetos, etc. configurando um espaço de aprendizado coletivo com todo o ferramental necessário e disponível pelo sistema Moodle. Assim como em toda a plataforma de Cidadania Digital, os cursos serão categorizados por tags indicando os assuntos abordados e o modelo de curso (se workshop, seminários, consultorias ou outros).
                            </p>
                        </div>

                        <div class="mb-4">
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
@endsection
