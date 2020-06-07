@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card push-top">
        <div class="card-header">
            Editar Tag
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
            <form method="post" action="{{ route('tags.update', $tag->id) }}" autocomplete="off">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ $tag->name }}" required autocomplete="false"/>
                </div>
                <div class="form-check mt-4">
                    <input class="form-check-input" name="is_active" type="checkbox" id="is_active" {{ $tag->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Ativo</label>
                </div>
                <button type="submit" class="btn btn-primary float-right">Salvar</button>
                <a href="{{route('tags.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
