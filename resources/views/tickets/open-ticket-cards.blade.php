@if($tickets && count($tickets))
    <div class="row">
        <div class="col-md-12">
            <h3>Existem tickets sob sua responsabilidade aguardando resolução</h3>
        </div>
        @foreach($tickets as $ticket)
            <div class="col-md-3">
                <div class="card text-white {{ $ticket->getTicketStatusCssClass() }} mb-3">
                    <div class="card-header">
                        {{ $ticket->getTicketTypeDescription() }}
                        <div class="float-right">
                            <h6>
                                {{ $ticket->getStatusText() }}
                            </h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('tickets.editResponsible', $ticket->id) }}" class="text-reset">
                                <b>{{ $ticket->title }}</b>
                            </a>
                        </h5>
                        <div class="text-right">
                            Criado em {{ $ticket->created_at->format('Y-m-d') }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
