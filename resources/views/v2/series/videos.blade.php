<h2 class="home-title mt-3 mb-5">Episódios</h2>

@foreach($videosData as $pos => $videoData)
    @if ($pos !== 0)
        <hr class="mt-5" />
    @endif
    <div id="{{ $videoData['id'] }}" class="row series p-0 mt-3" onclick="handleClick('video-id-{{ $videoData['id'] }}')" data-video-title="{{ $videoData['title'] }}" data-video-url="https://www.youtube.com/embed/{{ $videoData['id'] }}">
        <div class="col-4 no-padding">
            <img class="img-fluid" src="https://img.youtube.com/vi/{{ $videoData['id'] }}/hqdefault.jpg" alt="Video thumbnail">
        </div>

        <div class="col-8">
            <h5 class="card-title pt-3">{{ $videoData['title'] }}</h5>
            @if ($videoData['description'] ?? false)
                <p>{!! $videoData['description']  !!} </p>
            @endif
        </div>
    </div>

    @isset($videoData['authors'])
        @foreach($videoData['authors'] as $author)
            <div class="media mt-2 mb-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-lg-1">
                            @php($researcher = \App\User::getPersonMergedData($author))
                            <a class="mr-2 team-person-link team-person-picture-link rounded-circle" data-toggle="modal" data-target="#{{ $researcher['id'] }}" data-dismiss="modal" style="height: 7em;width: 7em;display: block;">
                                <img src="{{ $researcher['picture_url'] }}"
                                     alt="{{ $researcher['name'] }}"
                                     class="team-person-picture rounded-circle mr-2"
                                     style="height: 6.3em;width: 6.3em;"
                                     title="{{ $researcher['name'] }}"
                                >
                            </a>
                        </div>

                        <div class="col-sm-7 col-lg-9 person-data">
                            <h4>{{ $researcher['title'] }}</h4>
                            <p>{{ $researcher['description'] }}</p>
                        </div>

                        <div class="col-sm-12 col-md-3 col-lg-2 person-data">
                            <a class="author-link-btn" href="{{ route('v2.authorPage', \App\User::getSlugFrom($researcher['name'])) }}">
                                Página do autor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset

    <div id="video-id-{{ $videoData['id'] }}" class="col-12 hidden display-video">
        <iframe
            src="https://www.youtube.com/embed/{{ $videoData['id'] }}"
            width="100%"
            height="600"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>

@endforeach
