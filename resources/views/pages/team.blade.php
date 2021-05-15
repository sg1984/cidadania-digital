@extends('layouts.app')

@section('content')
    <div class="bg-image content-bg-image content-team">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-10" style="margin-top: 30%">
                    <h1>Equipe</h1>
                    <hr/>
                    @if ($coordinators)
                        <h5><strong> {{ $coordinators['title'] }} </strong></h5>
                        <div class="row">
                            @foreach($coordinators['people'] as $coordinator)
                                <div class="col-md-12 media mb-5">
                                    <a class="mr-2 team-person-link team-person-picture-link rounded-circle" data-toggle="modal" data-target="#{{ $coordinator['id'] }}" data-dismiss="modal">
                                        <img src="{{ $coordinator['picture_url'] }}" alt="{{ $coordinator['name'] }}" class="team-person-picture rounded-circle mr-2">
                                    </a>
                                    <div class="media-body">
                                        <a class="team-person-link" class="team-person-link" data-toggle="modal" data-target="#{{ $coordinator['id'] }}" data-dismiss="modal">
                                            <h5 class="mt-4">{{ $coordinator['name'] }}</h5>
                                            <h6 class="mt-0 font-italic">{{ $coordinator['university'] }}</h6>
                                        </a>
                                    </div>
                                </div>
                                {{ view('pages.team-modal', ['person' => $coordinator]) }}
                            @endforeach
                        </div>
                    @endif

                    @if ($researchers)
                        <h5><strong> {{ $researchers['title'] }} </strong></h5>
                        <div class="row">
                            @foreach($researchers['people'] as $researcher)
                                <div class="col-md-6 media mb-5">
                                    <a class="mr-2 team-person-link team-person-picture-link rounded-circle" data-toggle="modal" data-target="#{{ $researcher['id'] }}" data-dismiss="modal">
                                        <img src="{{ $researcher['picture_url'] }}" alt="{{ $researcher['name'] }}" class="team-person-picture rounded-circle mr-2">
                                    </a>
                                    <div class="media-body">
                                        <a class="team-person-link" data-toggle="modal" data-target="#{{ $researcher['id'] }}" data-dismiss="modal">
                                            <h5 class="mt-4">{{ $researcher['name'] }}</h5>
                                            <h6 class="mt-0 font-italic">{{ $researcher['university'] }}</h6>
                                        </a>
                                    </div>
                                </div>
                                {{ view('pages.team-modal', ['person' => $researcher]) }}
                            @endforeach
                        </div>
                    @endif

                    @if ($designers)
                        <h5><strong> {{ $designers['title'] }} </strong></h5>
                        <div class="row">
                            @foreach($designers['people'] as $designer)
                                <div class="col-md-12 media mb-5">
                                    <a class="mr-2 team-person-picture-link rounded-circle">
                                        <img src="{{ $designer['picture_url'] }}" alt="{{ $designer['name'] }}" class="team-person-picture rounded-circle mr-2">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="mt-4">{{ $designer['name'] }}</h5>
                                        @if( $designer['linkedin_url'] )
                                            <a class="team-person-link"  href="{{ $designer['linkedin_url'] }}" target="_blank" style="text-decoration: none">
                                                <img src="{{ url('/images/logos/linkedin.png') }}" alt="LinkedIn logo" style="height: 2rem;">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($developers)
                        <h5><strong> {{ $developers['title'] }} </strong></h5>
                        <div class="row">
                            @foreach($developers['people'] as $developer)
                                <div class="col-md-12 media mb-5">
                                    <a class="mr-2 team-person-picture-link rounded-circle">
                                        <img src="{{ $developer['picture_url'] }}" alt="{{ $developer['name'] }}" class="team-person-picture rounded-circle mr-2">
                                    </a>
                                    <div class="media-body">
                                        <a class="team-person-link" href={{ $developer['website'] }} target="_blank" style="text-decoration: none">
                                            <h5 class="mt-4">{{ $developer['name'] }}</h5>
                                        </a>
                                        @if( $developer['linkedin_url'] )
                                            <a class="team-person-link"  href="{{ $developer['linkedin_url'] }}" target="_blank" style="text-decoration: none">
                                                <img src="{{ url('/images/logos/linkedin.png') }}" alt="LinkedIn logo" style="height: 2rem;">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
