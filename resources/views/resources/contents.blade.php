@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('showAll') }}" autocomplete="false">
            <div class="row mb-4">
                <div class="col-md-8">
                    <input class="form-control form-control-lg" type="search" name="search" placeholder="Buscar por..." value="{{ old('search') }}">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-info btn-lg" type="submit">Buscar</button>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-outline-secondary btn-lg" href="{{ route('showAll') }}">Limpar busca</a>
                </div>
            </div>
        </form>

        <h2> Conteúdos encontrados na busca por: <b>{{ $searchBy }}</b></h2>
        {{ view('resources.contents-list', compact('resources')) }}
        <div class="row d-flex justify-content-center">
            {{ $resources->render() }}
        </div>
    </div>
@endsection
