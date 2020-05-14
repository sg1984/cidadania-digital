<div class="card-body pt-0 pl-0 pr-0">
    <div class="card">
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
            <div class="row collapse" id="description-{{$resource->id}}">
                <div class="col-12 pb-2">
                    <p>
                        {{ $resource->description }}
                    </p>
                    <a target="_blank" href="{{ $resource->source }}" class="btn btn-outline-info btn-sm text-muted">
                        Ir para conteúdo
                    </a>
                </div>
            </div>
            @foreach($resource->tags as $tag)
                <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-light">
                    <span>{{$tag->name}}</span>
                </a>
            @endforeach
        </div>
        <div class="card-footer text-muted">
            <div class="float-right">
                <small class="text-right">
                    Postado por <b>{{ $resource->user->name }} </b> em <b>{{ $resource->created_at->format('Y-m-d') }}</b>
                </small>
            </div>
            <div class="float-left">
                <a class="btn btn-outline-info btn-sm" data-toggle="collapse" href="#description-{{$resource->id}}" role="button" aria-expanded="false" aria-controls="description-{{$resource->id}}">
                    Descrição
                </a>
            </div>
        </div>
    </div>
</div>
