@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card push-top">
            <div class="card-header">
                <h5>
                    <a href="{{ route('resources.index')}}">
                        Documentos
                    </a>
                </h5>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Tema</dt>
                    <dd class="col-sm-9">{{ $resource->subject->name }}</dd>

                    <dt class="col-sm-3">Tags Relacionadas</dt>
                    <dd class="col-sm-9">
                        @foreach($resource->tags as $tag)
                            <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-light">
                                <span>{{$tag->name}}</span>
                            </a>
                        @endforeach
                    </dd>

                    <dt class="col-sm-3">Formato</dt>
                    <dd class="col-sm-9">{{ $resource->getFormatDescription() }}</dd>

                    <dt class="col-sm-3">Título</dt>
                    <dd class="col-sm-9">{{ $resource->title }}</dd>

                    <dt class="col-sm-3">Descrição</dt>
                    <dd class="col-sm-9">{{ $resource->description }}</dd>

                    <dt class="col-sm-3">Link</dt>
                    <dd class="col-sm-9">
                        <a href="{{ $resource->getSourceLink() }}" target="_blank">
                            {{ $resource->getUploadedFileOriginalName() }}
                        </a>
                    </dd>

                    <dt class="col-sm-3">Palavras-chave</dt>
                    <dd class="col-sm-9">{{ $resource->key_words }}</dd>

                    <dt class="col-sm-3">Criada em</dt>
                    <dd class="col-sm-9">{{ $resource->created_at->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Publicada em</dt>
                    <dd class="col-sm-9">{{ $resource->published_at ? $resource->published_at->format('Y-m-d') : '-' }}</dd>

                    <dt class="col-sm-3">Autor</dt>
                    <dd class="col-sm-9">{{ $resource->author }}</dd>

                    <dt class="col-sm-3">Canal de Publicação</dt>
                    <dd class="col-sm-9">{{ $resource->publisher }}</dd>

                    <dt class="col-sm-3">Idioma</dt>
                    <dd class="col-sm-9">{{ $resource->language }}</dd>
                </dl>
                @auth
                    <div class="float-left">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#resourceReportForm-{{ $resource->id }}" data-dismiss="modal">{{ __('Sugerir alteração') }}</button>
                    </div>
                @endauth

                <a href="{{ url()->previous() }}" class="btn btn-outline-info float-right mr-3">Voltar</a>
            </div>
        </div>
    </div>
    @auth
        <!-- Modal Report Resource Error -->
        <div class="modal fade" id="resourceReportForm-{{ $resource->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Sugestão de ajuste em Documento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('resourceReport') }}" autocomplete="false">
                        @csrf
                        <input type="hidden" class="form-control" name="responsible_id" value="{{ $resource->user->id }}"/>
                        <input type="hidden" class="form-control" name="resource_id" value="{{ $resource->id }}"/>
                        <div class="modal-body">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" name="title" required autocomplete="false"/>
                            <label for="description">Por favor, descreva a sugestão:</label>
                            <textarea class="form-control" name="description" rows="5" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth
@endsection
