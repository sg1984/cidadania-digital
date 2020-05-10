<div class="card-body pl-0 pr-0">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('searchBySubject', $resource->subject->id) }}">
                <i class="{{ $resource->getFormatIcon() }}"></i> {{ $resource->subject->name }}
            </a>
        </div>
        <div class="card-body">
            <a target="_blank" href="{{ $resource->source }}" class="text-muted">
                <h5 class="card-title">{{ $resource->title }}</h5>
                <h6 class="card-title">{{ $resource->description }}</h6>
                <div class="card-text text-right">
                    <small>
                        Postado por <b>{{ $resource->user->name }} </b> em <b>{{ $resource->created_at->format('Y-m-d') }}</b>
                    </small>
                </div>
            </a>
        </div>
        <div class="card-footer text-muted">
            @foreach($resource->tags as $tag)
                <a href="{{ route('searchByTag', $tag->id) }}" class="btn btn-outline-info btn-sm">
                    {{$tag->name}}
                </a>
            @endforeach
        </div>
    </div>
</div>
