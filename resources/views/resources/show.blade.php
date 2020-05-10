@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="push-top">
            <div class="card-header">
                <h5>
                    <a href="{{ route('resources.index')}}">
                        Documentos
                    </a>
                </h5>
            </div>
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div><br />
            @endif

            @if(session()->get('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div><br />
            @endif
        </div>
        {{ view('resources.content', compact('resource')) }}
    </div>
@endsection
