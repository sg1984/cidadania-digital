<div class="modal fade"
     id="{{ $person['slug'] }}"
     data-backdrop="static"
     data-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-labelledby="{{ $person['id'] }}-label"
     aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered team-modal">
        <div class="modal-content" style="border: 1px solid #224A59;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body team-modal-person">
                <div class="media">
                    <a class="mr-2 team-person-link team-person-picture-link rounded-circle">
                        <img src="{{ $person['picture_url'] }}" alt="{{ $person['name'] }}" class="team-person-picture rounded-circle mr-2 align-self-center mr-3">
                    </a>
                    <div class="media-body col-6">
                        <h5 class="mt-4">{{ $person['name'] }}</h5>
                        <h6 class="mt-0 font-italic">{{ $person['university'] }}</h6>
                        @if( $person['lattes_url'] )
                            <a href="{{ $person['lattes_url'] }}" target="_blank" style="text-decoration: none">
                                <img src="{{ url('/images/logos/lattes.png') }}" alt="Lattes logo" style="height: 1.5rem;">
                            </a>
                        @endif
                        @if( $person['orcid_url'] )
                            <a href="{{ $person['orcid_url'] }}" target="_blank" style="text-decoration: none">
                                <img src="{{ url('/images/logos/orcid.svg') }}" alt="ORCID logo" style="height: 1.5rem;">
                            </a>
                        @endif
                        @if( $person['linkedin_url'] )
                            <a href="{{ $person['linkedin_url'] }}" target="_blank" style="text-decoration: none">
                                <img src="{{ url('/images/logos/linkedin.png') }}" alt="LinkedIn logo" style="height: 1.5rem;">
                            </a>
                        @endif
                    </div>
                    <div class="col-6 d-flex">
                        @if ($person['subject'] && $person['subject']['image'] && $person['subject']['name'] )
                            <div class="media-body text-right" style="bottom: 0;position: absolute; top: 82px; right: 0;">
                                <a href="{{ route('showSpecialPage', $person['subject']['id']) }}" style="text-decoration: none; color: #212529;">
                                    <h6 class="mt-0 font-italic">{{ $person['subject']['name'] }}</h6>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($person['minibio'])
                    <div class="jumbotron mt-3 mb-0" style="padding: 1rem">
                        <p class="collapse" id="{{ $person['id'] }}-minibio" aria-expanded="false">
                            {{ $person['minibio'] }}
                        </p>
                        <div class="more-minibio">
                            <a role="button" class="collapsed" data-toggle="collapse" href="#{{ $person['id'] }}-minibio" aria-expanded="false" aria-controls="{{ $person['id'] }}-minibio"></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
