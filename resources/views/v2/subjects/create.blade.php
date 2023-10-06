@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card push-top">
            <div class="card-header">
                Incluir Verbete
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
                <form method="post" action="{{ route('subjects.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" required autocomplete="false"/>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check mt-4">
                                <input class="form-check-input" name="is_active" type="checkbox" id="is_active">
                                <label class="form-check-label" for="is_active">Ativo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="tags">Tags Relacionadas</label>
                            <select
                                class="form-control"
                                id="tags"
                                name="tags[]"
                                multiple="multiple"
                                required
                            >
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                    <a href="{{route('subjects.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
