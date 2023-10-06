@extends('layouts.v2.app')

@section('content')
    <div id="series-page" class="container content-home pt-5 pb-5 p-0">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 header">
                        <label>Verbete</label>
                        <h1>{{ $subject->name }}</h1>

                        <div class="tags-list">
                            @foreach($subject->tags as $tag)
                                <a href="{{ route('v2.searchByTag', $tag->id) }}" class="label">
                                    <span>{{$tag->name}}</span>
                                </a>
                            @endforeach
                        </div>

                        <p class="description">{{ $subjectData['description'] }}</p>
                    </div>

                    @if ($subjectData['videoId'])
                        <div class="col-12" id="video-presentation">
                            <h2 class="mb-0">Apresentação do Verbete</h2>
                            <div class="row m-3 align-content-center" style="justify-content: center;">
                                <iframe width="80%" height="600" src="https://www.youtube.com/embed/{{ $subjectData['videoId'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif


                    <div class="col-12" id="researchers-list">
                        <div class="col-12">
                            <h3>{{ count($subjectData['researchers']) > 1 ? 'Responsáveis' : 'Responsável'}}</h3>
                        </div>

                        <div class="row">
                            @foreach($subjectData['researchers'] as $person)
                                @php($researcher = \App\User::getPersonMergedData($person))
                                <div class="col-xs-12 col-sm-7 col-md-5">
                                    <div class="col-12 media mt-2 mb-3">
                                        <div class="row">
                                            <div class="col-4 col-lg-3">
                                                @php($researcher = \App\User::getPersonMergedData($person))
                                                <a  href="{{ route('v2.authorPage', $researcher['slug']) }}"
                                                    class="mr-2 team-person-link team-person-picture-link rounded-circle"
                                                    style="height: 7em;width: 7em;display: block;"
                                                >
                                                    <img src="{{ $researcher['picture_url'] }}"
                                                         alt="{{ $researcher['name'] }}"
                                                         class="team-person-picture rounded-circle mr-2"
                                                         style="height: 6.3em;width: 6.3em;"
                                                         title="{{ $researcher['name'] }}"
                                                    >
                                                </a>
                                            </div>

                                            <div class="col-8 person-data">
                                                <h4>{{ $researcher['title'] ?? $researcher['name'] }}</h4>
                                                <p>{{ $researcher['university'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if(isset($subjectData['researchers']))
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="mt-3">
                                @if (count($resources))
                                    <div class="row" id="conteudos-relacionados">
                                        <div class="col-12">
                                            <h2 class="m-0 mb-3">Conteúdos relacionados</h2>

                                            {{ view('v2.resources.contents-list', compact('resources')) }}
                                        </div>
                                    </div>
                                @else
                                    <p>
                                        Sem conteúdos relacionados.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                </div>
            </div>
        </div>
    </div>
@endsection
