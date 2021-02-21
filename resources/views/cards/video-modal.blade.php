@if($videoTitle && $idVideo)
    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        <div class="col-md-4">
            <div class="card card-body modal-home-video" data-video-title="{{$videoTitle}}" data-video-url="https://www.youtube.com/embed/{{ $idVideo }}">
                <img class="img-fluid" src="https://img.youtube.com/vi/{{$idVideo}}/hqdefault.jpg" alt="Video thumbnail">
                <h5 class="card-title mt-3">{{ $videoTitle }}</h5>
            </div>
        </div>
    </div>
@endif

