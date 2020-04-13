@extends('layouts.app')

@section('content')

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
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="name">Título</label>
                    <input type="text" class="form-control" name="title" value="{{ $resource->title }}"/>
                </div>
                <div class="form-group">
                    <label for="system">Palavras-chave</label>
                    <input type="text" class="form-control" name="key_words" value="{{ $resource->key_words }}"/>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea class="form-control" name="description" rows="5">{{ $resource->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="system">Formato</label>
                    <input type="text" class="form-control" name="format" value="{{ $resource->format }}"/>
                </div>
                <div class="form-group">
                    <label for="system">Link</label>
                    <input type="text" class="form-control" name="source" value="{{ $resource->source }}"/>
                </div>
                <div class="form-group">
                    <label for="regional_id">Tema</label>
                    <select class="form-control" id="subject_id" name="subject_id">
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}" {{ $resource->subject_id == $subject->id ? 'selected' : ''}} >{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-right">Atualizar Documento</button>
                <a href="{{route('resources.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
