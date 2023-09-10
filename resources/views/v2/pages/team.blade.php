@extends('layouts.v2.app')

@section('content')
    <div id="team" class="content-team container content-home pt-5 pb-5 p-0">
        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="mb-4">Conheça a Equipe</h1>

                    <div class="col-12 mb-5">
                        @isset($coordinators)
                            <div id="coordinator-container" class="row mt-2">
                                @foreach($coordinators['people'] as $coordinator)
                                    <div class="col-xs-12 col-sm-6">
                                        <img src="{{ url('/images/team/massimo-team.png') }}" alt="{{ $coordinator['name'] }}" class="mr-2">
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="media-body">
                                            <h5>{{ $coordinators['title'] }} </h5>
                                            <a href="{{ route('v2.authorPage', $coordinator['slug']) }}">
                                                <h3 class="mt-4">{{ $coordinator['name'] }}</h3>
                                                <p class="mt-0 description">{{ $coordinator['minibio'] }}</p>
                                            </a>
                                        </div>
                                        <p>
                                            <a href="{{ route('v2.authorPage', $coordinator['slug']) }}">
                                                Ver mais...
                                            </a>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                    </div>

                    <div class="row">
                        @isset($researchers)
                            <div class="col-12">
                                <h2>{{ $researchers['title'] }}</h2>
                            </div>

                            <div class="col-12 researchers-list">
                                @foreach($researchers['people'] as $researcher)
                                    <div class="person-container col-xs-12 col-sm-6 col-md-3 media mb-5">
                                        <div class="person-content">
                                            <hr>
                                            <div class="">
                                                <a  href="{{ route('v2.authorPage', $researcher['slug']) }}"
                                                    class="mr-2 rounded-circle"
                                                    style="height: 7em;width: 7em;display: block;"
                                                >
                                                    <img src="{{ $researcher['picture_url'] }}" alt="{{ $researcher['name'] }}"
                                                         class="team-person-picture rounded-circle mr-2" />
                                                </a>
                                            </div>

                                            <div class="text-center text">
                                                <h5 class="mt-4">{{ $researcher['name'] }}</h5>
                                                <h6 class="mt-0">
                                                    {{ $researcher['minibio'] ?? '-' }}
                                                </h6>
                                            </div>

                                            <a target="{{ isset($researcher['website']) ? '_blank' : '' }}"
                                               href="{{ isset($researcher['website']) ? $researcher['website'] : route('v2.authorPage', $researcher['slug']) }}"
                                            >
                                                <p>Ver mais</p>
                                            </a>

                                            <div class="mb-2">
                                                @if(isset($researcher['lattes_url']) || isset($researcher['orcid_url']) || isset($researcher['linkedin_url']))
                                                    @isset($researcher['lattes_url'])
                                                        <a href="{{ $researcher['lattes_url'] }}" target="_blank" style="text-decoration: none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 17 17" fill="none">
                                                                <path d="M4.19597 15.1208C2.47687 11.5983 1.45412 9.471 1.45412 9.41821C1.45412 9.33206 1.55915 9.34401 2.59202 9.54657C4.40859 9.90324 5.37914 10.0039 6.997 10.0045C9.13751 10.005 10.8805 9.66603 12.2348 8.98482C12.9513 8.6244 13.3821 8.3049 13.735 7.8721C14.1697 7.33869 14.3093 6.97133 14.3143 6.353C14.3187 5.7649 14.2395 5.45479 13.8992 4.73518C13.7645 4.45081 13.6463 4.12441 13.635 4.00989C13.6173 3.82558 13.6324 3.79917 13.7683 3.78344C14.0652 3.74827 15.5308 5.17106 16.0705 6.01833C17.0008 7.47952 17.0763 9.0602 16.2888 10.5888C15.805 11.5279 15.2705 12.1776 14.3754 12.9161C12.8877 14.1427 11.1586 14.9969 8.77082 15.685C7.4883 16.0549 5.41442 16.5034 4.9873 16.5034C4.89677 16.5034 4.72686 16.2065 4.19723 15.1202L4.19597 15.1208V15.1208ZM4.6747 9.44017C3.00464 9.22381 1.60326 9.03568 1.55985 9.02188C1.48565 8.99799 1.22021 8.11236 1.07047 7.39148C1.03274 7.20906 0.977356 6.72596 0.947194 6.31716C0.812524 4.493 1.20945 3.23177 2.27312 2.09769C4.07395 0.179212 7.92978 -0.0541787 12.2801 1.49197C13.0436 1.76372 13.3469 1.95241 13.2066 2.07001C13.1029 2.15682 12.3996 2.15556 11.1843 2.06623C9.28472 1.92658 7.83863 2.19077 7.09327 2.81474C5.95848 3.76455 6.13151 5.84663 7.59522 8.85011C7.75375 9.17532 7.91353 9.4936 7.95 9.55833C8.03496 9.70743 7.9733 9.84585 7.82546 9.83891C7.7625 9.83591 6.34464 9.65668 4.67466 9.44025L4.6747 9.44017ZM10.2773 7.80606C8.94437 7.5664 7.7461 6.73983 7.35927 5.79447C7.1737 5.34034 7.18249 4.74779 7.38064 4.39309C7.5599 4.07225 8.02283 3.70119 8.43737 3.54578C9.12742 3.28727 10.3357 3.39041 11.2164 3.78358C12.0523 4.15662 12.7933 4.81264 13.0688 5.42278C13.4224 6.2059 13.1279 7.07963 12.3706 7.49666C11.8686 7.77279 10.893 7.91684 10.2766 7.8061L10.2773 7.80606Z" fill="white"/>
                                                            </svg>
                                                        </a>
                                                    @endisset

                                                    @isset( $researcher['orcid_url'] )
                                                        <a href="{{ $researcher['orcid_url'] }}" target="_blank" style="text-decoration: none">
                                                            <img src="{{ url('/images/logos/orcid.svg') }}" alt="ORCID logo" style="height: 1.5rem;">
                                                        </a>
                                                    @endisset

                                                    @isset( $researcher['linkedin_url'] )
                                                        <a href="{{ $researcher['linkedin_url'] }}" target="_blank" style="text-decoration: none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 18 19" fill="none">
                                                                <path d="M15.9291 10.5588V16.0931H12.8989V10.9293C12.8989 9.63181 12.4604 8.74681 11.3639 8.74681C10.5267 8.74681 10.028 9.34381 9.80913 9.92056C9.72909 10.1268 9.70855 10.4141 9.70855 10.7028V16.0931H6.67688C6.67688 16.0931 6.71796 7.34806 6.67688 6.44131H9.70855V7.80931L9.68871 7.84081H9.70855V7.80931C10.1109 7.15306 10.8298 6.21481 12.4399 6.21481C14.4338 6.21481 15.9291 7.59481 15.9291 10.5588ZM3.50638 1.78906C2.47009 1.78906 1.7915 2.50906 1.7915 3.45631C1.7915 4.38256 2.45025 5.12431 3.46671 5.12431H3.48655C4.54409 5.12431 5.20071 4.38256 5.20071 3.45631C5.1823 2.50906 4.54409 1.78906 3.50638 1.78906ZM1.97142 16.0931H5.00167V6.44131H1.97142V16.0931Z" fill="white"/>
                                                            </svg>
                                                        </a>
                                                    @endisset
                                                @else
                                                    &nbsp;
                                                @endif
                                               </div>

                                            <hr class="hr-bottom">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                       @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
