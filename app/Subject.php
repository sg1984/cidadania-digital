<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    const ALGORITMOS_CIDADANIA = 'algoritmos-cidadania';
    const BLOCKCHAIN_CIDADANIA = 'blockchain-cidadania';
    const BLOCKCHAIN_CIDADANIA_SERIE = 'serie-blockchain-cidadania';
    const CIDADANIA_TERCEIRO_MILENIO = 'cidadania-terceiro-milenio';
    const CODICE = 'codice';
    const COMPETENCIAS_CIDADANIA_SECULO_XXI = 'competencias-cidadania-seculo-21';
    const DATA_ECOLOGIA_CLIMA = 'data-ecologia-clima';
    const DESIGN_PLATAFORMAS_DIGITAIS = 'design-plataformas-digitais';
    const DIALOGOS_ATOPICOS = 'dialogos-atopicos';
    const DIGITALIZACAO_MEMORIA = 'digitalizacao-memoria';
    const DIREITO_SAUDE_DIGITAL = 'direito-saude-digital';
    const ECOLOGIA_INFORMACAO = 'ecologia-informacao';
    const GAMES_CIDADANIA = 'games-cidadania';
    const GOVERNANCA_DIGITAL = 'governanca-digital';
    const GREEN_DATA = 'green-data';
    const JORNALISMOS_POSSIVEIS = 'jornalismos-possiveis';
    const MEDICINA_DADOS = 'medicina-dados';
    const NET_ATIVISMO_CULTURA_HACKER = 'net-ativismo-cultura-hacker';
    const NET_ATIVISMO_INDIGENA = 'net-ativismo-indigena';
    const NOVAS_FORMAS_CIDADANIA = 'novas-formas-cidadania';
    const ONTOLOGIAS_CONTEMPORANEAS = 'ontologias-contemporaneas';
    const POS_CIDADES_REDES_DE_CIDADANIA = 'pos-cidades';
    const TEORIAS_NOVAS_FORMAS_CIDADANIA = 'teorias-novas-formas-cidadania';
    const TRANSLITERACIA_CIDADANIA_DIGITAL = 'transliteracia-cidadania-digital';
    const UNICO = 'unico';

    const DEFAULT_BACKGROUND_IMAGE = '/images/team/background.jpg';

    const SERIES_SUBJECT_MAP = [
        self::CIDADANIA_TERCEIRO_MILENIO => [
            self::TEORIAS_NOVAS_FORMAS_CIDADANIA,
            self::GREEN_DATA,
            self::ONTOLOGIAS_CONTEMPORANEAS
        ],
        self::CODICE => [
            self::BLOCKCHAIN_CIDADANIA,
            self::DESIGN_PLATAFORMAS_DIGITAIS,
            self::GOVERNANCA_DIGITAL,
            self::NET_ATIVISMO_CULTURA_HACKER
        ],
        self::BLOCKCHAIN_CIDADANIA_SERIE => [
            self::BLOCKCHAIN_CIDADANIA,
        ],
        self::DIREITO_SAUDE_DIGITAL => [
            self::MEDICINA_DADOS,
        ],
        self::DATA_ECOLOGIA_CLIMA => [
            self::GREEN_DATA,
        ],
        self::DIALOGOS_ATOPICOS => [
            self::BLOCKCHAIN_CIDADANIA,
            self::ECOLOGIA_INFORMACAO,
            self::GREEN_DATA,
            self::MEDICINA_DADOS,
            self::NET_ATIVISMO_INDIGENA,
            self::POS_CIDADES_REDES_DE_CIDADANIA,
            self::TRANSLITERACIA_CIDADANIA_DIGITAL,
        ],
    ];

    const SUBJECT_NAMES_IMAGES = [
        self::ALGORITMOS_CIDADANIA => [
            'name' => 'Algoritmos para Cidadania',
            'image' => '/images/subjects/algoritmosCidadania.jpg',
            'id' => self::ALGORITMOS_CIDADANIA,
            'inactive' => true,
        ],
        self::BLOCKCHAIN_CIDADANIA => [
            'name' => 'Blockchain para Cidadania',
            'image' => '/images/subjects/blockchainCidadania.jpg',
            'id' => self::BLOCKCHAIN_CIDADANIA,
        ],
        self::COMPETENCIAS_CIDADANIA_SECULO_XXI => [
            'name' => 'Competências para a Cidadania do Século XXI',
            'image' => self::DEFAULT_BACKGROUND_IMAGE,
            'id' => self::COMPETENCIAS_CIDADANIA_SECULO_XXI,
            'inactive' => true,
        ],
        self::DESIGN_PLATAFORMAS_DIGITAIS => [
            'name' => 'Design e Plataformas digitais',
            'image' => '/images/subjects/designPlataformasDigitais.jpg',
            'id' => self::DESIGN_PLATAFORMAS_DIGITAIS,
        ],
        self::DIGITALIZACAO_MEMORIA => [
            'name' => 'Digitalização da Memória',
            'image' => '/images/subjects/digitalizacaoMemoria.jpg',
            'id' => self::DIGITALIZACAO_MEMORIA,
            'inactive' => true,
        ],
        self::ECOLOGIA_INFORMACAO => [
            'name' => 'Ecologia da Informação: Big Data, Fake News e Mundos Possíveis.',
            'image' => '/images/subjects/ecologiaDaInformacao.jpg',
            'id' => self::ECOLOGIA_INFORMACAO,
        ],
        self::GAMES_CIDADANIA => [
            'name' => 'Games para Cidadania',
            'image' => '/images/subjects/gamesParaCidadania.jpg',
            'id' => self::GAMES_CIDADANIA,
        ],
        self::GOVERNANCA_DIGITAL => [
            'name' => 'Governança Digital',
            'image' => '/images/subjects/governancaDigital.jpg',
            'id' => self::GOVERNANCA_DIGITAL,
        ],
        self::GREEN_DATA => [
            'name' => 'Green Data, Ecologia e Mudanças Climáticas Globais',
            'image' => '/images/subjects/greendataEcologiaMudancasAmbientais.jpg',
            'id' => self::GREEN_DATA,
        ],
        self::JORNALISMOS_POSSIVEIS => [
            'name' => 'Jornalismos Possíveis, Mundos Possíveis',
            'image' => '/images/subjects/jornalismosPossiveis.jpg',
            'id' => self::JORNALISMOS_POSSIVEIS,
        ],
        self::MEDICINA_DADOS => [
            'name' => 'Medicina de Dados e Direito à Saúde Digital',
            'image' => '/images/subjects/medicinaDadosSaudeDigital.jpg',
            'id' => self::MEDICINA_DADOS,
        ],
        self::NET_ATIVISMO_CULTURA_HACKER => [
            'name' => 'Net-ativismo e Cultura Hacker',
            'image' => '/images/subjects/net-ativismoCulturaHacker.jpg',
            'id' => self::NET_ATIVISMO_CULTURA_HACKER,
        ],
        self::NET_ATIVISMO_INDIGENA => [
            'name' => 'Net-ativismo Indígena',
            'image' => '/images/subjects/net-ativismoIndigena.jpg',
            'id' => self::NET_ATIVISMO_INDIGENA,
        ],
        self::NOVAS_FORMAS_CIDADANIA => [
            'name' => 'Significados e Teorias das Novas Formas de Cidadania',
            'image' => self::DEFAULT_BACKGROUND_IMAGE,
            'id' => self::NOVAS_FORMAS_CIDADANIA,
        ],
        self::ONTOLOGIAS_CONTEMPORANEAS => [
            'name' => 'Ontologias Contemporâneas e Cidadania Digital',
            'image' => '/images/subjects/ontologiasContemporaneas.jpg',
            'id' => self::ONTOLOGIAS_CONTEMPORANEAS,
        ],
        self::POS_CIDADES_REDES_DE_CIDADANIA => [
            'name' => 'Pós-cidades e Redes de Cidadania',
            'image' => '/images/subjects/posCidades.jpg',
            'id' => self::POS_CIDADES_REDES_DE_CIDADANIA,
        ],
        self::TEORIAS_NOVAS_FORMAS_CIDADANIA => [
            'name' => 'Significados e Teorias das Novas Formas de Cidadania',
            'image' => '/images/subjects/significadoseTeoriasCidadania.jpg',
            'id' => self::TEORIAS_NOVAS_FORMAS_CIDADANIA,
        ],
        self::TRANSLITERACIA_CIDADANIA_DIGITAL => [
            'name' => 'Transliteracia para Cidadania Digital',
            'image' => '/images/subjects/transliteraciasCidadania.jpg',
            'id' => self::TRANSLITERACIA_CIDADANIA_DIGITAL,
        ],
    ];

    const SUBJECT_PAGES_CONTENT = [
        self::BLOCKCHAIN_CIDADANIA => [
            'subject_id' => 2,
            'videoId' => 'ruHWtX_pZkw',
            'description' => 'Blockchain é um veículo sem precedentes para digitalização da sociedade e transferência de valor,, viabilizando a junção do mundo off-line com o mundo on-line na Web3 – a internet democratica. Considerando que os “17 objetivos sustentáveis da ONU até 2030” para acabar com a pobreza e a fome no mundo, contam com a tecnologia blockchain para integrar indivíduos, empresas e governos, as arquiteturas blockchain impactam diretamente o desenvolvimento e exercício da cidadania digital.',
            'researchers' => [User::TATIANA_REVOREDO, User::ISABELLA_MOURA],
            'background-image' => '/images/subjects/blockchain.jpg',
            'background-credit' => '',
        ],
        self::DESIGN_PLATAFORMAS_DIGITAIS => [
            'subject_id' => 5,
            'videoId' => null,
            'description' => 'Acompanhando as transformações qualitativas tanto resultantes das sucessivas crises sociais, políticas, econômicas e ecológicas atribuídas ao pensamento dualista moderno, quanto o desenvolvimento e a difusão das tecnologias e plataformas digitais, o entendimento sobre design tem sido ressignificado tanto em extensão como profundidade, estendendo sua área de atuação para além dos objetos e peças gráficas cotidianos, alcançando cidades, paisagens, nações, culturas, genes e a própria natureza. A reflexão e o pensamento sobre o design elaborado por teóricos do campo, antropólogos, filósofos, sociólogos, historiados, cientistas da técnica, entre outros, tem servido como substrato para compreensão do nosso modo de ser no mundo e na busca por entender e reelaborar ontologias alternativas àquela oriunda da modernidade. Neste sentido, o verbete Design e Plataformas Digitais, visa abordar esses debates e reflexões, reunindo material que nos auxilie a pensar o papel do design no desenvolvimento da cidadania do terceiro milênio, na construção dos nossos espaços de participação que constituirão o nosso habitar e, consequentemente, na elaboração de uma nova ideia de social e sociedade.',
            'researchers' => [User::BRUNO_MADUREIRA_FERREIRA],
            'background-image' => '/images/subjects/design-plataformas-digitais_victor-garcia-unsplash.jpg',
            'background-credit' => 'victor-garcia/unsplash',
        ],
        self::ECOLOGIA_INFORMACAO => [
            'subject_id' => 7,
            'videoId' => 'oKINxlw6mMA',
            'description' => 'O advento da tecnologia digital e sua disseminação em escala planetária abalou os alicerces que sustentaram a percepção sobre o que seja verdade. No ambiente interativo das redes, a produção e a partilha de informações tornam-se incontroláveis, porque não podem mais permanecer restritas às fontes convencionais que detinham o domínio sobre sua emissão e circulação. As redes conectivas e interativas que habitamos romperam a lógica hierárquica emissor-receptor própria da comunicação de massa e instalaram em seu lugar uma permanente instabilidade quanto ao que pode ou não ser considerado verdadeiro ou confiável.',
            'researchers' => [User::TERESA_NEVES],
            'background-image' => '/images/subjects/ecologia-informacao_markus-spiske-unsplash.jpg',
            'background-credit' => 'markus-spiske/unsplash',
        ],
        self::GAMES_CIDADANIA => [
            'subject_id' => 9,
            'videoId' => 'iLQfTFIs7DE',
            'description' => 'Os games são produtos midiáticos interativos transdisciplinares com recursos artísticos, linguagem computacional e a construção da lógica de interação e ludicidade. Se trata de um produto complexo de ser e estar em um meio natural, artificial e, essencialmente, informacional, como é a cidadania digital. Assim, este verbete abarca a curadoria e mapeamento para identificar os games que tratam direta ou indiretamente a questão da cidadania. Também propõe investigar os conceitos de cidadania digital nos games e desenvolver um framework de game design para a cidadania digital.',
            'researchers' => [User::LEANDRO_KEY_HIGUCHI_YANAZA, User::IAN_DAWSEY],
            'background-image' => '/images/subjects/games-cidadania_minh-pham-unsplash.jpg',
            'background-credit' => 'minh-pham/unsplash',
        ],
        self::GOVERNANCA_DIGITAL => [
            'subject_id' => 8,
            'videoId' => 'wRSy08pNOSk',
            'description' => 'O estudo da Governança digital deve ser compreendido como um amplo ecossistema de interações entre cidadãos, redes de informações e Estado. Esse modelo aponta para um debate que envolve o tema do e-gov, mas vai além. Discute-se, também, as novas formas de governança digital levadas à cabo pelas Civc Techs e pelas GovTechs, o ciclo de políticas públicas e sua interação com a tecnologia, os desafios da contratação e inovação no poder público e o ecossistema de inovação surgido na sociedade civil para aprimorar a governança digital.',
            'researchers' => [User::ERICK_ROZA, User::MICHELLE_DIAS],
            'background-image' => '/images/subjects/governanca-digital_gustavo-leighton-unsplash.jpg',
            'background-credit' => 'gustavo-leighton/unsplash',
        ],
        self::GREEN_DATA => [
            'subject_id' => 10,
            'videoId' => 'DUFjMrIC1Is',
            'description' => 'Aqui, conceitos relacionados ao estudo dos processos de comunicação e de conexão na biosfera, tais como a Teoria de Gaia, servem ao estudo de exemplos de diferentes ecossistemas nos quais componentes ambientais (tais como a biodiversidade, a atmosfera e o clima) interagem com dispositivos tecnológicos (como sensores, dados, algoritmos etc.), transformando a comunicação, as relações e, por fim, as próprias estruturas das redes ecológicas formadas. Nossa espécie é apenas um dos elementos dessa ecologia, tanto quanto o são os dispositivos e os demais integrantes dessa rede ecossistêmica com os quais ela interage, compondo um novo modelo de cidadania.',
            'researchers' => [User::ALINE_PASCOALINO, User::JULLIANA_CUTOLO_TORRES, User::RITA_MACHADO_NARDY],
            'background-image' => '/images/subjects/green-data_jacob-buchhave-unsplash.jpg',
            'background-credit' => 'jacob-buchhave/unsplash',
        ],
        self::JORNALISMOS_POSSIVEIS => [
            'subject_id' => 20,
            'videoId' => 'k6Aq0goC-iM',
            'description' => 'A mirada aqui é a condução de uma epistemologia relacional rumo à construção de uma abordagem que denominamos Comunicação pelo Equívoco, uma operação comunicacional pela diferença, inspirada na tradução de mundos dos povos ameríndios. É a partir deste ponto que criamos o Observatório jornalismo(S), na Universidade Federal de Ouro Preto, onde lançamo-nos a imaginar jornalismos que traduzam mundos, sobretudo, a partir do encontro com a diferença (humanos e não humanos). Para isso damos continuidade às respectivas pesquisas, imaginando um “Jornalismo de Perspectivas” e colocando o “Jornalismo em Equívoco”.',
            'researchers' => [User::EVANDRO_MEDEIROS_LAIA, User::LARA_LINHALIS_GUIMARAES],
            'background-image' => '/images/subjects/jornalismos-possiveis_waldemar-brandt-unsplash.jpg',
            'background-credit' => 'waldemar-brandt/unsplash',
        ],
        self::NET_ATIVISMO_INDIGENA => [
            'subject_id' => 13,
            'videoId' => null,
            'description' => 'No Brasil, são mais de 250 povos ameríndios falantes de aproximadamente 160 idiomas. Esses povos estão nas redes, afirmam a sua dinamicidade cultural, na medida em que promovem a visibilidade dos conteúdos simbólicos de seus modos de existência. Além disso, a incorporação das tecnologias digitais por parte desses povos advém da percepção que a construção de novas estratégias comunicativas pode ajudar na pressão pela resolução de problemas históricos, como da garantia do direito à terra, à defesa dos territórios demarcados e à transmissão dos seus conhecimentos. De modo que essas questões envolvem igualmente a mobilização indígena, e não indígena, nesses ambientes informacionais digitais. Compreendemos essa atuação e protagonismo indígena como “net-ativismo", que envolve as características cosmopolíticas desses povos que possuem especificidades comunicativas e ecológicas próprias. A transversalidade do processo de digitalização designa a variação de sentidos da atuação indígena nas redes digitais associada aos seus modos de (re)existências e à agencialidade dos não humanos, correlatos às suas redes de relações.',
            'researchers' => [User::ELIETE_PEREIRA, User::THIAGO_CARDOSO_FRANCO],
            'background-image' => '/images/subjects/net-ativismo-indigena_deb-dowd-unsplash.jpg',
            'background-credit' => 'deb-dowd/unsplash',
        ],
        self::NET_ATIVISMO_CULTURA_HACKER => [
            'subject_id' => 12,
            'videoId' => 'CrDBgTAASbQ',
            'description' => 'A partir da perspectiva da comunicação, buscamos aqui refletir sobre as novas formas de ação em rede constituídas em colaboração com as tecnologias digitais, incluindo as culturas hacker, nas quais as ações das entidades não humanas - como os vírus, os algoritmos, o big data - tornam-se cada vez mais evidentes na sociedade em que vivemos. Logo, abordamos o conceito de net-ativismo, os marcos históricos dos movimentos net-ativistas, as ecologias de interação em rede, dentre outros tópicos relacionados aos fenômenos de participação coletiva.',
            'researchers' => [User::MARINA_MAGALHAES, User::MATHEUS_SOARES_CRUZ],
            'background-image' => '/images/subjects/net-ativismo-cultura-hacker_tarik-haiga-unsplash.jpg',
            'background-credit' => 'tarik-haiga/unsplash',
        ],
        self::TEORIAS_NOVAS_FORMAS_CIDADANIA => [
            'subject_id' => 15,
            'videoId' => 'aWbK1vRVQrQ',
            'description' => 'As transformações que interessam ao terceiro milênio não têm a ver apenas com as mudanças da nossa maneira de pensar e dos nossos hábitos. Muito mais interessa a alteração de nossa condição habitativa. As últimas gerações de tecnologias digitais, as mudanças climáticas e a pandemia contribuíram para a definitiva alteração da morfologia de nossa comunidade, mostrando a presença de novos atores no nosso convívio. O clima, as emissões, os vírus, mas também os algoritmos, os softwares, os dados, tornaram-se membros atuantes do nosso social, estendendo as fronteiras do mesmo para além dos muros da polis. Diante dessas mudanças, a ideia ocidental de sociedade baseada no contrato entre cidadãos e limitada ao convívio e à ação dos sujeitos humanos, assim como aquela de uma cidadania baseada apenas nos direitos fundamentais das pessoas, tornam-se inadequadas. A cidadania digital é hoje um âmbito de pesquisa transdisciplinar que se concentra sobre a superação do projeto político ocidental e o início de uma nova cultura da governança em redes complexas, caraterizadas por interações em arquiteturas não mais compostas de sujeito e de objeto. Objetivo deste verbetes é apresentar o debate, surgidos em diversos âmbitos disciplinares e as contribuições de diversos autores sobre os significados das transformações da ideia de cidadania.',
            'researchers' => [User::MASSIMO_DI_FELICE, User::MARCELLA_SCHNEIDER_FARIA_SANTOS],
            'background-image' => '/images/subjects/teorias-cidadania_josh-riemer-unsplash.jpg',
            'background-credit' => 'josh-riemer/unsplash',
        ],
        self::ONTOLOGIAS_CONTEMPORANEAS => [
            'subject_id' => 19,
            'videoId' => 'XbWxtCx-NCI',
            'description' => 'O referido verbete está relacionado a emergência de novas perspectivas ontológicas atentas ao contexto da cidadania digital, contrapondo-se às abordagens metafísicas e substancialistas que, durante séculos, contribuíram para uma definição fragmentada do agir político, do sujeito e da Natureza, dissociados entre si. No contexto em que nos debatemos com temas polêmicos, como engenharia genética, inteligência artificial, digitalização dos processos de informação, entre outros eventos, buscar-se-á através deste verbete contribuir para o debate e proposição de maneiras de pensar o humano, os objetos e a Natureza a partir da consideração das transformações propiciadas pelas tecnologias digitais no mundo contemporâneo.',
            'researchers' => [User::GENIVALDO_PAULINO_MONTEIRO],
            'background-image' => '/images/subjects/ontologias-contemporaneas_moritz-kindler-unsplash.jpg',
            'background-credit' => 'moritz-kindler/unsplash',
        ],
        self::POS_CIDADES_REDES_DE_CIDADANIA => [
            'subject_id' => 14,
            'videoId' => 'k7DiWWQhWCQ',
            'description' => 'Aborda a experimentação, discussão e reflexão sobre a concepção de cidade e cidadania atualizadas pela digitalidade e conectividade, as quais alteram a nossa condição habitativa. Compreende a cidade como uma entidade viva, complexa, agente e comunicativa, um entrelaçamento das dimensões que lhe dão forma e entidades que a compõem (biológicas, físicas, digitais). Destes entrelaçamentos emerge a cidade híbrida - cibricidade - onde espaços hibridizados transformam a noção de cidadania para além da ideia de território geográfico e de relações identitárias entre grupos humanos. A constituição de redes de cidadania, ampliadas pelas digitalidade e conectividade, instauram formas ecológicas complexas de  habitação e comunicação. ',
            'researchers' => [User::ELIANE_SCHLEMMER, User::JANAINA_MENEZES],
            'background-image' => '/images/subjects/pos-cidades_nasa-unsplash.jpg',
            'background-credit' => 'nasa/unsplash',
        ],
        self::MEDICINA_DADOS => [
            'subject_id' => 11,
            'videoId' => null,
            'description' => 'Com a seção dedicada à Saúde Digital, queremos refletir sobre as transformações que estão ocorrendo no contexto da saúde à luz dos processos de informação desencadeados pelas tecnologias digitais. Hoje, os processos de digitalização estão desafiando os rituais tradicionais de tratamento e diagnóstico por meio de ecossistemas terapêuticos informativos e transorgânicos gerados por dados, algoritmos e lógicas em rede. As mudanças em curso no mundo da saúde serão lidas no contexto de uma transformação cultural ditada pela transição da "medicina mecânica" para a "medicina informativa".',
            'researchers' => [User::SILVIA_SURRENTI],
            'background-image' => '/images/subjects/Big-Data-Precision-Medicine.jpg',
            'background-credit' => '',
        ],
        self::TRANSLITERACIA_CIDADANIA_DIGITAL => [
            'subject_id' => 17,
            'videoId' => 'vks7jfUt2ic',
            'description' => 'Com o avanço cronológico da modernidade e pós-modernidade, o viés antropocêntrico da tecnologia foi colocado em xeque, congregando ao caráter social a ação de outros actantes não-humanos. Nesse contexto, a própria prática e pensamento sobre a comunicação se altera, já que partia do princípio e dos mecanismos transmissores de mensagens de humano para humano e passa a agregar outros focos de rede que fogem ao olhar humanista. Esta tendência acompanha o campo da educação, movimento que culminou na utilização de um outro termo para designação das habilidades do Século XXI: a palavra “literacia”. Algumas disparidades estão presentes na esfera do termo, que são frutos, também, da emergência do contemporâneo conectado em países com diferentes realidades linguísticas, econômicas, políticas e culturais. A discussão acerca do termo (entre alfabetização, letramento e literacia) é importante, para que sua articulação não seja inapropriada ou mesmo dicotômica, levando em consideração que o estudo do conceito tem como principal objetivo a capacidade de transmissão dos seus princípios e seu potencial de cidadania. A variedade de dimensões e leituras sobre essa perspectiva, contribuíram para a UNESCO expandir o termo de literacia de mídia e informação para o conceito de transliteracy (que pode ser traduzido como Transliteracia). A reboque da tecnologia emergente, a Internet se constitui nesse cenário como uma aparente extensão do mundo real e por isso as literacias digitais se associam com às transliteracias nesse cenário.',
            'researchers' => [User::BEATRICE_BONAMI_ROSA],
            'background-image' => '/images/subjects/transliteracia_kevin-ku-unsplash.jpg',
            'background-credit' => 'kevin-ku/unsplash',
        ],
    ];

    const SERIES_PAGES = [
        self::CIDADANIA_TERCEIRO_MILENIO => [
            'title' => 'A Cidadania do Terceiro Milênio',
            'tags_ids' => [2,19,24,124],
            'videos' => [
                [
                    'id' => 'b58fYpvCsE4',
                    'title' => 'Apresentação por Massimo Di Felice',
                ],
                [
                    'id' => 'iyQ7pKNqJfc',
                    'title' => 'Ep. 01 – A Cidadania Biosférica por Antônio Donato Nobre (INPE)',
                ],
                [
                    'id' => '0Vg6CvpfZ7U',
                    'title' => 'Ep. 02 – A Cidadania das Galáxias por Armâncio França (USP)',
                ],
                [
                    'id' => 'eKlVihKJeXE',
                    'title' => 'Ep. 03 – Ecosofia por Michel Maffesoli (França)',
                ],
                [
                    'id' => 'asd7GIoxz_A',
                    'title' => 'Ep. 04 – A Info-cidadania por Massimo Di Felice (USP)',
                ],
            ],
            'description' => 'As inovações tecnológicas, as mudanças climáticas e a pandemia mudaram para sempre a nossa ideia de sociedade. Não habitamos mais a polis e nosso convívio não acontece mais apenas entre sujeitos políticos e seus conflitos de opiniões. Clima, vírus, algoritmos,  dados,  objetos conectados são os novos atores que passaram a fazer parte do nosso comum. Como será a cidadania do terceiro milênio estendida aos não humanos? A Cidadania do Terceiro Milênio mostra, através diversas abordagem disciplinares, como as partículas subatômicas, as tecnologias para a exploração das galáxias, as biodiversidades e as tecnologias de redes de ultima geração serão as novas arquiteturas do nosso comum a partir das quais construiremos outros tipos de cidadania.',
            'researchers' => [User::MASSIMO_DI_FELICE],
            'thumbnail' => '/images/series/cidadaniaTerceiroMilenio.jpg',
            'thumbnail-novo' => '/images/webseries/cidadania_terceiro_milenio.png',
            'background-image' => '/images/series/cidadania-terceiro-milenio_robynne-hu-unsplash.jpg',
            'background-img' => '/images/series/cidadania-terceiro-milenio_robynne-hu-unsplash.jpg',
            'background-credit' => 'robynne-hu/unsplash',
            'subjects' => self::SERIES_SUBJECT_MAP[self::CIDADANIA_TERCEIRO_MILENIO],
        ],
        self::CODICE => [
            'title' => 'Codice: a vida é digital',
            'tags_ids' => [3, 24, 51, 74, 81, 124],
            'videos' => [
                [
                    'id' => 'D_IZVQysitc',
                    'title' => 'Ep. 01 – Entrevista com Audrey Tang',
                ],
                [
                    'id' => 'xNCa9w51WBM',
                    'title' => 'Ep. 02 – Entrevista com Jacqueline Poh (GovTech)',
                ],
                [
                    'id' => 'RYpjvtXzWTE',
                    'title' => 'Ep. 03 – Entrevista com Hiroshi Ishiguro (Inteligência Artificial)',
                ],
                [
                    'id' => '4Bu0VsxzBF4',
                    'title' => 'Ep. 04 – Entrevista com Roger Ver (Blockchain e Criptomoedas)',
                ],
                [
                    'id' => 'V8ktpgxd77A',
                    'title' => 'Ep. 05 – Entrevista com Sangeet Choudary (Plataformas Digitais)',
                ],
                [
                    'id' => 'W1fReWh6WH0',
                    'title' => 'Ep. 06 – Entrevista com Martin Sorrell',
                ],
            ],
            'description' => 'A série Codice foi criada pela jornalista italiana Barbara Carfagna e reúne um conjunto de entrevistas a alguns dos mais importantes protagonistas da transformação digital da nossa época como Audrey Tang, Ministro de Assuntos Digitais de Taiwan, Jacqueline Poh, presidente da GovTech de Singapura, Hiroshi Ishiguro, professor da Univsidade de Osaka e pesquisador do campo da Inteligência Artificial, Roger Ver, CEO da Bitcoin.com, Sangeet Paul Choudary, autor do livro “Platform Revolution” e Martin Sorrell, megaempresário da comunicação.',
            'researchers' => [User::BARBARA_CARFAGNA],
            'thumbnail' => '/images/series/codice.jpg',
            'thumbnail-novo' => '/images/webseries/codice.png',
            'background-image' => '/images/series/codice_homem-vitruviano.jpg',
            'background-img' => '/images/series/codice_homem-vitruviano.jpg',
            'background-credit' => '',
            'subjects' => self::SERIES_SUBJECT_MAP[self::CODICE],
        ],
        self::BLOCKCHAIN_CIDADANIA_SERIE => [
            'title' => 'Blockchain para a Cidadania',
            'tags_ids' => [3],
            'videos' => [
                [
                    'id' => 'xWB7r4D08Lc',
                    'title' => 'Ep. 01 – Blockchain para a Cidadania [Parte 1]',
                ],
                [
                    'id' => 'vfXejCFIgmE',
                    'title' => 'Ep. 02 – Blockchain para a Cidadania [Parte 2]',
                ],
            ],
            'description' => 'A série mostra o poder disruptivos da “internet do valor” e seu potencial de criação de arquiteturas relacionais e de trocas, distribuídas e transparentes. Além dos bitcoin e as diversas criptomoedas, a série mostra o poder da blockchain de criar e gerir  arquiteturas de relações sem mediações e de maneira segura e colaborativa. Um enorme potencial para a gestão do bem publico que irá alterar o significado e a qualidade das relações entre cidadãos e instituições, entre indivíduos e meio-ambiente.',
            'researchers' => [User::TATIANA_REVOREDO, User::ISABELLA_MOURA],
            'thumbnail' => '/images/series/blockchain.jpg',
            'background-image' => '/images/series/blockchain-cidadania_blockchain.jpg',
            'background-img' => '/images/series/blockchain-cidadania_blockchain.jpg',
            'thumbnail-novo' => '/images/webseries/blockchain_cidadania.png',
            'background-credit' => '',
            'subjects' => self::SERIES_SUBJECT_MAP[self::BLOCKCHAIN_CIDADANIA_SERIE],
        ],
        self::DIREITO_SAUDE_DIGITAL => [
            'title' => 'Direito a saúde digital',
            'tags_ids' => [1, 23],
            'videos' => [
                [
                    'id' => 'iw8feq27fPA',
                    'title' => 'Ep. 01 – A Info-cura [Parte 1] por Silvia Surrenti',
                ],
                [
                    'id' => 'cRJQz0jcmAg',
                    'title' => 'Ep. 02 – A Info-cura [Parte 2] por Silvia Surrenti',
                ],
                [
                    'id' => 'QMZJKxepynI',
                    'title' => 'Ep. 03 – O caso Babylon por Silvia Surrenti',
                ],
            ],
            'description' => 'A série Direito a Saúde Digital apresenta o impacto das tecnologias digitais, dos Big Data e das formas automatizadas de inteligências no âmbito da saúde. Seja na gestão dos dados do paciente, seja no processo de construção do diagnóstico, na gestão da terapia e da relação medico-paciente o processo de dataficação está redesenhando o cenário da medicina atribuindo à cura, cada vez mais, um sentido informativo e cognitivo. Abre-se assim uma nova fronteira baseada nas possibilidades de gerir a saúde através dos dados e do acesso a formas de monitoramento e a predições algorítmicas. A digitalização da saúde além de melhorar o atendimento e a cura, por meio de técnicas mais rápidas e exatas, permite a redução radical dos custos e a extensão dos benefícios da prevenção e da terapia a um numero maior de pacientes. ',
            'researchers' => [User::SILVIA_SURRENTI],
            'thumbnail' => '/images/series/direitoSaudeDigital.jpg',
            'thumbnail-novo' => '/images/webseries/direito_saude_digital.png',
            'background-image' => '/images/series/direito-saude-digital_national-cancer-institute-unsplash.jpg',
            'background-img' => '/images/series/direito-saude-digital_national-cancer-institute-unsplash.jpg',
            'background-credit' => 'national-cancer-institute/unsplash',
            'subjects' => self::SERIES_SUBJECT_MAP[self::DIREITO_SAUDE_DIGITAL],
        ],
        self::DATA_ECOLOGIA_CLIMA => [
            'title' => 'Green Data, Info-ecologias e Mudanças Climáticas ',
            'tags_ids' => [18, 19, 41, 45],
            'videos' => [
                [
                    'id' => 'DUFjMrIC1Is',
                    'title' => 'Vídeo 1 - Apresetação do verbete Green Data, Ecologia e Mudanças Climáticas por Rita Nardy',
                ],
                [
                    'id' => 'QqwZJDEZ9Ng',
                    'title' => 'Vídeo 2 – Programa Beautiful Minds com James Lovelock falando sobre a Teoria de Gaia',
                ],
                [
                    'id' => 'UirW2aBP-PY',
                    'title' => 'Vídeo 3 – Como as árvores conversam entre si por uma rede subterrânea por BBC Brasil',
                ],
                [
                    'id' => 'Un2yBgIAxYs',
                    'title' => 'Vídeo 4 – How trees talk to each other por Suzanne Simard',
                ],
                [
                    'id' => 'gBGt5OeAQFk',
                    'title' => 'Vídeo 5 – Are plants conscious? por Stefano Mancuso em TEDxGranVíaSalon',
                ],
                [
                    'id' => 'JDdvd-XC_sI',
                    'title' => 'Vídeo 6 – Rios Voadores por Antônio Donato Nobre (INPE)',
                ],
                [
                    'id' => 'zsiTx5qjn7c',
                    'title' => 'Vídeo 7 – Eyes in the forest: saving wildlife in Colombia using camera traps and AI',
                ],
                [
                    'id' => 'DSl-9OA_jNo',
                    'title' => 'Vídeo 8 – Roleta Russa Climática',
                ],
                [
                    'id' => '6-x8VMK8fPo',
                    'title' => 'Vídeo 9 – Drones for mapping invasive species in Patagonia',
                ],
            ],
            'description' => 'As últimas gerações de redes, depois das relações sociais (web 2.0), passaram a conectar as coisas (Internet of Things), os dados (Big Data) e, através de sensores, o território e a biodiversidades, gerando uma rede de redes denominada The Internet of Everything. Mais que mídia, as últimas gerações de redes apresentam-se como habitat e ecossistemas relacionais no interior dos quais entidades diversas (humanos, biodiversidades, clima), enquanto transformadas em dados, passam a interagir de outra maneira. Nasce, assim, uma nova relação entre humanos e meio-ambiente não mais baseada na concepção sujeitocêntrica, mas nas interdependências de relações entre entidades-dados. Superando a dimensão sistêmica da sustentabilidade os green data e as info-ecologias permitem o monitoramento continuado das complexidades relacionais de um território assim como a criação de um novo tipo de contratualidade não mais centrada e limitadas aos humanos.',
            'researchers' => [User::ALINE_PASCOALINO, User::RITA_MACHADO_NARDY, User::JULLIANA_CUTOLO_TORRES],
            'thumbnail' => '/images/series/dataEcologiaMudancaClimatica.jpg',
            'thumbnail-novo' => '/images/webseries/greendata.png',
            'background-image' => '/images/series/data-ecologia-clima_agatha-valenca-unsplash.jpg',
            'background-img' => '/images/series/data-ecologia-clima_agatha-valenca-unsplash.jpg',
            'background-credit' => 'agatha-valenca/unsplash',
            'subjects' => self::SERIES_SUBJECT_MAP[self::DATA_ECOLOGIA_CLIMA],
        ],
        self::DIALOGOS_ATOPICOS => [
            'title' => 'Diálogos Atópicos',
            'tags_ids' => [1, 3, 13, 124],
            'videos' => [
                [
                    'id' => 'Xuu6rX1c-K4',
                    'title' => 'Ep. 01 – O Vírus com prof. João Pessoa Araújo Júnior (Unesp)',
                    'text' => 'O primeiro episódio, “O vírus”, traz uma entrevista com o prof. Dr. João Pessoa Araújo Junior, professor Associado do Departamento de Microbiologia e Imunologia da Unesp de Botucatu (SP) e membro da Sociedade Brasileira de Microbiologia. O diálogo aborda o que são os vírus e as suas formas comunicativas com os seres humanos e com outras entidades.',
                ],
                [
                    'id' => 'Tn3TE9c9NCU',
                    'title' => 'Ep. 02 – As funções dos algoritmos na pandemia com prof. Mario Pireddu (UniTus, Itália)',
                    'text' => 'O segundo episódio traz uma entrevista com o Prof. Mario Pireddu, professor da Universidade de Tuscia (Itália), onde coordena o curso de Graduação em Formação Digital. O diálogo aborda o que são os algoritmos, como funcionam e que papel desenvolvem, entre outras tecnologias digitais, em tempos de pandemia.',
                ],
                [
                    'id' => 'MnKsujuDWOw',
                    'title' => 'Ep. 03 – Pandemia e digitalização do nosso corpo social com prof. Derrick De Kerckhove (Un. de Toronto, Canadá)',
                    'text' => 'No terceiro episódio, o Prof. Derrick de Kerckhove, da Universidade de Toronto (Canadá), aborda reflexões pertinentes que a pandemia de Covid-19 trouxe para a humanidade, entre elas a concepção de sermos cidadãos globais. Ademais, o pensador aborda a relação do vírus com as mudanças climáticas em curso e os impactos que as tecnologias digitais trazem para o cotidiano e para as dinâmicas políticas tradicionais.',
                ],
                [
                    'id' => 'bNXRB8iORE4',
                    'title' => 'Ep. 04 – A tecnologia blockchain na pandemia com Tatiana Revoredo (The Oxford Blockchain Foundation)',
                    'text' => 'No quarto episódio, apresentamos uma entrevista com Tatiana Revoredo, especialista em blockchain pela Universidade de Oxford e pelo MIT (EUA), CSO na The Global Strategy,  membro fundadora da Oxford Blockchain Foundation e representante no Brasil do Observatório Europeu do Direito das Novas Tecnologias. A pesquisadora aborda questões sobre o surgimento e funcionamento da tecnologia blockchain e sua colaboração no combate à pandemia do Covid-19.',
                ],
                [
                    'id' => 'Jq7RRdkv-xE',
                    'title' => 'Ep. 05 – Especial EAD com profª. Eliane Schlemmer (Unisinos)',
                    'text' => 'O quinto episódio traz uma entrevista com Eliane Schlemmer, professora do programa de pós graduação em Educação da Unisinos e líder do Grupo de Pesquisa Educação Digital do CNPQ, por meio da identidade digital Violet Ladybird. Discutimos assuntos vinculados ao ensino e à educação à distância, como educação on-line,  híbrida e digital. Além disso, abordamos os aprendizados e desafios que a pandemia de coronavírus trouxe para o campo da Educação.',
                ],
                [
                    'id' => '_7Sw1YGSM0g',
                    'title' => 'Ep. 06 – Simpoiese Ameríndia com prof. Thiago Franco (UFAM)',
                    'text' => 'O sexto episódio traz uma entrevista com o Prof. Thiago Franco, professor Adjunto da Universidade Federal do Amazonas (UFAM) e membro do Centro Internacional de Pesquisa ATOPOS (USP). Thiago Franco conversa conosco sobre temas como cosmologia ameríndia, conectividades e o conceito de simpoiese. A entrevista conta também com as participações ameríndias de Josias Sateré e Luiz Krahô.',
                ],
                [
                    'id' => 'plCYCtfGetk',
                    'title' => 'Ep. 07 – Fake News e pandemia com profª. Teresa Neves (UFJF)',
                    'text' => 'No sétimo e último episódio, a prof. Teresa Neves encerra a primeira temporada do Diálogos Atópicos abordando a verdade e a mentira na era digital, além da relação do fenômeno das Fake News com a pandemia de coronavírus.',
                ],
            ],
            'description' => 'A série Diálogos Atópicos aborda, a partir de uma perspectiva interdisciplinar, as diversas consequências originadas pela pandemia de Covid-19. Desde as relações socias aos processos decisórios, as  formas de aprendizagem até a economia, cada setor da sociedade foi profundamente afetado e transformado pela disseminação do vírus. Junto com este, difundiu-se a consciência do surgimento de uma nova época caraterizada pelo advento de um novo tipo de complexidade na qual a dúvida e as qualidades emergentes tornam-se o horizonte natural.',
            'researchers' => [User::MARINA_MAGALHAES, User::MATHEUS_SOARES_CRUZ, User::TERESA_NEVES, User::TATIANA_REVOREDO, User::THIAGO_CARDOSO_FRANCO, User::ELIANE_SCHLEMMER],
            'thumbnail' => '/images/series/dialogos-atopicos.jpg',
            'thumbnail-novo' => '/images/webseries/dialogos_atopicos.png',
            'background-image' => '/images/series/dialogos-atopicos_alina-grubnyak-unsplash.jpg',
            'background-img' => '/images/series/dialogos-atopicos_alina-grubnyak-unsplash.jpg',
            'background-credit' => 'alina-grubnyak/unsplash',
            'subjects' => self::SERIES_SUBJECT_MAP[self::DIALOGOS_ATOPICOS],
        ],
        self::UNICO => [
            'title' => 'Masterclasses Identidade e Cidadania Digital - Unico & Atopos/USP',
            'tags_ids' => [],
            'researchers' => [User::MASSIMO_DI_FELICE],
            'videos' => [
                [
                    'id' => 'ZeSqVsT2hmA',
                    'title' => 'Introdução ao curso “Identidade e Cidadania Digital"',
                    'text' =>
                        '<b>Professor Massimo di Felice</b> - Coordenador do Centro Internacional de Pesquisa Atopos e Professor da USP. <br>
                        <b>Pedro Henrique Oliveira (Peagá Oliveira)</b> - Diretor de Comunicação da Unico. ',
                    'description' => 'As últimas gerações de redes conectam pessoas, dispositivos, coisas, dados, elementos da natureza e tudo mais que nos cerca. Esse é um novo tipo de ambiente não mais habitado apenas por humanos. Hoje, cada pessoa física e biológica corresponde a uma outra digital, semelhante e feita de dados.',
                    'authors' => [User::MASSIMO_DI_FELICE, User::PEDRO_HENRIQUE_OLIVEIRA],
                ],
                [
                    'id' => 'xPSBviVQ0d8',
                    'title' => 'Aula 1 - Identidades digitais não humanas',
                    'text' => '<b>Massimo di Felice</b> - Coordenador do Centro Internacional de Pesquisa Atopos e Professor da USP<br><br>
As últimas gerações de redes conectam pessoas, dispositivos, coisas, dados, elementos da natureza e tudo mais que nos cerca. Esse é um novo tipo de ambiente não mais habitado apenas por humanos. Hoje, cada pessoa física e biológica corresponde a uma outra digital, semelhante e feita de dados. Sim, você é um infovíduo! Nesta aula, são desvendadas as características e a complexidade dessa nova condição.
',
                    'description' => 'As últimas gerações de redes conectam pessoas, dispositivos, coisas, dados, elementos da natureza e tudo mais que nos cerca. Esse é um novo tipo de ambiente não mais habitado apenas por humanos. Hoje, cada pessoa física e biológica corresponde a uma outra digital, semelhante e feita de dados. Sim, você é um infovíduo! Nesta aula, são desvendadas as características e a complexidade dessa nova condição',
                    'authors' => [User::MASSIMO_DI_FELICE],
                ],
                [
                    'id' => 'nLEF7PrvqLc',
                    'title' => 'Aula 2 - Digital twin: a identidade na época do onlife',
                    'text' => '<b>Derrick de Kerckhove</b> - Autor de The Skin of Culture and Connected Intelligence e professor na Universidade de Toronto - Canadá. Foi Diretor do Programa McLuhan em Cultura e Tecnologia de 1983 a 2008.<br><br>
A evolução da internet superou as barreiras iniciais que separavam o mundo real do virtual. A conexão e os dispositivos móveis, num primeiro momento, e as plataformas digitais e o metaverso, atualmente, permitem a experiência de uma condição "onlife" - uma mescla de corpos, dados, arquiteturas físicas e informativas. O conteúdo traz essa transformação digital e o surgimento do conceito de digital twin ou gêmeo digital.
',
                    'description' => 'A evolução da internet superou as barreiras iniciais que separavam o mundo real do virtual. A conexão e os dispositivos móveis, num primeiro momento, e as plataformas digitais e o metaverso, atualmente, permitem a experiência de uma condição "onlife" - uma mescla de corpos, dados, arquiteturas físicas e informativas. O conteúdo traz essa transformação digital e o surgimento do conceito de digital twin ou gêmeo digital.',
                    'authors' => [User::DERRICK_DE_KERCKHOVE],
                    ],
                [
                    'id' => 'J1blB3gLFbc',
                    'title' => 'Aula 3 - Privacidade e Open Data',
                    'text' => '<b>Yasodara Cordova</b> – Ativista de privacidade na Internet há mais de 15 anos e pesquisadora-chefe de Privacidade da Unico.<br><br>
O Open Data, ou dados abertos, significa que dados podem ser acessados por pessoas, empresas, instituições, times de pesquisa de forma livre, fácil e ágil. O que parece tentador para a prestação de serviços e até mesmo inovação guarda uma outra face: a ameaça à privacidade. Nesta masterclass, todo esse movimento reforça a necessidade de garantirmos segurança e proteção de dados pessoais, que são fundamentais inclusive para estabelecer relações de confiança e limites na sociedade.
',
                    'description' => 'O Open Data, ou dados abertos, significa que dados podem ser acessados por pessoas, empresas, instituições, times de pesquisa de forma livre, fácil e ágil. O que parece tentador para a prestação de serviços e até mesmo inovação guarda uma outra face: a ameaça à privacidade. Nesta masterclass, todo esse movimento reforça a necessidade de garantirmos segurança e proteção de dados pessoais, que são fundamentais inclusive para estabelecer relações de confiança e limites na sociedade.',
                    'authors' => [User::YASODARA_CORDOVA],
                ],
                [
                    'id' => 'wPcGA_PWGig',
                    'title' => 'Aula 4 - As identidades indígenas nas redes digitais',
                    'text' => '<b>Eliete Pereira</b> - Doutora em Ciências da Comunicação pela Escola de Comunicações e Artes da USP e pesquisadora do Centro de Pesquisa ATOPOS (ECA/USP)<br><br>
Nos últimos anos, a presença das culturas indígenas nas redes cresceu de forma relevante. Esta masterclass vai apresentar como a digitalização dos povos ameríndios significou a criação de um novo tipo de protagonismo baseado na defesa de seus territórios e na digitalização de idiomas, mitos e visões de mundo.
',
                    'description' => 'Nos últimos anos, a presença das culturas indígenas nas redes cresceu de forma relevante. Esta masterclass vai apresentar como a digitalização dos povos ameríndios significou a criação de um novo tipo de protagonismo baseado na defesa de seus territórios e na digitalização de idiomas, mitos e visões de mundo.',
                    'authors' => [User::ELIETE_PEREIRA],
                ],
                [
                    'id' => '9vAX6CrA8m4',
                    'title' => 'Aula 5 – Liderança Indígena: conexão entre povos e diversidade na era digital',
                    'text' => '<b>Sonia Guajajara</b> – Atual ministra do Ministério dos povos Indígenas. Foi a primeira Deputada Federal Indígena em São Paulo, eleita em 2022. No mesmo ano, foi incluída na lista das 100 pessoas mais influentes da revista Time, publicada nos EUA.<br><br>
A internet foi um grande ponto de virada para o movimento indígena. Nos últimos anos, indígenas, principalmente mulheres, têm assumido cada vez mais protagonismo nas redes sociais e na sociedade, em prol da conexão com demais povos e do respeito à diversidade. Este conteúdo vai apresentar exemplos desse movimento por meio da voz de uma das principais lideranças indígenas da atualidade.
',
                    'description' => 'A internet foi um grande ponto de virada para o movimento indígena. Nos últimos anos, indígenas, principalmente mulheres, têm assumido cada vez mais protagonismo nas redes sociais e na sociedade, em prol da conexão com demais povos e do respeito à diversidade. Este conteúdo vai apresentar exemplos desse movimento por meio da voz de uma das principais lideranças indígenas da atualidade.',
                    'authors' => [User::SONIA_GUAJAJARA],
                ],
            ],
            'description' => 'Com a velocidade e complexidade das inovações tecnológicas, pode ser desafiador se manter atualizado nos temas da Era Digital e compreender as implicações atuais e futuras em nossas vidas, na carreira e na própria sociedade. Pensando nisso, a Unico, empresa brasileira especializada em identidade digital, fez uma parceria com o Centro Internacional de Pesquisa Atopos da Escola de Comunicações e Artes da Universidade de São Paulo (ECA/USP). Dessa colaboração inédita, surgiram as Masterclasses Identidade e Cidadania Digital - Unico & Atopos/USP, que são gratuitas e já estão disponíveis online.
<br><br>
O objetivo deste projeto é proporcionar um maior acesso a conceitos e aplicações sobre identidade e cidadania digital para que cada pessoa se torne cada vez mais consciente de sua atuação, suas oportunidades e seus direitos diante das rápidas transformações tecnológicas. A identidade é o ponto de partida para a definição e valorização de cada indivíduo em sua singularidade, bem como de uma comunidade. Já a identidade digital traz elementos adicionais como controle de dados, segurança e privacidade e é o elemento fundamental para o exercício da cidadania digital.
<br><br>
Ao todo, são cinco aulas ministradas por professores e profissionais de mercado que são referências em seus temas. Abertas ao público em geral, incluindo as redes de universidades públicas e privadas do Brasil, esta é mais uma oportunidade de contribuir não apenas na formação universitária, mas na empregabilidade e troca de experiências. A seguir, conheça os conteúdos de cada masterclass.
            ',
            'thumbnail' => '',
            'background-image' => '/images/series/dialogos-atopicos_alina-grubnyak-unsplash.jpg',
            'background-credit' => 'alina-grubnyak/unsplash',
            'background-img' => '/images/masterclasses-background.png',
            'logo-title' => '/images/logos/masterclasses.png',
            'sponsors' => [
                '/images/logos/unico.png',
                '/images/logos/atopos.png',
                '/images/logos/cidig.png',
            ],
        ],
    ];

    protected $fillable = ['name', 'is_active'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return bool
     */
    public function canBeExcluded()
    {
        return ! ($this->resources()->exists() || $this->users()->exists());
    }

    /**
     * @param int $tagId
     * @return bool
     */
    public function isTagAssociated(int $tagId): bool
    {
        foreach ($this->tags as $tag){
            if($tag->id === $tagId) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $subject
     * @return array
     */
    public static function getSeriesIdsFromSubjectId(string $subject): array {
        $seriesIds = [];
        foreach (self::SERIES_SUBJECT_MAP as $seriesName => $subjects) {
            foreach ($subjects as $subjectMap) {
                if ($subjectMap === $subject) {
                    $seriesIds[] = $seriesName;
                }
            }
        }

        return $seriesIds;
    }
}
