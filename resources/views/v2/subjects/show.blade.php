@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card push-top">
            <div class="card-header">
                <h5>
                    <a href="{{ route('subjects.index')}}">
                        Verbetes
                    </a>
                </h5>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9">{{ $subject->name }}</dd>

                    <dt class="col-sm-3">Criada em</dt>
                    <dd class="col-sm-9">{{ $subject->created_at->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        @if($subject->is_active)
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
                        <a href="{{ route('searchBySubject', $subject->id) }}" class="badge badge-light">
                            <span>{{$subject->resources()->published()->count()}}</span>
                        </a>
                    </dd>

                    <dt class="col-sm-3">Tags</dt>
                    <dd class="col-sm-9">
                        @if(count($subject->tags))
                            @foreach($subject->tags as $tag)
                                <a href="{{ route('searchByTag', $tag->id) }}" class="badge badge-light">
                                    <span>{{$tag->name}}</span>
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
