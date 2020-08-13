@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card push-top">
            <div class="card-header">
                Incluir Tag
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
                <form method="post" action="{{ route('tags.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tag (Para incluir mais de uma, separe as tags com ";")</label>
                        <input type="text" class="form-control" name="name" required autocomplete="false"/>
                    </div>
                    <div class="form-check mt-4">
                        <input class="form-check-input" name="is_active" type="checkbox" id="is_active">
                        <label class="form-check-label" for="is_active">Ativo</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Salvar</button>
                    <a href="{{route('tags.index')}}" class="btn btn-outline-info float-right mr-3">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
