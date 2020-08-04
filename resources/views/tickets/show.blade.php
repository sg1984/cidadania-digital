@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card push-top mb-2">
            <div class="card-header">
                <h5>
                    <a href="{{ route('tickets.index')}}">
                        Tickets
                    </a>
                </h5>
            </div>
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

        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-secondary">
                    Tipo: <b>{{ $ticket->getTicketTypeDescription() }}</b>
                    <div class="float-right">
                        Status: <b>{{ $ticket->getStatusText() }}</b>
                    </div>
                </h6>
                <h4 class="card-title">
                    {{ $ticket->title }}
                </h4>
                <p class="card-text">
                    {{ $ticket->description }}
                </p>
                @if ($ticket->resource)
                    <hr>
                    <h6 class="card-subtitle text-muted">
                        Ticket criado como sugestão para o documento:
                        <a href="{{ route('resources.show', $ticket->resource->id) }}" target="_blank">
                            {{ $ticket->resource->title }}
                        </a>
                    </h6>
                @endif
            </div>

            <div class="card-footer text-muted">
                Responsável: <b>{{ $ticket->responsible->name }}</b>
                <div class="float-right">
                    Criado por <b>{{ $ticket->createdBy->name }}</b> em <b>{{ $ticket->created_at->format('Y-m-d H:i') }}</b>
                </div>
            </div>
        </div>
        {{ view('tickets.comments', compact('ticket')) }}
        <a href="{{ url()->previous() }}" class="btn btn-outline-info float-right mt-3">Voltar</a>
    </div>
@endsection
