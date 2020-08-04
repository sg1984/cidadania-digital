@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="push-top">
            <div class="card">
                <div class="card-header">
                    <h5>
                        Tickets
                    </h5>
                </div>
                <div class="card-body">
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

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ $tab === \App\Ticket::TAB_TICKETS_ALL ? 'active' : '' }}" href="{{ route('tickets.index') }}">
                                Todos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab === \App\Ticket::TAB_TICKETS_SENT ? 'active' : '' }}" href="{{ route('tickets.myCreatedTickets') }}">
                                Criados por mim
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $tab === \App\Ticket::TAB_TICKETS_RECEIVED ? 'active' : '' }}" href="{{ route('tickets.myReceivedTickets') }}">
                                Sob minha responsabilidade
                            </a>
                        </li>
                    </ul>

                    <div class="card-body">
                        @if($tickets->count())
                            <table class="table">
                                <thead>
                                <tr class="table-warning">
                                    <td>Tipo</td>
                                    <td>Título</td>
                                    <td>Criado em</td>
                                    <td>Criado por</td>
                                    <td>Status</td>
                                    <td>Responsável</td>
                                    <td class="text-center">Ações</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->getTicketTypeDescription() }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-reset">
                                                <b>{{ $ticket->title }}</b>
                                            </a>
                                        </td>
                                        <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $ticket->createdBy->name }}</td>
                                        <td>{{ $ticket->getStatusText() }}</td>
                                        <td>{{ $ticket->responsible->name }}</td>

                                        <td class="text-center">
                                            @if($ticket->canEdit(auth()->user()))
                                                <a href="{{ route('tickets.editOwner', $ticket->id)}}" class="btn btn-outline-primary btn-sm">Alterar</a>
                                            @endif
                                            @if($ticket->canWork(auth()->user()))
                                                <a href="{{ route('tickets.editResponsible', $ticket->id)}}" class="btn btn-outline-secondary btn-sm">Resolver</a>
                                            @endif
                                            <a href="{{ route('tickets.show', $ticket->id)}}" class="btn btn-outline-dark btn-sm">Visualizar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                <div class="row d-flex justify-content-center">
                                    {{ $tickets->render() }}
                                </div>
                            </div>
                        @else
                            <div class="alert alert-secondary" role="alert">
                                Nenhum ticket encontrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
