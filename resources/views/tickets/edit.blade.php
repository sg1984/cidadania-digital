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
            @if ($ticket->canWork)
                {{ view('tickets.edit-owner', compact('ticket')) }}
            @elseif(auth()->id() === $ticket->responsible_id)
                {{ view('tickets.edit-responsible', compact('ticket')) }}
            @endif
            {{ view('tickets.comments', compact('ticket')) }}
        </div>
    </div>
@endsection
