<h2 class="home-title">{{ $sessionTitle }}</h2>

<div id="{{$carouselId}}" class="row carousel slide w-100">
    <div class="carousel-inner w-100" role="listbox">
        @foreach($videosData as $key => $videoData)
            {{ view('cards.video-modal', array_merge($videoData, ['key' => $key])) }}
        @endforeach
    </div>
    <a class="carousel-control-prev w-auto" href="#{{$carouselId}}" role="button" data-slide="prev">
        <div class="carousel-control-prev-icon arrow left">
            <svg width="60px" height="80px" viewBox="0 0 50 80" xml:space="preserve">
                <polyline points="45.63,75.8 0.375,38.087 45.63,0.375"/>
            </svg>
        </div>
    </a>
    <a class="carousel-control-next w-auto" href="#{{$carouselId}}" role="button" data-slide="next">
        <div class="carousel-control-next-icon arrow right">
            <svg width="60px" height="80px" viewBox="0 0 50 80" xml:space="preserve">
                <polyline points="0.375,0.375 45.63,38.087 0.375,75.8"/>
            </svg>
        </div>
    </a>
</div>
