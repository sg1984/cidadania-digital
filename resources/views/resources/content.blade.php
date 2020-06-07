<div class="card mb-4">
    <div class="card-header">
        <a href="{{ route('searchBySubject', $resource->subject->id) }}">
            <i class="{{ $resource->getFormatIcon() }}"></i> {{ $resource->subject->name }}
        </a>
    </div>
    <div class="card-body">
        <a target="_blank" href="{{ $resource->source }}" class="text-muted">
            <div class="text-truncate1">
                <h5 class="card-title">{{ $resource->title }}</h5>
            </div>
        </a>
        <div class="text-truncate1">
            <small class="text-right">
                {{ $resource->author }}
            </small>
        </div>
        @foreach($resource->tags as $tag)
            <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-light">
                <span>{{$tag->name}}</span>
            </a>
        @endforeach
    </div>
    <div class="card-footer text-muted text-right pb-3">
        <button type="button" class="float-left btn btn-outline-info btn-sm" data-toggle="modal" data-target="#resource-{{$resource->id}}">
            Descrição
        </button>
        <small>
            Postado por <b>{{ $resource->user->name }} </b> em <b>{{ $resource->created_at->format('Y-m-d') }}</b>
        </small>
    </div>
</div>

<div class="modal fade" id="resource-{{$resource->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="resourceLabel-{{$resource->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a id="resourceLabel-{{$resource->id}}" href="{{ route('searchBySubject', $resource->subject->id) }}">
                    <i class="{{ $resource->getFormatIcon() }}"></i> {{ $resource->subject->name }}
                </a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="modal-title">{{ $resource->title }}</h3>
                <p>
                    {{ $resource->description }}
                </p>
                <p class="text-truncate1">
                    <small>
                        {{ $resource->author }}
                    </small>
                </p>
                @foreach($resource->tags as $tag)
                    <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-light">
                        <span>{{$tag->name}}</span>
                    </a>
                @endforeach
                <div class="float-right">
                    <small class="text-right">
                        Postado por <b>{{ $resource->user->name }} </b> em <b>{{ $resource->created_at->format('Y-m-d') }}</b>
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm text-muted" data-dismiss="modal">Fechar</button>
                <a target="_blank" href="{{ $resource->source }}" class="btn btn-outline-info btn-sm">
                    Ir para conteúdo
                </a>
            </div>
        </div>
    </div>
</div>
