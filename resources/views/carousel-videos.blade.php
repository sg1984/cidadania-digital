<h2 class="home-title">{{ $sessionTitle }}</h2>

<div id="{{$carouselId}}" class="row w-100">
    @foreach($videosData as $key => $videoData)
        {{ view('cards.video-modal', array_merge($videoData, ['key' => $key])) }}
    @endforeach
</div>
