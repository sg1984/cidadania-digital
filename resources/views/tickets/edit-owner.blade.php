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
                <h2>Alterar</h2>
                <hr>
                <form method="post" action="{{ route('tickets.update', $ticket->id) }}" autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="card-subtitle mb-2 text-secondary">
                                Tipo: <b>{{ $ticket->getTicketTypeDescription() }}</b>
                            </h6>
                        </div>
                        <div class="col-md-4">
                            <label for="tags">Status</label>
                            <select class="form-control selectpicker" id="status" name="status" required>
                                @foreach(\App\Ticket::STATUSES_TEXTS as $statusId => $statusName)
                                    <option value="{{$statusId}}" {{ $statusId === $ticket->status ? 'selected' : ''}}>{{ $statusName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">
                            Título
                        </label>
                        <input type="text" class="form-control" name="title" required value="{{ $ticket->id ? $ticket->title : old('title') }}" autocomplete="false"/>
                    </div>

                    <div class="form-group">
                        <label for="description">
                            Descrição
                        </label>
                        <textarea class="form-control" name="description" rows="5" required>{{ $ticket->id ? $ticket->description : old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary float-right">Atualizar ticket</button>
                        </div>
                    </div>
                </form>
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
