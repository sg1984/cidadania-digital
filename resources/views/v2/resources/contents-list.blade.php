<div class="card-columns">
    @foreach($resources->items() as $resource)
        <div class="card mb-4">
            <div class="card-header">
                <span>{{ $resource->subject->name }}</span>
                <a href="{{ route('v2.searchBySubject', $resource->subject->id) }}" class="label">
                    mais como esse
                </a>

                <a target="_blank" href="{{ $resource->getSourceLink() }}" class="pull-right">
                    <i class="fa fa-2x fa-arrow-up icon-incline"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="text-truncate1">
                    <h5 class="card-title"> <i class="{{ $resource->getFormatIcon(true) }}"></i> {{ $resource->title }}</h5>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        @if($resource->user->getPictureLink())
                            <img src="{{ $resource->user->getPictureLink() }}"
                                 alt="{{ $resource->user->name }}"
                                 class="team-person-picture rounded-circle mr-2"
                                 style="height: 2em;width: 2em;"
                                 title="{{ $resource->user->name }}"
                            >
                        @endif

                        <small class="person">
                            {{ $resource->user->name }}
                        </small>
                    </div>

                    <div class="col-xs-12 col-sm-7 flex">
                        @foreach($resource->tags as $tag)
                            <a href="{{ route('v2.searchByTag', $tag->id) }}" class="mb-2 mr-2">
                                <span class="label">{{$tag->name}}</span>
                            </a>
                        @endforeach
                    </div>

                    <div class="col-xs-12 col-sm-2">
                        <button type="button" class="btn-detail btn btn-outline-info btn-sm" data-toggle="modal" data-target="#resource-{{$resource->id}}">
                            Ver detalhes
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="resource-{{$resource->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="resourceLabel-{{$resource->id}}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>{{ $resource->subject->name }}</span>
                        <a href="{{ route('v2.searchBySubject', $resource->subject->id) }}" class="label mt-2">
                            mais como esse
                        </a>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>

                    </div>

                    <div class="modal-body">
                        <hr class="hr-bottom"/>
                        <h3 class="modal-title">
                            <i class="{{ $resource->getFormatIcon(true) }}"></i> {{ $resource->title }}
                        </h3>

                        <p class="modal-description">
                            {{ $resource->description }}
                        </p>

                        <div class="row mb-3">
                            <div class="col-xs-12 col-sm-3">
                                @if($resource->user->getPictureLink())
                                    <img src="{{ $resource->user->getPictureLink() }}"
                                         alt="{{ $resource->user->name }}"
                                         class="team-person-picture rounded-circle mr-2"
                                         style="height: 2em;width: 2em;"
                                         title="{{ $resource->user->name }}"
                                    >
                                @endif

                                <small class="person">
                                    {{ $resource->user->name }}
                                </small>
                            </div>
                        </div>

                        @foreach($resource->tags as $tag)
                            <a href="{{ route('searchByTag', $tag->id) }}">
                                <span class="label">{{$tag->name}}</span>
                            </a>
                        @endforeach
                    </div>

                    <div class="modal-footer">
                        @auth
                            <div class="float-left">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#resourceReportForm-{{ $resource->id }}" data-dismiss="modal">{{ __('Sugerir alteração') }}</button>
                            </div>
                        @endauth

                        <div class="float-right">
                            <a target="_blank" href="{{ $resource->getSourceLink() }}" class="btn-detail btn btn-outline-info btn-sm">
                                Explorar o para conteúdo <i class="fa fa-arrow-up icon-incline"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @auth
            <!-- Modal Report Resource Error -->
            <div class="modal fade" id="resourceReportForm-{{ $resource->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Sugestão de ajuste em Documento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('resourceReport') }}" autocomplete="false">
                            @csrf
                            <input type="hidden" class="form-control" name="responsible_id" value="{{ $resource->user->id }}"/>
                            <input type="hidden" class="form-control" name="resource_id" value="{{ $resource->id }}"/>
                            <div class="modal-body">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" name="title" required autocomplete="false"/>
                                <label for="description">Por favor, descreva a sugestão:</label>
                                <textarea class="form-control" name="description" rows="5" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-outline-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    @endforeach
</div>
