<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cidadania Digital</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/resources') }}">Documentos</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Cidadania Digital
                </div>

                <div class="push-top">
                    <div class="card-header">
                        <h5>
                            Documentos
                        </h5>
                    </div>

                        @foreach($resources as $resource)
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    {{ $resource->title }}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><b>Tema:</b> {{ $resource->subject->name }}</h5>
                                    <h5 class="card-title"><b>Descrição:</b> {{ $resource->description }}</h5>
                                    <p class="card-text"><b>Palavras-chave:</b> {{ $resource->key_words }} </p>
                                    <p class="card-text"><b>Formato:</b> {{ $resource->format }} </p>
                                    <p class="card-text"><b>Link:</b> {{ $resource->source }} </p>
                                    <p class="card-text"><b>Criada em:</b> {{ $resource->created_at->format('Y-m-d H:i') }} </p>
                                    <p class="card-text"><b>Criado por:</b> {{ $resource->user->name }} </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    <script type="application/javascript" src="js/app.js"></script>
    </body>
</html>
