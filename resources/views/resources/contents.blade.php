@extends('layouts.app')

@section('content')
    <div class="container">
        <h2> Conteúdos encontrados na busca por: <b>{{ $searchBy }}</b></h2>
        <div class="row">
            {{ view('resources.contents-list', compact('resources')) }}
        </div>
        <div class="row d-flex justify-content-center">
            {{ $resources->render() }}
        </div>
    </div>
@endsection
