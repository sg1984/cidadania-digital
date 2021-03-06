@if($videoTitle && $idVideo)
    <div class="col-sm-6 col-md-4">
        <div class="card card-body modal-home-video p-0 mt-3" data-video-title="{{$videoTitle}}" data-video-url="https://www.youtube.com/embed/{{ $idVideo }}">
            <img class="img-fluid" src="https://img.youtube.com/vi/{{$idVideo}}/hqdefault.jpg" alt="Video thumbnail">
            <h5 class="card-title p-3">{{ $videoTitle }}</h5>
        </div>
    </div>
@endif

