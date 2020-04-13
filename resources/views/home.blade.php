@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="push-top">
                        <div class="card-header">
                            <h5>
                                Documentos
                            </h5>
                        </div>

                        @foreach($resources as $resource)
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $resource->title }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Tema:</b> {{ $resource->subject->name }}</h5>
                                        <h5 class="card-title"><b>Descrição:</b> {{ $resource->description }}</h5>
                                        <p class="card-text"><b>Palavras-chave:</b> {{ $resource->key_words }} </p>
                                        <p class="card-text"><b>Formato:</b> {{ $resource->format }} </p>
                                        <p class="card-text"><b>Link:</b> {{ $resource->source }} </p>
                                        <p class="card-text"><b>Criada em:</b> {{ $resource->created_at->format('Y-m-d H:i') }} </p>
                                        <p class="card-text"><b>Criado por:</b> {{ $resource->user->name }} </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
