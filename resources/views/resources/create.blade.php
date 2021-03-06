@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card push-top">
            <div class="card-header">
                Incluir Documento
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
                <form method="post" action="{{ route('resources.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="subject_id">Tema</label>
                            <select class="form-control selectpicker" id="subject_id" name="subject_id" required>
                                @foreach($userSubjects as $userSubject)
                                    <option value="{{$userSubject->id}}">{{ $userSubject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="tags">Tags Relacionadas</label>
                            <select class="form-control selectpicker" id="tags" name="tags[]" multiple required>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="format_id">Formato</label>
                            <select class="form-control selectpicker" id="format_id" name="format_id" required>
                                @foreach($formats as $key => $name)
                                    <option value="{{$key}}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Título</label>
                        <input type="text" class="form-control" name="title" required autocomplete="false"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea class="form-control" name="description" rows="5" required></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="source">Link</label>
                            <input type="text" class="form-control" name="source" required autocomplete="false"/>
                        </div>
                        <div class="col-md-5">
                            <label for="key_words">Palavras-chave <small>(Separadas por vírgulas)</small></label>
                            <input type="text" class="form-control" name="key_words" required autocomplete="false"/>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check mt-4">
                                <input class="form-check-input" name="publish_now" type="checkbox" id="publish_now">
                                <label class="form-check-label" for="publish_now">Publicar Conteúdo</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="author">Autor</label>
                            <input type="text" class="form-control" name="author" required autocomplete="false"/>
                        </div>
                        <div class="col-md-4">
                            <label for="publisher">Canal de Publicação</label>
                            <input type="text" class="form-control" name="publisher" required autocomplete="false"/>
                        </div>
                        <div class="col-md-4">
                            <label for="language">Idioma</label>
                            <input type="text" class="form-control" name="language" required autocomplete="false"/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                    <a href="{{route('resources.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
