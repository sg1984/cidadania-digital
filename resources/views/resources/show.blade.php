@extends('layouts.app')

@section('content')
    <div class="push-top">
        <div class="card-header">
            <h5>
                <a href="{{ route('resources.index')}}">
                    Documentos
                </a>
            </h5>
        </div>
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif

        @if(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div><br />
        @endif
    </div>
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
@endsection
