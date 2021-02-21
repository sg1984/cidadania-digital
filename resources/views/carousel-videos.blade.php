<h2 class="home-title">{{ $sessionTitle }}</h2>

<div id="{{$carouselId}}" class="row carousel slide w-100" data-ride="carousel">
    <div class="carousel-inner w-100" role="listbox">
        @foreach($videosData as $key => $videoData)
            {{ view('cards.video-modal', array_merge($videoData, ['key' => $key])) }}
        @endforeach
    </div>
    <a class="carousel-control-prev w-auto" href="#{{$carouselId}}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next w-auto" href="#{{$carouselId}}" role="button" data-slide="next">
        <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="col-12 mt-3 pb-2">
    <div class="float-right">
        <a href="{{ $buttonUrl }}" class="btn btn-primary">
            Acessar
        </a>
    </div>
</div>
