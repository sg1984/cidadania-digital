@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="push-top">
            <div class="card-header">
                <h5>
                    Conteúdos
                </h5>
                <h6>
                    <a href="{{ route('resources.create')}}">Incluir Conteúdo</a>
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
                    <td>Tipo</td>
                    <td>
                        <div>Nome</div>
                        <div><small>Tema</small></div>
                    </td>
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
                            <a href="{{ route('searchByFormat', $resource->format_id) }}" class="text-reset">
                                {{ $resource->getFormatDescription() }}
                            </a>
                        </td>
                        <td>
                            <div>
                                <a href="{{ route('resources.show', $resource->id) }}" class="text-reset">
                                    <b>{{$resource->title}}</b>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('searchBySubject', $resource->subject->id) }}">
                                    <small>{{$resource->subject->name}}</small>
                                </a>
                            </div>
                        </td>
                        <td>{{$resource->created_at->format('Y-m-d')}}</td>
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
        <div class="row d-flex justify-content-center">
            {{ $resources->render() }}
        </div>
    </div>
@endsection
