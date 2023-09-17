@extends('layouts.v2.home')

@section('content')
    <div class="content-home">
        @if (session('status'))
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <div class="container">

            <hr>

            <div id="home-realizacao">
                <h2 class="home-title">Realização</h2>
                <div class="logo-realizacao">
                    <img src="{{ url('/images/logos/realizacao-logo.png') }}" alt="Logo Realização">
                </div>
            </div>

            <hr>

            <div id="masterclass">
                <hr>
                <h2 class="home-title">Masterclasses</h2>

                <div class="row flex slider slider-masterclass">
                    @foreach($masterclasses as $masterclass)
                        <div class="col-12 mb-3 card-container">
                            <div class="card card-body p-0 masterclass-image">
                                <a class="access-link" href="{{ $masterclass['url'] }}">
                                    <img src="{{ url($masterclass['thumbnail']) }}" alt="{{ $masterclass['title'] }}" height="683px" width="100%">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="webseries">
                <h2 class="home-title home-title-sections">Webséries</h2>

                <div class="row flex slider slider-verbete">
                    @foreach($series as $serie)
                        <div class="col-md-3 mb-3 card-container">
                            <div class="card card-body p-0">
                                <hr>
                                <a class="access-link" href="{{ $serie['url'] }}">
                                    <img src="{{ $serie['thumbnail'] }}" alt="{{ $serie['id'] }}" width="100%" height="180px">
                                    <p>{{ $serie['title'] }}</p>
                                </a>
                                <hr class="hr-bottom">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="verbetes">
                <h2 class="home-title home-title-sections">Verbetes</h2>

                <div class="tags-list">
                    @foreach((array_slice($tagsToShow, 0, 10) ?? []) as $tag)
                        <a href="{{ route('v2.searchByTag', $tag['id']) }}" class="label">
                            {{ $tag['name'] }}
                        </a>
                    @endforeach
                </div>

                <div class="row flex slider slider-verbete">
                    @foreach($subjects as $key => $subject)
                        @if(!isset($subject['inactive']))
                            <div class="col-md-3 mb-3 card-container">
                                <div class="card card-body p-0">
                                    <hr>
                                    <a href="{{ route('v2.showSpecialPage', $key) }}">
                                        <img class="img-fluid" src="{{ $subject['image'] }}" alt="Video thumbnail">
                                        <p>{{ $subject['name'] }}</p>
                                    </a>
                                    <hr class="hr-bottom">
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <hr>

            <div id="home-parceiros">
                <h2 class="home-title">Parceiros</h2>
                <div class="row">
                    @foreach($partners as $key => $partner)
                        <div class="col-sm-3 img-container">
                            <img src="{{ $partner }}" alt="Logo Parceiro">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{ view('video-target') }}
    </div>
@endsection
