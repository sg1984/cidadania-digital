<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    const MASSIMO_DI_FELICE = [
        'name' => 'Massimo Di Felice',
        'university' => 'Universidade de São Paulo (USP)',
        'picture_url' => '/images/team/c_massimo_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/9759944648465918',
        'orcid_url' => 'https://orcid.org/0000-0002-6646-4321',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::NOVAS_FORMAS_CIDADANIA],
        'minibio' => 'Sociólogo pela Universidade La Sapienza de Roma e doutor em Ciências da Comunicação, é professor livre docente da Escola de Comunicações e Artes da Universidade de São Paulo (ECA/USP). Fundou e coordena o Centro de Pesquisa Internacional ATOPOS (ECA/USP) sobre redes digitais. É fundador do Centro de Pesquisa Internacional di Teoria Sociale per la Sostenibilitá - Sostenibilia da Universidade La Sapienza, e diretor científico do Istituto di Alti Studi Toposofia de Roma. Possui pós-doutorado pela Universidade Paris V Sorbonne, sendo professor visitante da Universidade Paul Valery de Montpellier e Universidade Lusófona do Porto. Autor de livros, ensaios e artigos editados na França, Itália, Portugal, Argentina e México, e em diversas revistas acadêmicas.',
    ];

    const ALINE_PASCOALINO = [
        'name' => 'Aline Pascoalino',
        'university' => 'Universidade Estadual de Campinas (Unicamp)',
        'picture_url' => '/images/team/c_aline_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/9310627652022593',
        'orcid_url' => 'https://orcid.org/0000-0003-0927-8474',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::GREEN_DATA],
        'minibio' => 'Graduada (2005), Mestra (2009) e Doutora (2013) em Geografia pela Universidade Estadual Paulista “Júlio de Mesquita Filho” (UNESP), com período sanduíche na Universidade do Porto (2012-2013). Atou como docente substituto ministrando disciplinas na área de Geografia Física, para os cursos de Geografia, Engenharia Ambiental e Ecologia da UNESP Rio Claro (2015-2016) e também como docente e pesquisadora do Instituto de Geociências e Ciências Exatas da Universidade do Estado de Minas Gerais (UEMG), ministrando disciplinas na área de Geografia Física para o curso de Licenciatura em Geografia (2017-2019). Atualmente, é professora e pesquisadora do Departamento de Geografia do Instituto de Geociências da Universidade Estadual de Campinas (UNICAMP), onde ministra as disciplinas de Climatologia, Climatologia Geográfica e Geografia da Saúde para os cursos de Geografia e Geologia; e Coordenadora do Laboratório de Estudos Climáticos (LECLIG). Atua em pesquisas na área de Análise Ambiental, Climatologia regional, Climatologia geográfica, Bioclimatologia Humana e Clima urbano e saúde.',
    ];

    const ANDRE_DALA_POSSA = [
        'name' => 'André Dala Possa',
        'university' => 'Instituto Federal de Santa Catarina (IFSC)',
        'picture_url' => '/images/team/c_andre_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/5833428083593564',
        'orcid_url' => 'https://orcid.org/0000-0003-1995-6670',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::COMPETENCIAS_CIDADANIA_SECULO_XXI],
        'minibio' => 'Professor do Centro de Referência em Formação e Educação a Distância (Cerfead) do Instituto Federal de Educação, Ciência e Tecnologia de Santa Catarina (IFSC) na área de EAD e Tecnologias Educacionais. Graduado em comunicação (jornalismo); mestre em Ciências Sociais; doutor em Ciências da Comunicação. Área de concentração: Interfaces sociais da comunicação - Comunicação e educação. É pesquisador associado em dois núcleos da USP: Observatório da Cultura Digital da Escola do Futuro e Atopos. Na gestão educacional, atuou como diretor de extensão, pró-reitor de extensão e relações externas e atualmente é reitor pro tempore do IFSC.',
    ];

    const BEATRICE_BONAMI_ROSA = [
        'name' => 'Beatrice Bonami Rosa',
        'university' => 'Atopos-USP',
        'picture_url' => '/images/team/c_beatrice_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/4413923184921993',
        'orcid_url' => 'https://orcid.org/0000-0002-4012-8098',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::TRANSLITERACIA_CIDADANIA_DIGITAL],
        'minibio' => 'Doutora em Ciências da Comunicação e Filosofia da Informação pela ECA-USP (Universidade de São Paulo) e IOE-UCL (University College London). Mestre em Educação e Inovação. Pesquisadora do Painel Independente para Preparação e Resposta à Pandemia (IPPPR / OMS). Jovem Embaixadora representando a América Latina e Caribe da UNESCO / GAPMIL e Cofundadora da HILA Alliance.',
    ];

    const BRUNO_MADUREIRA_FERREIRA = [
        'name' => 'Bruno Madureira Ferreira',
        'university' => 'Atopos-USP',
        'picture_url' => '/images/team/c_bruno_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/4326822090783006',
        'orcid_url' => 'https://orcid.org/0000-0002-3709-8801',
        'linkedin_url' => 'https://www.linkedin.com/in/brunomadureiraferreira',
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::DESIGN_PLATAFORMAS_DIGITAIS],
        'minibio' => 'Designer gráfico, bacharel em Comunicação Social pela Faculdade Esamc de Uberlândia (2015). Mestre em Ciências da Comunicação pela Universidade de São Paulo (USP), pesquisando design digital, plataformas digitais e participação política intermediada por plataformas digitais. É membro do Centro Internacional de Pesquisa Atopos (ECA/USP) sob coordenação do Prof. Dr. Massimo Di Felice, onde desenvolve trabalhos ligados a cidadania digital e design.',
    ];

    const CLAUDIA_LEONOR_GUEDES = [
        'name' => 'Cláudia Leonor Guedes de Azevedo Oliveira',
        'university' => 'Atopos-USP',
        'picture_url' => '/images/team/c_claudia_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/2697481875629130',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::DIGITALIZACAO_MEMORIA],
        'minibio' => 'Graduada em História (FFLCH), com Mestrado em Ciências da Comunicação (ECA-USP), na Universidade de São Paulo e especialização em Comunicação Estratégica de mercado (Unesp-Faac). Atualmente, é bolsista em nível de Doutorado na linha de pesquisa “Estudos em Comunicação para o Desenvolvimento”, na Universidade Lusófona do Porto, Portugal. Pelo Museu da Pessoa coordenou várias publicações, entre elas os livros Memórias dos Brasileiros e Memórias do Comércio em São Paulo: novos olhares (SESC-SP). Atuou e é Sócio-fundadora do Instituto Museu da Pessoa.Net. Desde 2005 é pesquisadora associada do Centro Internacional de Pesquisa Atopos (ECA-USP). Faz parte do Conselho Científico do Instituto Toposofia desde 2014. Em abril de 2016, tendo como madrinha a escritora Josefina Fraga, ingressou na Academia Bauruense de Letras, assumindo a cadeira de número 39, cujo patrono é o historiador Muricy Domingues.',
    ];

    const ELI_BORGES_JR = [
        'name' => 'Eli Borges Jr.',
        'university' => 'Atopos-USP',
        'picture_url' => '/images/team/c_eli_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/4808077090461020',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::ALGORITMOS_CIDADANIA],
        'minibio' => 'Doutor e mestre em Ciências da Comunicação pela Escola de Comunicações e Artes da Universidade de São Paulo (ECA/USP), é bacharel em Comunicação Social pela ECA/USP e em Filosofia pela Faculdade de Filosofia, Letras e Ciências Humanas da USP (FFLCH/USP). Foi bolsista de doutorado da Fundação de Amparo à Pesquisa do Estado de São Paulo (FAPESP) (Processo nº 2016/03588-7), dedicando-se à tese "Teoria da Forma Algorítmica. Entre uma estética e uma ética dos algoritmos: relações entre imagem, fruição e ação", sob a orientação do Prof. Dr. Massimo Di Felice. Entre 2018 e 2019, foi aluno do Programme Recherches Doctorales Libres da École des Hautes Études en Sciences Sociales (EHESS) de Paris (Bolsa BEPE-FAPESP, Processo nº 2018/06565-3), sob a supervisão do Prof. Dr. Georges Didi-Huberman. Tem experiência na área de Comunicação (Teoria e Filosofia da Comunicação, Comunicação Digital) em interdisciplinaridade com os campos da Filosofia, da Estética e das Artes, tendo desenvolvido pesquisa de mestrado sobre a relação entre os meios de comunicação e as artes do espetáculo, com orientação do Prof. Dr. Massimo Di Felice (Bolsa FAPESP). Foi coordenador-adjunto do Centro Internacional de Pesquisa Atopos USP, atuando nas linhas de pesquisa "Ecosofia" e "Aoristos", da qual hoje é coordenador. Realizou estágio de pesquisa de mestrado na U.F.R. Arts, Philosophie, Esthétique da Université de Paris 8 - Vincennes Saint-Denis (Bolsa BEPE - FAPESP), sob orientação da Profa. Dra. Erica Magris, além de intercâmbio acadêmico na Facoltà di Scienze Politiche, Sociologia e Comunicazione da Università La Sapienza di Roma. É coordenador, junto a Massimo Di Felice e Antonio Rafele, da coleção "Clássicos para a Comunicação", da Editora Paulus. Foi professor colaborador em cursos da ECA/USP. Atualmente, é professor na Escola de Ciências Sociais, Educação, Artes e Humanidades da Universidade Anhembi Morumbi (HECSA-UAM).',
    ];

    const ELIANE_SCHLEMMER = [
        'name' => 'Eliane Schlemmer',
        'university' => 'Universidade do Vale do Rio dos Sinos (Unisinos)',
        'picture_url' => '/images/team/eliane_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/5391034042353187',
        'orcid_url' => 'http://orcid.org/0000-0001-8264-3234',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::POS_CIDADES_REDES_DE_CIDADANIA],
        'minibio' => 'Bolsista de Produtividade em Pesquisa do CNPq – Nível 1D. Avaliadora ad-hoc da CAPES, CNPq e FAPERGS. Pós-Doutora em Educação – Ecossistemas de Inovação na Educação na cultura híbrida e multimodal, pela Universidade Aberta de Portugal – UAb-PT. Doutora em Informática na Educação e Mestre em Psicologia pela Universidade Federal do Rio Grande do Sul – UFRGS. Bacharel em Informática pela Universidade do Vale do Rio dos Sinos - UNISINOS.  Professora-pesquisadora titular do Programa de Pós-Graduação em Educação (nota 7 na CAPES) e do Programa de Pós-Graduação em Linguística Aplicada na UNISINOS. Líder do Grupo de Pesquisa Educação Digital - GPe-dU UNISINOS/CNPq, desde 2004. Pesquisadora-colaboradora na Unidade de Estudos do Local – ELO/UAb-PT e no Grupo de Pesquisa Atopos/USP.',
    ];

    const ELIETE_PEREIRA = [
        'name' => 'Eliete Pereira',
        'university' => 'Atopos - USP',
        'picture_url' => '/images/team/c_eliete_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/2632161956307005',
        'orcid_url' => 'http://orcid.org/0000-0002-4157-9608',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::NET_ATIVISMO_INDIGENA],
        'minibio' => 'Historiadora e mestre em Ciências Sociais (Universidade de Brasília), é doutora em Ciências da Comunicação (Universidade de São Paulo) com realização de estágio sanduíche no exterior com Bolsa Capes na Universidade IULM de Milão (2012). Desenvolveu pesquisa de pós-doutorado no Programa de Pós-Graduação Interunidades em Museologia (PPGMus), MAE/USP, com bolsa PNPD/Capes (2017) Desde 2005, é pesquisadora do Centro de Pesquisa ATOPOS da ECA-USP, onde coordena a linha de pesquisa - Tekó: a digitalização dos saberes locais. É pesquisadora do InterMuseologias - Laboratório Interfaces entre Museologias - Comunicação, Mediação, Públicos e Recepção, MAE-USP. Colaboradora como pesquisadora do \'Sostenibilia - Osservatorio Internazionale di teoria sociale sulle nuove tecnologie e la sostenibilità\' da Universidade La Sapienza de Roma.',
    ];

    const ERICK_ROZA = [
        'name' => 'Erick Roza',
        'university' => 'Universidade Anhembi Morumbi (UAM)',
        'picture_url' => '/images/team/erick_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/6625255974272754',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::GOVERNANCA_DIGITAL],
        'minibio' => 'Doutor em Comunicação Social além de possuir graduação e mestrado na mesma área pela Escola de Comunicações e Artes da Universidade de São Paulo. É, também, graduado em Ciências Sociais pela Faculdade de Filosofia, Letras e Ciências Humanas da USP. Atua como professor na área da Comunicação e das Ciências Sociais na Universidade Anhembi Morumbi (UAM).',
    ];

    const EVANDRO_MEDEIROS_LAIA = [
        'name' => 'Evandro José Medeiros Laia',
        'university' => 'Universidade Federal de Ouro Preto (UFOP)',
        'picture_url' => '/images/team/c_evandro_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/5801243635002643',
        'orcid_url' => 'https://orcid.org/0000-0002-8463-3176',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::JORNALISMOS_POSSIVEIS],
        'minibio' => 'Professor de Audiovisual no Departamento de Jornalismo, da Universidade Federal de Ouro Preto e Pesquisador Associado ao Programa de Pós-graduação em Comunicação da Universidade Federal de Juiz de Fora. É doutor em Comunicação e Cultura, pela Universidade Federal do Rio de Janeiro (2016), com estágio doutoral no Departamento de Antropologia Aplicada do Teachers College, Columbia University, em Nova Iorque. É mestre em Comunicação e Sociedade (2012) e bacharel em Comunicação Social, com habilitação em Jornalismo (2005), pela Universidade Federal de Juiz de Fora. Co-fundador do Observatório jornalismo(S), espaço para pensar “jornalismos possíveis, mundos possíveis” (youtube.com/jornalismos). É membro do Grupo de Pesquisa "Quintais: cultura da mídia, arte e resistência" (UFOP/CNPq) e do Grupo de Pesquisa "Núcleo de Jornalismo Audiovisual" (UFJF/CNPq). Integra a rede internacional de pesquisa Atopos (ECA/USP).',
    ];

    const GENIVALDO_PAULINO_MONTEIRO = [
        'name' => 'Genivaldo Paulino Monteiro',
        'university' => 'Universidade Estadual da Paraíba (UEPB)',
        'picture_url' => '/images/team/c_genivaldo_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/0848365220724566',
        'orcid_url' => 'https://orcid.org/0000-0003-3227-2222',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::ONTOLOGIAS_CONTEMPORANEAS],
        'minibio' => 'Mestre em Educação pelo PPGE-UFPE. Atualmente está concluindo o Doutorado em Educação no PPGE-FE, na Universidade de São Paulo (FEUSP). Foi professor temporário de Filosofia da Educação na UFPE e UFRPE. Atualmente atua como professor efetivo (assistente) na mesma disciplina, lotado no Departamento de Educação do Centro de Humanidades, da Universidade Estadual da Paraíba (CH-UEPB). Foi coordenador do curso de Pedagogia do CH-UEPB, atuando ainda como pesquisador PIBIC-UEPB na linha de Fundamentos da Educação. Atualmente participa como pesquisador da Plataforma de Cidadania Digital, coordenada pelo Centro Internacional de Pesquisa ATOPOS (ECA-USP), atuando na linha de pesquisa Dianoía, a qual versa sobre processos de aprendizagem em contextos digitais e reticulares. Na Plataforma de Cidadania Digital desenvolve ainda o verbete: Ontologias Contemporâneas e Cidadania Digital.',
    ];

    const IAN_DAWSEY = [
        'name' => 'Ian Dawsey',
        'university' => 'Atopos - USP',
        'picture_url' => '/images/team/c_ian_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/0627036401578542',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::GAMES_CIDADANIA],
        'minibio' => 'Formado em Jornalismo pela Faculdade Cásper Líbero, pós-graduado em Marketing e Gestão pela ESPM, mestre em Ciências da Comunicação pela Universidade de São Paulo e pesquisador do Centro Internacional de Pesquisa Atopos.',
    ];

    const ISABELLA_MOURA = [
        'name' => 'Isabella Moura',
        'university' => 'Atopos - USP',
        'picture_url' => '/images/team/isabella_foto.jpg',
        'lattes_url' => null,
        'orcid_url' => null,
        'linkedin_url' => 'https://www.linkedin.com/in/isabellamouraleite/',
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::BLOCKCHAIN_CIDADANIA],
        'minibio' => 'Especialista em Marketing Estratégico para novas tecnologias, com MBA pela Unicamp e Birkbeck - University of London. Possui vasta experiência em empresas de tecnologia no Brasil e nos EUA (Vale do Silício), tais como: CISCO,IBM, entre outras. Participou de congressos e conferências, bem como, do 1º Festival Internacional da Cidadania Digital, promovido pela USP/ATOPOS (2020) sobre “Plataformas Digitais e Blockchain para a Cidadania Digital”, e do evento realizado pelo Instituto Atopos na ECA/USP (2019), sobre “Governança e Cidadania na época das Plataformas Digitais e do Blockchain”. Ambos como painelista. É pesquisadora do instituto Atopos.',
    ];

    const JANAINA_MENEZES = [
        'name' => 'Janaína Menezes',
        'university' => 'Universidade do Vale do Rio dos Sinos (Unisinos)',
        'picture_url' => '/images/team/janaina_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/2206184493576245',
        'orcid_url' => 'https://orcid.org/0000-0002-6789-6951',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::POS_CIDADES_REDES_DE_CIDADANIA],
        'minibio' => 'Mestre em Educação pela Universidade do Vale do Rio dos Sinos- UNISINOS, especialização em Psicopedagogia, graduação em Pedagogia e Ciências Jurídicas. Atualmente é doutoranda em Educação (UNISINOS) e vinculada ao grupo de pesquisa GPe-dU/CNPq - Unisinos onde participa no desenvolvimento de projetos de pesquisa nacionais e internacionais.  Suas principais áreas de atuação são pesquisa, docência e assessoria na área da Educação, Educação Digital, Educação Híbrida e Multimodal, Games e Gamificação, Pensamento Computacional e Metodologias e Práticas Inventivas. Na área de Educação desde 1991, possui experiência docente na Educação Infantil, Ensino Fundamental, Ensino Médio e Pós-Graduação, bem como na formação de professores tanto da rede pública como privada. ',
    ];

    const JULLIANA_CUTOLO_TORRES = [
        'name' => 'Julliana Cutolo Torres',
        'university' => 'Atopos - USP',
        'picture_url' => '/images/team/julliana_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/1107219012259972',
        'orcid_url' => null,
        'linkedin_url' => 'https://www.linkedin.com/in/julliana-cutolo/',
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::GREEN_DATA],
        'minibio' => 'Gestora Ambiental. Mestre e Doutora em Ciências da Comunicação pela USP, com enfoque em redes digitais e sustentabilidade. Pesquisadora em Ecosofia, Green Data e Redes Ecométricas pelo Centro Internacional de Pesquisa ATOPOS/USP. Atua como palestrante, consultora e empreendedora de impacto socioambiental. Foi docente na FAPCOM e no Istituto Europeo di Design – IED-SP, e também no curso de especialização Redes Digitais, Terceiro Setor e Sustentabilidade (ECA-USP).',
    ];

    const LARA_LINHALIS_GUIMARAES = [
        'name' => 'Lara Linhalis Guimarães',
        'university' => 'Universidade Federal de Ouro Preto (UFOP)',
        'picture_url' => '/images/team/lara_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/4993800145519769',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::JORNALISMOS_POSSIVEIS],
        'minibio' => 'Formou-se em Comunicação Social/Jornalismo (UFV). É mestre em Comunicação e Sociedade (Facom/UFJF) e doutora em Comunicação e Cultura (Eco-UFRJ). Atualmente, Lara é professora adjunta do curso de Jornalismo da Ufop e pesquisadora associada do PPGCOM-UFJF. É integrante dos grupos de pesquisa “Quintais: cultura da mídia, arte e política” (Dejor/Ufop) e “Núcleo de Jornalismo e Audiovisual (NJA)” (Facom/UFJF), além de ser pesquisadora colaboradora da Plataforma Cidadania Digital (ATOPOS-USP). Lara é co-fundadora e pesquisadora do Observatório Jornalismo(S). É diretora e apresentadora da série audiovisual Traduções, junto com o professor e pesquisador Evandro Medeiros Laia (Ufop). Sua mirada de pesquisa busca inspiração nos modos de traduzir mundos operantes em cosmologias ameríndias para imaginar um “Jornalismo de Perspectivas”, experimento conceitual desenvolvido à época de sua pesquisa doutoral. Áreas de atuação: comunicação e antropologia; jornalismo e perspectivismo ameríndio; audiovisual; gestão de projetos em comunicação e cultura.',
    ];

    const LEANDRO_KEY_HIGUCHI_YANAZA = [
        'name' => 'Leandro Key Higuchi Yanaze',
        'university' => 'Universidade Federal de São Paulo (Unifesp)',
        'picture_url' => '/images/team/c_leandro_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/3243275619679099',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::GAMES_CIDADANIA],
        'minibio' => 'Doutor em Engenharia Elétrica (POLI-USP), mestre em Ciências da Comunicação (ECA-USP), especialista em Teorias e Práticas da Comunicação (Faculdade Cásper Líbero) e graduado em Arquitetura e Urbanismo (FAU-USP). Professor adjunto da Universidade Federal de São Paulo, atuando no Curso Superior de Tecnologia em Design Educacional. É vice-líder do Grupo de Pesquisa em Comunicação, Design e Tecnologias Digitais (CODE/Unifesp) e coordena a linha de pesquisa Tecnologias Interativas: educação, comunicação e design. Também é pesquisador do Centro Internacional de Pesquisa Atopos (ECA-USP), atuando em games para a cidadania digital. Tem atuado em pesquisas sobre design educacional, tecnologias imersivas, game design, games educacionais, games educacionais e acessibilidade. É autor dos livros “Redes digitais e sustentabilidade: as interações com o meio ambiente na era da informação” e “Tecno-pedagogia: os games na formação dos nativos digitais”.',
    ];

    const MARCELLA_SCHNEIDER_FARIA_SANTOS = [
        'name' => 'Marcella Schneider Faria-Santos',
        'university' => 'Faculdade Paulus de Comunicação (Fapcom)',
        'picture_url' => '/images/team/marcella_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/4538225010403283',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::TEORIAS_NOVAS_FORMAS_CIDADANIA],
        'minibio' => 'Mestre em Ciências da Comunicação pela ECA/USP, fez intercâmbio acadêmico em Portugal na Universidade Nova de Lisboa, possui graduação em Comunicação Social pela UNISANTA (Universidade Santa Cecília). É docente na FAPCOM (Faculdade Paulus de Comunicação), ministrando diferentes disciplinas na área de comunicação, sociologia e filosofia; é membro do NDE do curso de Filosofia e do curso de Publicidade e Propaganda, foi coordenadora do curso de Publicidade e Propaganda da FAPCOM; integrou a equipe de assessoria acadêmica desenvolvendo projetos pedagógicos (bacharelados, tecnológicos e licenciatura) e recepcionando comissões avaliadoras do MEC. É pesquisadora membro da Plataforma Cidadania Digital, coordenada pelo Centro de pesquisa Atopos da ECA/USP. Atua na linha de pesquisa AION - netativismo e teoria da ação; coordenou o intercâmbio acadêmico com a Universidade Nova de Lisboa, organizou eventos acadêmicos/culturais, como por exemplo, I Festival de Cidadania Digital; o II Seminário Mídias Nativas, o Seminário Mente, Tecnologia e Conectividade, com o Prof. Derrick De Kerkchove, entre outros. Realizou oficinas de comunicação baseada na metodologia educomunicação.',
    ];

    const MARINA_MAGALHAES = [
        'name' => 'Marina Magalhães',
        'university' => 'Universidade Estadual da Paraíba (UEPB)',
        'picture_url' => '/images/team/c_marina_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/8154864038845813',
        'orcid_url' => 'https://orcid.org/0000-0002-1124-8269',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::NET_ATIVISMO_CULTURA_HACKER],
        'minibio' => 'Formada em Jornalismo pela Universidade Federal da Paraíba, instituição na qual tornou-se Mestre em Comunicação e Culturas Midiáticas. É doutora em Ciências da Comunicação (Cultura Contemporânea e Novas Tecnologias) pela Universidade Nova de Lisboa, em Portugal. Além de ter atuado como repórter desde 2008 na imprensa nacional (G1) e internacional (Revista Brazil com Z - Espanha), já escreveu os livros “Polarizações do Jornalismo Cultural” (2008) e “Jornalistas no cotidiano das Redes digitais” (2013), publicados no Brasil pela Marca de Fantasia, e “Net-ativismo: protestos e subversões nas redes sociais digitais”(2018), publicado em Portugal pela Coleção ICNOVA. Atualmente é docente do curso de Jornalismo da Universidade Estadual da Paraíba (UEPB).',
    ];

    const MATHEUS_SOARES_CRUZ = [
        'name' => 'Matheus Soares Cruz',
        'university' => 'Atopos - USP',
        'picture_url' => '/images/team/c_matheus_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/7581313049842647',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::NET_ATIVISMO_CULTURA_HACKER],
        'minibio' => 'Mestrando em Ciências da Comunicação pela Escola de Comunicações e Artes da Universidade de São Paulo (ECA/USP) e bacharel em Comunicação Social com habilitação em Jornalismo pela UFRN. Bolsista de mestrado Capes e pesquisador integrante do Centro de Pesquisa Internacional Atopos (USP). Pesquisa sobre esfera pública em contextos digitais e formas de participação em rede.',
    ];

    const MICHELLE_DIAS = [
        'name' => 'Michelle Dias',
        'university' => 'Atopos - USP',
        'picture_url' => '/images/team/c_michelle_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/5119529563864444',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::GOVERNANCA_DIGITAL],
        'minibio' => 'Jornalista, com graduação em Comunicação Social: Habilitação Jornalismo e graduação em Administração de empresas. Possui mestrado em Comunicação e Semiótica pela Pontifícia Universidade Católica de São Paulo (PUC/SP). Atualmente, é doutoranda no Programa de Pós-graduação em Ciências da Comunicação, na Escola de Comunicações e Artes da Universidade de São Paulo (ECA/USP) e atua como Analista Legislativo – jornalista, na Assembleia Legislativa de Santa Catarina (Alesc). Tem experiência em televisão, rádio, mídia impressa e mídias digitais. Trabalhou em veículos regionais e nacionais e em produção de conteúdo e reportagem para site em Londres, UK, onde passou uma temporada estudando documentário audiovisual.',
    ];

    const RITA_MACHADO_NARDY = [
        'name' => 'Rita Machado de Campos Nardy',
        'university' => 'Atopos - USP',
        'picture_url' => '/images/team/c_rita_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/7338523612572486',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::GREEN_DATA],
        'minibio' => 'Bióloga, jornalista e mestre em Ecologia e Recursos Naturais (UFSCar), é sócia e consultora da Società Sustentabilidade (www.societaconsultoria.com.br). É doutoranda e pesquisadora da linha de pesquisa em Redes digitais e sustentabilidade, no Centro Internacional de Pesquisas Atopos (ECA USP - www.atopos.com.br) e é conselheira independente da ponteAponte (ponteaponte.com.br/equipe). Integra o verbete Green data, ecologia e mudanças climáticas da Plataforma Internacional de Cidadania Digital.',
    ];

    const SILVIA_SURRENTI = [
        'name' => 'Silvia Surrenti',
        'university' => 'Università degli Studi Firenzi (UniFI)',
        'picture_url' => '/images/team/c_surrenti_foto.jpg',
        'lattes_url' => null,
        'orcid_url' => 'https://orcid.org/0000-0003-1307-8862',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::MEDICINA_DADOS],
        'minibio' => 'Silvia Surrenti, Ph.D. is Assistant Professor of Urban and Health Studies in the Department of Clinical and Experimental Medicine. She is a member of the Health Services Research Centre, University of Florence, Italy. She holds a Ph.D. in Social Sciences from the European University Institute of Florence. Her interests lie at the interface of environmental studies, digital technologies, health and wellbeing studies. Her works include a book on the social relational space-time of the contemporary hospital (L’ospedale difficile. Lo spazio sociale della cura e della salute, 2014, with L. Chiesi) and a book on the hospital and city-life (L’ospedale, la città e la rivincita dell’esperienza, 2020).',
    ];

    const TATIANA_REVOREDO = [
        'name' => 'Tatiana Revoredo',
        'university' => 'The Oxford Blockchain Foundation (OXBF) e The Global Strategy',
        'picture_url' => '/images/team/c_tatiana_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/6569656306351959',
        'orcid_url' => null,
        'linkedin_url' => 'https://www.linkedin.com/in/tatianarevoredo/',
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::BLOCKCHAIN_CIDADANIA],
        'minibio' => 'Blockchain Strategist. CSO na the Global Strategy. Membro fundadora da Oxford Blockchain Foundation. Digital Representant no European Law Observatory on New Technologies. Especialista em Aplicativos de Negócios Blockchain pelo MIT. Estrategista em Blockchain pela Saïd Business School, University of Oxford. Especialista em Inteligência Artificial e Estratégia de Negócios pelo MIT Sloan e MIT CSAIL. Especialista em mitigação de riscos cibernéticos pela Harvard University. Convidada pelo Parlamento Europeu para o The Intercontinental Blockchain Conference. Convidada pelo Parlamento Brasileiro para Audiência Pública sobre Blockchain e Criptoativos. Autora dos livros “Blockchain - Tudo o que você precisa saber”, e “Bitcoin, CBDC, DeFi e Stablecoins – Qual o futuro do dinheiro”. Participou dos maiores eventos mundiais de Novas Tecnologias, como Word Web Forum, Business of Blockchain (MIT Media Lab), Blockchain e Fintech Symposium na Said Business School – Universidade de Oxford, EthCC Paris, Consensus, 1st Crypto Finance Conference, 1st Global Blockchain Congress, entre outros.',
    ];

    const TERESA_NEVES = [
        'name' => 'Teresa Neves',
        'university' => 'Universidade Federal de Juiz de Fora (UFJF)',
        'picture_url' => '/images/team/c_teresa_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/9383607198471679',
        'orcid_url' => null,
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::ECOLOGIA_INFORMACAO],
        'minibio' => 'Professora associada do Departamento de Fundamentos, Teorias e Contextos da Faculdade de Comunicação da UFJF e pós-doutora pela Escola de Comunicações e Artes da Universidade de São Paulo.  Possui doutorado em Estudos Literários pela Universidade Federal de Juiz de Fora, mestrado em Comunicação e Cultura pela Universidade Federal do Rio de Janeiro e graduação em Comunicação Social pela UFJF.',
    ];

    const THIAGO_CARDOSO_FRANCO = [
        'name' => 'Thiago Cardoso Franco',
        'university' => 'Universidade Federal do Amazonas (UFAM)',
        'picture_url' => '/images/team/c_thiago_foto.jpg',
        'lattes_url' => 'http://lattes.cnpq.br/7735628705551412',
        'orcid_url' => 'https://orcid.org/0000-0002-1774-4706',
        'linkedin_url' => null,
        'subject' => Subject::SUBJECT_NAMES_IMAGES[Subject::NET_ATIVISMO_INDIGENA],
        'minibio' => 'Professor Adjunto da Universidade Federal do Amazonas. Membro/coordenador do Centro Internacional de Pesquisa ATOPOS (USP), onde trabalha com teorias da comunicação e redes digitais. No mesmo centro de pesquisa é integrante da linha de pesquisa - Tekó: a digitalização dos saberes locais. Membro do Sostenibilia (Osservatorio Internazionale di Teoria Sociale Sulle Nuove Tecnologie e la Sostenibilità), Università Sapienza di Roma. Pesquisador associado do Sostenibília. Doutor em Ciência da Comunicação pela Escola de Comunicações e Artes (ECA), da Universidade de São Paulo (USP), na área de Teoria e Pesquisa em Comunicação, na linha de Comunicação e Ambiências em Redes Digitais; mestre em Comunicação, Cidadania e Cultura (2014); especialista em Comunicação Integrada (2008); graduado em Ciência da Comunicação (2006), pela UFG. É um dos coordenadores do Projeto Xingu, realizado em parceria com a Universidade Sapienza de Roma. Coordenador Geral do projeto "Amazônia contra a Covid 19", em parceria com a UNESCO e membro do comitê de Combate a Covid 19 (UFAM).',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'remember_token',
        'is_active', 'wiki_access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function resources()
    {
        return $this->hasMany(Resource::class, 'created_by');
    }

    /**
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * @return HasMany
     */
    public function createdTickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    /**
     * @return HasMany
     */
    public function receivedTickets()
    {
        return $this->hasMany(Ticket::class, 'responsible_id');
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * @return Builder|Model
     */
    public static function getAdminUser()
    {
        return User::query()
            ->firstWhere('is_admin', '=', true);
    }

    public function getWikiAccessToken()
    {
        return $this->wiki_access_token;
    }

    public function getWikiUrl()
    {
        $baseUrl = env('WIKI_BASE_URL');

        if($this->getWikiAccessToken()) {
            $baseUrl .= 'api.php?action=loginWithToken&format=json&loginToken=' . $this->getWikiAccessToken();
        }

        return $baseUrl;
    }

    public function hasWikiAccess()
    {
        return $this->getWikiAccessToken();
    }

    public static function getCoordinators(): array {
        return [
            self::getPersonMergedData(self::MASSIMO_DI_FELICE)
        ];
    }

    public static function getResearchers(): array {
        return [
            self::getPersonMergedData(self::ALINE_PASCOALINO),
            self::getPersonMergedData(self::ANDRE_DALA_POSSA),
            self::getPersonMergedData(self::BEATRICE_BONAMI_ROSA),
            self::getPersonMergedData(self::BRUNO_MADUREIRA_FERREIRA),
            self::getPersonMergedData(self::CLAUDIA_LEONOR_GUEDES),
            self::getPersonMergedData(self::ELI_BORGES_JR),
            self::getPersonMergedData(self::ELIANE_SCHLEMMER),
            self::getPersonMergedData(self::ELIETE_PEREIRA),
            self::getPersonMergedData(self::ERICK_ROZA),
            self::getPersonMergedData(self::EVANDRO_MEDEIROS_LAIA),
            self::getPersonMergedData(self::GENIVALDO_PAULINO_MONTEIRO),
            self::getPersonMergedData(self::IAN_DAWSEY),
            self::getPersonMergedData(self::ISABELLA_MOURA),
            self::getPersonMergedData(self::JANAINA_MENEZES),
            self::getPersonMergedData(self::JULLIANA_CUTOLO_TORRES),
            self::getPersonMergedData(self::LARA_LINHALIS_GUIMARAES),
            self::getPersonMergedData(self::LEANDRO_KEY_HIGUCHI_YANAZA),
            self::getPersonMergedData(self::MARCELLA_SCHNEIDER_FARIA_SANTOS),
            self::getPersonMergedData(self::MARINA_MAGALHAES),
            self::getPersonMergedData(self::MATHEUS_SOARES_CRUZ),
            self::getPersonMergedData(self::MICHELLE_DIAS),
            self::getPersonMergedData(self::RITA_MACHADO_NARDY),
            self::getPersonMergedData(self::SILVIA_SURRENTI),
            self::getPersonMergedData(self::TATIANA_REVOREDO),
            self::getPersonMergedData(self::TERESA_NEVES),
            self::getPersonMergedData(self::THIAGO_CARDOSO_FRANCO),
        ];
    }

    public static function getDesigners(): array {
        return [
            [
                'name' => self::BRUNO_MADUREIRA_FERREIRA['name'],
                'picture_url' => url(self::BRUNO_MADUREIRA_FERREIRA['picture_url']),
                'linkedin_url' => self::BRUNO_MADUREIRA_FERREIRA['linkedin_url'],
            ],
        ];
    }

    public static function getDevelopers(): array {
        return [
            [
                'name' => 'Sandro Gallina',
                'picture_url' => url('/images/team/sandro_foto.jpg'),
                'linkedin_url' => 'https://www.linkedin.com/in/sandro-gallina/',
                'website' => 'https://sandrogallina.com/',
            ],
        ];
    }

    public static function getPersonMergedData(array $person): array {
        return array_merge(
            [
                'id' => self::getSlugFrom($person['name']),
                'picture_url' => url($person['picture_url']),
            ],
            $person
        );
    }

    public static function getSlugFrom(string $name): string {
        return Str::slug($name, '-');
    }
}
