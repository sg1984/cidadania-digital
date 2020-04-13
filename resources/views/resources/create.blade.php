@extends('layouts.app')

@section('content')
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
            <form method="post" action="{{ route('resources.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Título</label>
                    <input type="text" class="form-control" name="title"/>
                </div>
                <div class="form-group">
                    <label for="system">Palavras-chave</label>
                    <input type="text" class="form-control" name="key_words"/>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea class="form-control" name="description" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="system">Formato</label>
                    <input type="text" class="form-control" name="format"/>
                </div>
                <div class="form-group">
                    <label for="system">Link</label>
                    <input type="text" class="form-control" name="source"/>
                </div>
                <div class="form-group">
                    <label for="regional_id">Tema</label>
                    <select class="form-control" id="subject_id" name="subject_id">
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary float-right">Salvar</button>
                <a href="{{route('resources.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
