@extends('layouts.v2.app')

@section('content')
    <div id="search-page" class="container content-home pt-5 pb-5 p-0">
        <form action="{{ route('v2.showAll') }}" autocomplete="false">
            <div class="row mb-4">
                <div class="col-10">
                    <div class="input-group mb-3">
                        <span class="input-group-text arrow-icon">
                            <a href="{{ route('v2.index') }}">
                                <i class="fa fa-3x fa-arrow-left"></i>
                            </a>
                        </span>

                        <input class="form-control form-control-lg" type="search" name="search" placeholder="Pesquisar" value="{{ old('search') }}">

                        <span class="input-group-text search-button">
                            <button class="btn btn-outline-info" type="submit">
                                <i class="fa fa-2x fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <h2 class="mb-3"> Conteúdos encontrados na busca por: <b>{{ $searchBy }}</b></h2>

        @if (count($resources))
            <div class="row" id="conteudos-relacionados">
                <div class="col-12">
                    {{ view('v2.resources.contents-list', compact('resources')) }}
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                {{ $resources->render() }}
            </div>
        @else
            <p>
                Sem conteúdos relacionados.
            </p>
        @endif
    </div>
@endsection
