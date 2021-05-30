@extends('layouts.app')

@section('content')
    <div class="bg-image content-bg-image" style="
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0px, rgba(255, 255, 255, 1) 400px), url({{ empty($subjectData['background-image']) ? '/images/team/background.jpg' : $subjectData['background-image'] }});
        background-size: cover;"
    >
        <p class="float-right" style="text-align: right; margin-right: 5px; margin-top: 300px; font-size: 0.5rem;">{{ empty($subjectData['background-credit']) ? 'DIVULGAÇÃO' : strtoupper( $subjectData['background-credit'] ) }}</p>
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-10" style="margin-top: 30%">
                    <div class="row">
                        <div class="col-7">
                            <h1>{{ $subject->name }}</h1>
                            <p>{{ $subjectData['description'] }}</p>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-12">
                                    <h4>Responsável</h4>
                                </div>
                                <div class="row">
                                    @foreach($subjectData['researchers'] as $person)
                                        @php($researcher = \App\User::getPersonMergedData($person))
                                        <div class="col-md-6 media mb-1">
                                            <a class="mr-2 team-person-link team-person-picture-link rounded-circle" data-toggle="modal" data-target="#{{ $researcher['id'] }}" data-dismiss="modal">
                                                <img src="{{ $researcher['picture_url'] }}"
                                                     alt="{{ $researcher['name'] }}"
                                                     class="team-person-picture rounded-circle mr-2"
                                                     title="{{ $researcher['name'] }}"
                                                >
                                            </a>
                                        </div>
                                        {{ view('pages.team-modal', ['person' => $researcher]) }}
                                    @endforeach
                                </div>
                            </div>
                            <h4>Tags</h4>
                            <div class="row">
                                <div class="col-12">
                                    @foreach($subject->tags as $tag)
                                        <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-cidig">
                                            <span>{{$tag->name}}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($subjectData['videoId'])
                        <div class="row">
                            <div class="col-12">
                                <h2>Apresentação do Verbete</h2>
                                <hr>
                                <div class="row m-3 align-content-center">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $subjectData['videoId'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-3">
                        <div class="col-12">
                            <h2>Conteúdos relacionados</h2>
                            <hr/>
                            <div class="mt-3">
                                @php($series = \App\Subject::getSeriesIdsFromSubjectId($subjectData['slug']))
                                @if (!empty($series) ?? false)
                                    <div class="mb-4">
                                        <h4>Séries especiais</h4>
                                        <div class="row">
                                            @foreach($series as $serie)
                                                @if (array_key_exists($serie,\App\Subject::SERIES_PAGES))
                                                    <div class="col-md-3 mb-3">
                                                        <div class="card card-body p-0">
                                                            <a href="{{ route('showSpecialPage', $serie) }}">
                                                                <img class="img-fluid" src="{{ \App\Subject::SERIES_PAGES[$serie]['thumbnail'] }}" alt="{{ \App\Subject::SERIES_PAGES[$serie]['title'] }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (count($resources))
                                    {{ view('resources.contents-list', compact('resources')) }}
                                    <div class="text-right">
                                        <a href="{{ route('searchBySubject', $subject->id) }}">
                                            Ver mais conteúdos...
                                        </a>
                                    </div>
                                @else
                                    <p> Sem mais conteúdos relacionados.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
