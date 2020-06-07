@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card push-top">
        <div class="card-header">
            Editar Verbete
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
            <form method="post" action="{{ route('subjects.update', $subject->id) }}" autocomplete="off">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" value="{{ $subject->name }}" name="name" required autocomplete="false"/>
                    </div>
                    <div class="col-md-4">
                        <label for="tags">Tags Relacionadas</label>
                        <select class="form-control selectpicker" id="tags" name="tags[]" multiple required>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" {{ $subject->isTagAssociated($tag->id) ? 'selected' : ''}}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check mt-4">
                            <input class="form-check-input" name="is_active" type="checkbox" id="is_active" {{ $subject->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Ativo</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Salvar</button>
                <a href="{{route('tags.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
