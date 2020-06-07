@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card push-top">
            <div class="card-header">
                <h5>
                    <a href="{{ route('tags.index')}}">
                        Tags
                    </a>
                </h5>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $tag->name }}</dd>

                    <dt class="col-sm-3">Criada em</dt>
                    <dd class="col-sm-9">{{ $tag->created_at->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        @if($tag->is_active)
                            <span class="badge badge-success">
                                    Ativa
                                </span>
                        @else
                            <span class="badge badge-secondary">
                                    Desativada
                                </span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Conteúdos relacionados</dt>
                    <dd class="col-sm-9">
                        <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-light">
                            <span>{{$tag->resources()->published()->count()}}</span>
                        </a>
                    </dd>

                    <dt class="col-sm-3">Verbetes relacionados</dt>
                    <dd class="col-sm-9">
                        @if(count($tag->subjects))
                            @foreach($tag->subjects as $subject)
                                <a href="{{ route('searchBySubject', $subject->id) }}" class="badge badge-light">
                                    <span>{{$subject->name}}</span>
                                </a>
                            @endforeach
                        @else
                            -
                        @endif
                    </dd>
                </dl>

                <a href="{{ url()->previous() }}" class="btn btn-outline-info float-right mr-3">Voltar</a>
            </div>
        </div>
    </div>
@endsection
