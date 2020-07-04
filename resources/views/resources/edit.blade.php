@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ $resource->id ? 'Editar' : 'Incluir' }} Documento
        </h1>
        <p><small>* Campos com preenchimento obrigatório.</small></p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif

        <form method="post" action="{{ $resource->id ? route('resources.update', $resource->id) : route('resources.store') }}" autocomplete="false">
            @csrf
            @if ($resource->id)
                @method('PATCH')
            @endif

            <div class="card mb-3">
                <div class="card-header">
                    Conteúdo
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="subject_id">
                                Assunto *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="O tópico do recurso. Normalmente, o assunto será expresso como palavras-chave ou frases que descrevem o assunto ou o conteúdo do recurso. É encorajado o uso de vocabulários controlados e esquemas formais de classificação."></i>
                            </label>
                            <select class="form-control selectpicker" id="subject_id" name="subject_id" required>
                                @foreach($userSubjects as $userSubject)
                                    <option value="{{$userSubject->id}}" {{ $resource->subject_id === $userSubject->id ? 'selected' : ''}}>{{ $userSubject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tags">
                                Relações
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Um identificador de um segundo recurso e sua relação com o recurso atual. Este elemento é usado para expressar ligações entre recursos relacionados. Por uma questão de interoperabilidade, os relacionamentos devem ser selecionados a partir de uma lista enumerada atualmente em desenvolvimento na série de workshops."></i>
                            </label>
                            <select class="form-control selectpicker" id="tags" name="tags[]" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{ $resource->isTagSelected($tag->id) ? 'selected' : ''}}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="format_id">
                                Tipo *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="A categoria do recurso, como página inicial, romance, poema, documento de trabalho, relatório técnico, redação, dicionário. Para fins de interoperabilidade, o Tipo deve ser selecionado em uma lista enumerada que está atualmente em desenvolvimento na série de workshops."></i>
                            </label>
                            <select class="form-control selectpicker" id="format_id" name="format_id" required>
                                @foreach($formats as $key => $name)
                                    <option value="{{$key}}" {{ $resource->format_id === $key ? 'selected' : ''}}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">
                            Título *
                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="O nome dado ao recurso, geralmente pelo Criador ou Publicador. O nome dado ao material/arquivo/conteúdo, normalmente pelo criador ou editor. (título do texto/vídeo/audio/imagem)."></i>
                        </label>
                        <input type="text" class="form-control" name="title" required value="{{ $resource->title }}" autocomplete="false"/>
                    </div>
                    <div class="form-group">
                        <label for="description">
                            Descrição *
                            <i class="fas fa-info-circle text-muted" data-toggle="tooltip" data-placement="top" title="Uma descrição textual do conteúdo do material, sendo um resumo ou abstract no caso de documentos de texto e uma descrição no caso de materiais visuais."></i>
                        </label>
                        <textarea class="form-control" name="description" rows="5" required>{{ $resource->description }}</textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="source">
                                Fonte *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Informações sobre um segundo recurso do qual o presente recurso é derivado. Embora seja geralmente recomendado que os elementos contenham informações apenas sobre o recurso atual, esse elemento pode conter metadados para o segundo recurso quando for considerado importante para a descoberta do recurso atual."></i>
                            </label>
                            <input type="url" class="form-control" name="source" required value="{{ $resource->source }}" autocomplete="false"/>
                        </div>

                        <div class="col-md-4">
                            <label for="coverage">
                                Cobertura
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="As características espaciais ou temporais do conteúdo intelectual do recurso. A cobertura espacial refere-se a uma região física (por exemplo, setor celeste) usando nomes de lugares ou coordenadas (por exemplo, longitude e latitude). A cobertura temporal refere-se ao conteúdo do recurso e não ao momento em que foi criado ou disponibilizado (o último pertencente ao elemento Data). A cobertura temporal é normalmente especificada usando períodos de tempo nomeados (por exemplo, neolítico) ou o mesmo formato de data / hora, conforme recomendado para o elemento Data."></i>
                            </label>
                            <input type="text" class="form-control" name="coverage" value="{{ $resource->coverage }}" autocomplete="false"/>
                        </div>

                        <div class="col-md-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" name="publish_now" type="checkbox" id="publish_now" {{ empty($resource->published_at) ? '' : 'checked' }}>
                                <label class="form-check-label" for="publish_now">
                                    Publicar Conteúdo
                                    <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Quando marcado, o conteúdo é publicado imediatamente. Caso contrário, ficará com status de rascunho."></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    Propriedade Intelectual
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="author">
                                Autor *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="A pessoa ou organização responsável principalmente pela criação do conteúdo intelectual do recurso. Por exemplo, autores no caso de documentos escritos, artistas, fotógrafos ou ilustradores no caso de recursos visuais."></i>
                            </label>
                            <input type="text" class="form-control" name="author" required value="{{ $resource->author }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="publisher">
                                Editora ou Canal de Publicação *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="A entidade responsável por disponibilizar o recurso em sua forma atual, como uma editora, um departamento universitário ou uma entidade corporativa."></i>
                            </label>
                            <input type="text" class="form-control" name="publisher" required value="{{ $resource->publisher }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="contributor">
                                Co-Autor ou Contribuidor
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Uma pessoa ou organização não especificada em um elemento Criador que fez contribuições intelectuais significativas para o recurso, mas cuja contribuição é secundária a qualquer pessoa ou organização especificada em um elemento Criador (por exemplo, editor, transcritor e ilustrador)."></i>
                            </label>
                            <input type="text" class="form-control" name="contributor" value="{{ $resource->contributor }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="copy_rights">
                                Direitos
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Uma declaração de gerenciamento de direitos, um identificador vinculado a uma declaração de gerenciamento de direitos ou um identificador vinculado a um serviço que fornece informações sobre o gerenciamento de direitos do recurso. (A plataforma em si e os recursos por ela produzidos são regidos pelo Creative Commons, no entanto, cada recurso adicionado vai ter as especificidades do seu canal de origem.)"></i>
                            </label>
                            <input type="text" class="form-control" name="copy_rights" value="{{ $resource->copy_rights }}" autocomplete="false"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    Instanciação
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="original_date">
                                Data
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Uma data associada à criação ou disponibilidade do recurso. A melhor prática recomendada é definida em um perfil da ISO 8601 que inclui (entre outras) datas dos formulários AAAA e AAAA-MM-DD. Nesse esquema, por exemplo, a data 1994-11-05 corresponde a 5 de novembro de 1994."></i>
                            </label>
                            <input type="date" class="form-control" name="original_date" value="{{ $resource->original_date }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="format">
                                Formato
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="O formato dos dados e, opcionalmente, as dimensões (por exemplo, tamanho, duração) do recurso. O formato é usado para identificar o software e possivelmente o hardware que podem ser necessários para exibir ou operar o recurso."></i>
                            </label>
                            <input type="text" class="form-control" name="format" value="{{ $resource->format }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="identifier">
                                Identificador
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Uma sequência ou número usado para identificar exclusivamente o recurso. Exemplos de recursos em rede incluem URLs e URNs (quando implementados). Outros identificadores exclusivos globalmente, como ISBN (International Standard Book Numbers) ou outros nomes formais, também são candidatos a esse elemento."></i>
                            </label>
                            <input type="text" class="form-control" name="identifier" value="{{ $resource->identifier }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="language">
                                Idioma *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="A linguagem do conteúdo intelectual do recurso. A melhor prática recomendada é definida na RFC 1766 [4]."></i>
                            </label>
                            <input type="text" class="form-control" name="language" required value="{{ $resource->language }}" autocomplete="false"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                    <a href="{{route('resources.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
@endsection
