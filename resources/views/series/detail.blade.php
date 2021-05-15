@extends('layouts.app')

@section('content')
    <div class="bg-image content-bg-image" style="
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0px, rgba(255, 255, 255, 1) 400px), url({{ empty($seriesData['background-image']) ? '/images/team/background.jpg' : $seriesData['background-image'] }});"
    >
        <p class="float-right" style="text-align: right; margin-right: 5px; margin-top: 300px; font-size: 0.5rem;">{{ empty($seriesData['background-credit']) ? 'DIVULGAÇÃO' : strtoupper( $seriesData['background-credit'] ) }}</p>
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-10" style="margin-top: 30%">
                    <div class="row">
                        <div class="col-7">
                            <h1>{{ $seriesData['title'] }}</h1>
                            <p>{{ $seriesData['description'] }}</p>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Responsável</h4>
                                </div>
                                <div class="row">
                                    @foreach($seriesData['researchers'] as $person)
                                        @php($researcher = \App\User::getPersonMergedData($person))
                                        <div class="col-6 media mb-1">
                                            <a class="mr-2 team-person-link team-person-picture-link rounded-circle" data-toggle="modal" data-target="#{{ $researcher['id'] }}" data-dismiss="modal" style="height: 7em;width: 7em;">
                                                <img src="{{ $researcher['picture_url'] }}" alt="{{ $researcher['name'] }}" class="team-person-picture rounded-circle mr-2" style="height: 6em;width: 6em;">
                                            </a>
                                            <div class="media-body">
                                                <a data-toggle="modal" data-target="#{{ $researcher['id'] }}" data-dismiss="modal">
                                                    <h5 class="mt-4">{{ $researcher['name'] }}</h5>
                                                </a>
                                            </div>
                                        </div>
                                        {{ view('pages.team-modal', ['person' => $researcher]) }}
                                    @endforeach
                                </div>
                            </div>
                            <h4>Tags</h4>
                            <div class="row">
                                <div class="col-12">
                                    @foreach($tags as $tag)
                                        <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-cidig">
                                            <span>{{$tag->name}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ view('series.videos', ['videosData' => $seriesData['videos']]) }}
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <h2>Conteúdos relacionados</h2>
                            <hr/>
                            <div class="mt-3">
                                @if (count($resources))
                                    {{ view('resources.contents-list', compact('resources')) }}
                                @else
                                    <p>
                                      Sem conteúdos relacionados.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ view('video-target') }}
    </div>
@endsection
