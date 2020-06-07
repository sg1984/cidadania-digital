@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="push-top">
            <div class="card-header">
                <h5>
                    Tags
                </h5>
                <h6>
                    <a href="{{ route('tags.create')}}">Incluir Tag</a>
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
                    <td>Status</td>
                    <td>Criada em</td>
                    <td class="text-center">Ações</td>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>
                            <a href="{{ route('tags.show', $tag->id) }}" class="text-reset">
                                <b>{{$tag->name}}</b>
                            </a>
                        </td>
                        <td>
                            @if($tag->is_active)
                                <span class="badge badge-success">
                                    Ativa
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    Desativada
                                </span>
                            @endif
                        </td>
                        <td>{{$tag->created_at->format('Y-m-d')}}</td>
                        <td class="text-center">
                            <a href="{{ route('tags.edit', $tag->id)}}" class="btn btn-primary btn-sm">Alterar</a>
                            <form action="{{ route('tags.toggleStatus', $tag->id)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('PATCH')
                                @if($tag->is_active)
                                    <input class="btn btn-warning btn-sm" type="submit" value="Desativar"/>
                                @else
                                    <input class="btn btn-info btn-sm" type="submit" value="Ativar"/>
                                @endif
                            </form>
                            @if($tag->canBeExcluded())
                                <form class="form-delete" action="{{ route('tags.destroy', $tag->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger btn-sm" type="submit" value="Apagar"/>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <div class="row d-flex justify-content-center">
                    {{ $tags->render() }}
                </div>
            </div>
@endsection
