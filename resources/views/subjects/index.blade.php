@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="push-top">
            <div class="card-header">
                <h5>
                    Verbetes
                </h5>
                <h6>
                    <a href="{{ route('subjects.create')}}">Incluir Verbete</a>
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
                @foreach($subjects as $subject)
                    <tr>
                        <td>
                            <a href="{{ route('subjects.show', $subject->id) }}" class="text-reset">
                                <b>{{$subject->name}}</b>
                            </a>
                        </td>
                        <td>
                            @if($subject->is_active)
                                <span class="badge badge-success">
                                    Ativa
                                </span>
                            @else
                                <span class="badge badge-secondary">
                                    Desativada
                                </span>
                            @endif
                        </td>
                        <td>{{$subject->created_at->format('Y-m-d')}}</td>
                        <td class="text-center">
                            <a href="{{ route('subjects.edit', $subject->id)}}" class="btn btn-primary btn-sm">Alterar</a>
                            <form action="{{ route('subjects.toggleStatus', $subject->id)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('PATCH')
                                @if($subject->is_active)
                                    <input class="btn btn-warning btn-sm" type="submit" value="Desativar"/>
                                @else
                                    <input class="btn btn-info btn-sm" type="submit" value="Ativar"/>
                                @endif
                            </form>
                            @if($subject->canBeExcluded())
                                <form class="form-delete" action="{{ route('subjects.destroy', $subject->id)}}" method="post" style="display: inline-block">
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
                    {{ $subjects->render() }}
                </div>
            </div>
@endsection
