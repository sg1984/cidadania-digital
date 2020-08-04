<div class="card mt-5">
    <div class="card-header">Comentários</div>

    <div class="card-body">
        <div class="card-body">
            @if(count($ticket->comments))
                @foreach($ticket->comments as $comment)
                    <h6 class="card-subtitle mb-2 text-secondary">
                        Em {{ $comment->created_at->format('Y-m-d H:i') }}, por {{ $comment->createdBy->name }}:
                    </h6>
                    <p>
                        {{ $comment->description }}
                    </p>
                    <hr>
                @endforeach
            @else
                Nenhum comentário encontrado.
            @endif
        </div>

        <form method="post" action="{{ route('tickets.addComment', $ticket->id) }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="description">Adicionar comentário</label>
                <input type="text" class="form-control" name="description" required autocomplete="false"/>
            </div>
            <button type="submit" class="btn btn-primary float-right">Enviar comentário</button>
        </form>
    </div>
</div>
