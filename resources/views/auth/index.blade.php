@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="push-top">
            {{ view('tickets.open-ticket-cards', compact('tickets')) }}
            <div class="card-header">
                <h5>
                    Pesquisadores
                </h5>
                <h6>
                    <a href="{{ route('register')}}">Incluir Pesquisador</a>
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
            <input class="form-control" id="search-users-table" type="text" placeholder="Busca...">
            <br>

            <table class="table">
                <thead>
                <tr class="table-warning">
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Cadastrado em</td>
                    @if(Auth::check())
                        <td class="text-center">Ações</td>
                    @endif
                </tr>
                </thead>
                <tbody id="users-table-body">
                @foreach($users as $user)
                    <tr>
                        <td data-search='1'>
                            <a href="{{route('showByUser', $user->id)}}">
                                {{$user->name }}
                            </a>
                        </td>
                        <td data-search='1'>{{$user->email}}</td>
                        <td>{{$user->created_at->format('Y-m-d')}}</td>
                        <td class="text-center">
                            <a href="{{ route('editUser', $user->id)}}" class="btn btn-primary btn-sm">Alterar</a>
                            <form action="{{ route('users.toggleStatus', $user->id)}}" method="post" style="display: inline-block">
                                @csrf
                                @method('PATCH')
                                @if($user->is_active)
                                    <input class="btn btn-warning btn-sm" type="submit" value="Desativar"/>
                                @else
                                    <input class="btn btn-info btn-sm" type="submit" value="Ativar"/>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
@endsection
