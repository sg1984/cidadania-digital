<div>
    <p>
        Olá, <b>{{ $ticket->responsible->name }}</b>, recebemos um ticket relacionado ao seu documento: <br>
        <a href="{{ route('resources.show', $ticket->resource->id) }}" target="_blank">
            {{ $ticket->resource->title }}
        </a>
    </p>

    <p><b>Tipo de ticket:</b> {{ $ticket->getTicketTypeDescription() }} </p>
    <p><b>Usuário: </b> {{ $user->name }}</p>
    <p><b>Email: </b> {{ $user->email }}</p>
    <p><b>Data: </b> {{ now()->format('Y-m-d H:i') }}</p>
    <p>
        <b>Título: </b>
        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-reset">
            <b>{{ $ticket->title }}</b>
        </a>
    </p>
    <p><b>Mensagem: </b></p>
    <p>{{ $ticket->description }}</p>
</div>
