@extends('layouts.v2.app')

@section('content')
    <div id="search-page" class="container content-home pt-5 pb-5 p-0">
        @isset($userData)
            <div id="team" class="content-team container content-home pt-5 pb-5 p-0">
                <div class="container pt-5 pb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h1 class="mb-4">Conheça a Equipe</h1>

                            <div class="col-12 mb-5">
                                <div id="coordinator-container" class="row mt-2">
                                    <div class="col-xs-12 col-sm-6">
                                        <img src="{{ $userData['picture_url'] }}"
                                             alt="{{ $userData['name'] }}"
                                             class="mr-2"
                                        />
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="media-body">
                                            <h5>{{ $userData['title'] ?? 'Pesquisador' }} </h5>
                                            <h3 class="mt-4">{{ $userData['name'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-5">
                                <h2>Sobre o pesquisador</h2>
                                <p class="mt-0 description">{{ $userData['minibio'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="mb-3"> Conteúdos deste autor </h2>
        @else
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
        @endisset

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
