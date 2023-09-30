<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', '2023 Cidadania Digital') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<link href="{{ mix('css/app-2023.css') }}" rel="stylesheet">
<link href="{{ mix('css/footer.css') }}" rel="stylesheet">
<link href="{{ asset('css/fa/css/all.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/slick/slick.css') }}" rel="stylesheet" />
<link href="{{ asset('css/slick/slick-theme.css') }}" rel="stylesheet" />

<link href="{{ asset('/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
<link href="{{ asset('/fontawesome/css/brands.css') }}" rel="stylesheet">
<link href="{{ asset('/fontawesome/css/solid.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Scripts -->
<script src="{{ mix('js/initial-load.js') }}" defer></script>
<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ mix('js/app-2023.js') }}" defer></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>
<script src="{{ asset('js/select2/select2.min.js') }}" defer></script>
<script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
<script src="{{ asset('js/slick/slick.min.js') }}" defer></script>

@stack('css')
