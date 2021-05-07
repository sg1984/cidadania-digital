<h2 class="home-title">Séries especiais</h2>

<div class="row w-100">
    @foreach($series as $serie)
        <div class="col-sm-6 col-md-4">
            <div class="card card-body p-0 mt-3"
                 style="background-image: url({{ $serie['thumbnail'] }}); background-size: cover; height: 421px; "
            >
                <div class="align-content-bottom">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#{{ $serie['title'] }}" aria-expanded="false" aria-controls="{{ $serie['title'] }}">
                        <i class="fas fa-chevron-up"></i>
                        <div class="triangle"></div>
                        <span class="small">menu</span>
                    </button>
                    <div class="accordion-content collapse" id="{{ $serie['title'] }}">
                        <p class="small">
                            {{ $serie['description'] }}
                        </p>
                        <div class="row mt-2">
                            <div class="col-12">
                                @foreach($serie['tags'] as $tag)
                                    <a href="{{ route('searchByTag', $tag['id']) }}" class="badge badge-tag">
                                        <span> {{ $tag['name'] }} </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <a class="access-link" href="{{ $serie['url'] }}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
