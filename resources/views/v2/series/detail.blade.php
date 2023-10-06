@extends('layouts.v2.app')

@section('content')
    <div id="series-page" class="container content-home pt-5 pb-5 p-0">
        <div class="row">
            <div class="{{ isset($seriesData['sponsors']) ? 'col-sm-7' : 'col-12'}}">
                <div class="row">
                    <div class="{{ isset($seriesData['researchers']) && !isset($seriesData['sponsors']) ? 'col-7' : 'col-12' }} header">
                        @isset($seriesData['logo-title'])
                            <img src="{{ url($seriesData['logo-title']) }}" alt="{{ $seriesData['title'] }}" width="80%">
                        @else
                            <label>Webseries</label>
                            <h1>{{ $seriesData['title'] }}</h1>
                        @endisset

                        <p class="description">{!! $seriesData['description']  !!} </p>

                        @isset($tags)
                            <div class="tags-list">
                                @foreach($tags as $tag)
                                    <a href="{{ route('v2.searchByTag', $tag->id) }}" class="label">
                                        <span>{{$tag->name}}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endisset
                    </div>

                    @isset($seriesData['researchers'])
                        <div class="col-12">
                            <div id="researchers-list">
                                <h3>{{ count($seriesData['researchers']) > 1 ? 'Responsáveis' : 'Responsável'}}</h3>
                                @foreach($seriesData['researchers'] as $person)
                                    <div class="">
                                        <div class="col-12 media mt-2 mb-3">
                                            <div class="row">
                                                <div class="{{ !isset($seriesData['sponsors']) ? 'col-2' : 'col-3' }}">
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

                                                <div class="{{ !isset($seriesData['sponsors']) ? 'col-10' : 'col-9' }} person-data">
                                                    <h4>{{ $researcher['title'] ?? $researcher['name'] }}</h4>
                                                    <p>{{ $researcher['university'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                </div>
            </div>

            @isset($seriesData['sponsors'])
                <div class="col-12 col-sm-5 sponsors">
                    <h3>Realização:</h3>
                    <div class="sponsors-containers">
                        @foreach($seriesData['sponsors'] as $sponsorLogo)
                            <div class="sponsor-container">
                                <hr>
                                <div class="sponsor-logo">
                                    <img src="{{ url($sponsorLogo) }}" alt="{{ $sponsorLogo }}">
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endisset
        </div>

        <div class="row">
            <div class="col-12">
                <div class="mt-4" id="video-list">
                    {{ view('v2.series.videos', ['videosData' => $seriesData['videos']]) }}
                </div>

                @if(isset($seriesData['researchers']) && isset($seriesData['subjects']))
                    <div class="row mt-5">
                        <div class="col-12">
                            <h2 class="m-0">Linhas de pesquisa</h2>
                            <div class="mt-3">
                                @if ($seriesData['subjects'] ?? false)
                                    <div id="verbetes" class="mb-4 mt-1">
                                        <h4>Confira os verbetes envolvidos</h4>
                                        <div class="row flex {{ count($seriesData['subjects']) > 3 ? 'slider slider-verbete' : ''}}">
                                            @foreach($seriesData['subjects'] as $subject)
                                                @if(!isset($subject['inactive']) && array_key_exists($subject,\App\Subject::SUBJECT_NAMES_IMAGES))
                                                    <div class="col-md-3 mb-3 card-container">
                                                        <div class="card card-body p-0">
                                                            <hr>
                                                            <a href="{{ route('v2.showSpecialPage', $subject) }}">
                                                                <img class="img-fluid" src="{{ \App\Subject::SUBJECT_NAMES_IMAGES[$subject]['image'] }}" alt="{{ \App\Subject::SUBJECT_NAMES_IMAGES[$subject]['name'] }}">
                                                                <p>{{ \App\Subject::SUBJECT_NAMES_IMAGES[$subject]['name'] }}</p>
                                                            </a>
                                                            <hr class="hr-bottom">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

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
@endsection
