<h2 class="home-title">Episódios</h2>
<hr />

@foreach($videosData as $videoData)
    <div class="row series modal-home-video p-0 mt-3" data-video-title="{{ $videoData['title'] }}" data-video-url="https://www.youtube.com/embed/{{ $videoData['id'] }}">
        <div class="col-4 no-padding">
            <img class="img-fluid" src="https://img.youtube.com/vi/{{ $videoData['id'] }}/hqdefault.jpg" alt="Video thumbnail">
        </div>
        <div class="col-8">
            <h5 class="card-title pt-3">{{ $videoData['title'] }}</h5>
            @if ($videoData['text'] ?? false)
                <p>{{ $videoData['text'] }}</p>
            @endif
        </div>
    </div>
    <hr />
@endforeach
