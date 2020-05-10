@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card push-top">
            <div class="card-header">
                Editar Documento
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('resources.update', $resource->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="subject_id">Tema</label>
                            <select class="form-control selectpicker" id="subject_id" name="subject_id" required>
                                @foreach($userSubjects as $userSubject)
                                    <option value="{{$userSubject->id}}" {{ $resource->subject_id === $userSubject->id ? 'selected' : ''}}>{{ $userSubject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tags">Tags Relacionadas</label>
                            <select class="form-control selectpicker" id="tags" name="tags[]" multiple required>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{ $resource->isTagSelected($tag->id) ? 'selected' : ''}}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="format_id">Formato</label>
                            <select class="form-control selectpicker" id="format_id" name="format_id" required>
                                @foreach($formats as $key => $name)
                                    <option value="{{$key}}" {{ $resource->format_id === $key ? 'selected' : ''}}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Título</label>
                        <input type="text" class="form-control" name="title" required value="{{ $resource->title }}"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea class="form-control" name="description" rows="5" required>{{ $resource->description }}</textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="source">Link</label>
                            <input type="text" class="form-control" name="source" required value="{{ $resource->source }}"/>
                        </div>
                        <div class="col-md-6">
                            <label for="key_words">Palavras-chave <small>(Separadas por vírgulas)</small></label>
                            <input type="text" class="form-control" name="key_words" required value="{{ $resource->key_words }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="author">Autor</label>
                            <input type="text" class="form-control" name="author" required value="{{ $resource->author }}"/>
                        </div>
                        <div class="col-md-4">
                            <label for="publisher">Canal de Publicação</label>
                            <input type="text" class="form-control" name="publisher" required value="{{ $resource->publisher }}"/>
                        </div>
                        <div class="col-md-4">
                            <label for="language">Idioma</label>
                            <input type="text" class="form-control" name="language" required value="{{ $resource->language }}"/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                    <a href="{{route('resources.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
