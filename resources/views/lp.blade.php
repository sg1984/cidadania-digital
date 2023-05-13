<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cidadania Digital</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            html, body {
                color: white;
                font-family: 'Nunito', sans-serif;
                height: 100vh;
                margin: 0;
                font-size: 15px;
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

            .btn-access {
                background-color: rgba(255, 255, 255, 0.2);
                border-color: white;
                color: white;
                margin: 10px;
                padding: 10px 30px;
            }

            .btn-course-access {
                margin: 10px;
                padding: 10px 30px;
                background-color: #3937A3;
                border-color: #3937A3;
            }

            .btn-access:hover {
                background-color: rgba(255, 255, 255, 0.6);
                border-color: white;
                color: gray;
            }

            main {
                background-image: linear-gradient(to right, #725e9c, #90569d, #af4b94, #cb3b82, #e02e67);
                height: 100%;
                width: 100%;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }

            ul {
                text-align: left;
                margin-bottom: 80px;
            }

            ul li {
                margin-bottom: 20px;
            }

            ul li::marker {
                content: url('data:image/svg+xml;charset=UTF-8,');
                font-size: 1.2em;
            }

            ul li p {
                margin-bottom: 0;
            }

            .header {
                margin-top: 15%;
                margin-bottom: 80px;
            }

        </style>
    </head>
    <body>
        <main class="py-4">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12 header">
                            <img src="{{ url('/images/lp-cabecalho.png') }}" alt="Atopos Logo">
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul>
                                        @foreach([
                                                ['nome' => 'Processo de Formação da Identidade Digital', 'professores' => 'prof. Massimo Di Felice'],
                                                ['nome' => 'Gêmeos Digitais', 'professores' => 'prof. Derrick De Kerckhove'],
                                                ['nome' => 'Privacidade e Segurança', 'professores' => 'profa. Yasodara Córdova'],
                                                ['nome' => 'Identidade Digital Indígena', 'professores' => 'Sônia Guajajara e profa. Eliete Pereira'],
                                            ]
                                        as $aula)
                                            <li>
                                                <div class="row">
                                                    <div class="col-1 mt-2">
                                                        <svg width="30" height="30" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="0.5" y="0.5" width="19" height="19" fill="#D9D9D9" fill-opacity="0.5" stroke="#D2D2D2"/></svg>
                                                    </div>
                                                    <div class="col-11">
                                                        <p class="font-weight-bolder">{{ $aula['nome'] }}</p>
                                                        <p>({{ $aula['professores'] }})</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('showSpecialPage', 'unico') }}">
                                        <img src="{{ url('/images/video-lp.png') }}" alt="Video aula">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img src="{{ url('/images/logos/logos.png') }}" alt="Atopos Logo">
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-primary btn-access"
                                       href="{{ route('index') }}"
                                    >
                                        IR PARA O SITE
                                    </a>

                                    <a class="btn btn-primary btn-course-access"
                                       href="{{ route('showSpecialPage', 'unico') }}"
                                    >
                                        ACESSAR CURSO
                                    </a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <script type="application/javascript" src="js/app.js"></script>
    </body>
</html>
