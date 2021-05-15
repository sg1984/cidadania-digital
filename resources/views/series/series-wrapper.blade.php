<h2 class="home-title">Webséries</h2>

<div class="row">
    @foreach($series as $serie)
        <div class="col-sm-6 col-md-4">
            <div class="card card-body p-0 mt-3">
                <a class="access-link" href="{{ $serie['url'] }}">
                    <img src="{{ $serie['thumbnail'] }}" alt="{{ $serie['id'] }}" width="100%">
                </a>
                <div class="align-content-bottom">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#{{ $serie['id'] }}" aria-expanded="false" aria-controls="{{ $serie['id'] }}">
                        <i class="fas fa-chevron-up"></i>
                        <div class="triangle"></div>
                        <span class="small">menu</span>
                    </button>
                    <div class="accordion-content collapse" id="{{ $serie['id'] }}">
                        <p class="small truncate-overflow">
                            {{ $serie['description'] }}
                        </p>
                        <a class="access-link" href="{{ $serie['url'] }}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
