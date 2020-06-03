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
                    <dd class="col-sm-9">{{ $resource->source }}</dd>

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

                <a href="{{ url()->previous() }}" class="btn btn-outline-info float-right mr-3">Voltar</a>
            </div>
        </div>
    </div>
@endsection
