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
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Tema abordado no documento, já pré-estabelecido pelos verbetes disponíveis."></i>
                            </label>
                            <select class="form-control selectpicker" id="subject_id" name="subject_id" required>
                                @foreach($userSubjects as $userSubject)
                                    <option value="{{$userSubject->id}}" {{ $resource->subject_id === $userSubject->id ? 'selected' : ''}}>{{ $userSubject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tags">
                                Relações (Tags Relacionadas)
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Tags relacionadas ou que tangenciam o assunto abordado neste documento."></i>
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
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Tipo do documento (texto, vídeo, áudio e imagem)."></i>
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
                            <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Título do Documento (fornecido pela fonte primária). "></i>
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
                                Fonte (Link) *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Link de acesso à fonte primária do documento."></i>
                            </label>
                            <input type="url" class="form-control" name="source" required value="{{ $resource->source }}" autocomplete="false"/>
                        </div>

                        <div class="col-md-4">
                            <label for="coverage">
                                Cobertura (Tempo/Espacial)
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="As características espaço-temporais do conteúdo intelectual do documento. A cobertura espacial refere-se a uma região física (país, região, cidade, localidade) e a cobertura temporal refere-se ao conteúdo do documento e não ao momento em que este foi criado, referindo-se a um período histórico, data ou intervalo de tempo. (Separar as informações por vírgulas)."></i>
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
                            <input disabled type="text" class="form-control" name="copy_rights" value="{{ $resource->copy_rights }}" autocomplete="false"/>
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
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Data de publicação ou criação original do documento."></i>
                            </label>
                            <input type="date" class="form-control" name="original_date" value="{{ $resource->original_date }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="format">
                                Formato
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="O formato dos dados e, opcionalmente, as dimensões (por exemplo, tamanho, duração) do recurso. O formato é usado para identificar o software e possivelmente o hardware que podem ser necessários para exibir ou operar o recurso."></i>
                            </label>
                            <input disabled type="text" class="form-control" name="format" value="{{ $resource->format }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="identifier">
                                Identificador
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Uma sequência ou número usado para identificar exclusivamente o documento, quando houver (pode ser um DOI, no caso de artigos, ISBN para livros, ou outros)."></i>
                            </label>
                            <input type="text" class="form-control" name="identifier" value="{{ $resource->identifier }}" autocomplete="false"/>
                        </div>
                        <div class="col-md-3">
                            <label for="language">
                                Língua *
                                <i class="fas fa-info-circle text-secondary" data-toggle="tooltip" data-placement="top" title="Idioma no qual o documento se encontra."></i>
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
