@extends('layouts.app')

@section('content')
    <div class="push-top">
        <div class="card-header">
            <h5>
                Documentos
            </h5>
            <h6>
                <a href="{{ route('resources.create')}}">Incluir Documento</a>
            </h6>
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
        <table class="table">
            <thead>
            <tr class="table-warning">
                <td>Nome</td>
                <td>Tema</td>
                <td>Palavras chave</td>
                <td>Criada em</td>
                @if(Auth::check())
                    <td class="text-center">Ações</td>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($resources as $resource)
                <tr>
                    <td>
                        <a href="{{ route('resources.show', $resource->id)}}">
                            {{$resource->title}}
                        </a>
                    </td>
                    <td>{{$resource->subject->name}}</td>
                    <td>{{$resource->key_words}}</td>
                    <td>{{$resource->created_at->format('Y-m-d H:i')}}</td>
                    <td class="text-center">
                        <a href="{{ route('resources.edit', $resource->id)}}" class="btn btn-primary btn-sm">Alterar</a>
                        <form class="form-delete" action="{{ route('resources.destroy', $resource->id)}}" method="post" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger btn-sm" type="submit" value="Apagar"/>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection
