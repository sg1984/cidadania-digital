@extends('layouts.app')

@section('content')
    <div class="jumbotron bg-transparent">
        <div class="container">
            <h1>Uma iniciativa internacional para a promoção e educação para Cidadania Digital</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mollis augue. In feugiat hendrerit turpis, eget tempor nibh malesuada sed. Curabitur sit amet hendrerit magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris placerat, dolor id venenatis sagittis, nibh urna convallis ipsum, sed varius massa risus eget risus. Vivamus suscipit lacinia nisi, sodales cursus leo dignissim vitae. Fusce feugiat suscipit ex et finibus. Vestibulum imperdiet ac felis eget aliquet. Integer non leo et libero luctus feugiat non nec turpis. Fusce quis elit semper, sollicitudin est nec, sagittis velit.
            </p>
        </div>
    </div>

    <div class="parallax">
        @if (session('status'))
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <div class="container pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Diretório de conteúdos</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mollis augue. In feugiat hendrerit turpis, eget tempor nibh malesuada sed. Curabitur sit amet hendrerit magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris placerat, dolor id venenatis sagittis, nibh urna convallis ipsum, sed varius massa risus eget risus. Vivamus suscipit lacinia nisi, sodales cursus leo dignissim vitae. Fusce feugiat suscipit ex et finibus. Vestibulum imperdiet ac felis eget aliquet. Integer non leo et libero luctus feugiat non nec turpis. Fusce quis elit semper, sollicitudin est nec, sagittis velit.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mollis augue. In feugiat hendrerit turpis, eget tempor nibh malesuada sed. Curabitur sit amet hendrerit magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris placerat, dolor id venenatis sagittis, nibh urna convallis ipsum, sed varius massa risus eget risus. Vivamus suscipit lacinia nisi, sodales cursus leo dignissim vitae. Fusce feugiat suscipit ex et finibus. Vestibulum imperdiet ac felis eget aliquet. Integer non leo et libero luctus feugiat non nec turpis. Fusce quis elit semper, sollicitudin est nec, sagittis velit.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="push-top">
                        <div class="row">
                            <div class="col-12 p-0">
                                <h2 class="float-left">
                                    {{ __('Conteúdos') }}
                                </h2>
                                <div class="float-right">
                                    <a href="{{ route('showAll') }}" class="btn btn-sm btn-outline-info">
                                        {{ __('Acessar Diretório') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($resources->items() as $resource)
                                {{ view('resources.content', compact('resource')) }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row pt-5 pb-5">
            <h3>Está por vir...</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">WikiCidadania</h5>
                            <hr>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mollis augue. In feugiat hendrerit turpis, eget tempor nibh malesuada sed. Curabitur sit amet hendrerit magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris placerat, dolor id venenatis sagittis, nibh urna convallis ipsum, sed varius massa risus eget risus. Vivamus suscipit lacinia nisi, sodales cursus leo dignissim vitae. Fusce feugiat suscipit ex et finibus. Vestibulum imperdiet ac felis eget aliquet. Integer non leo et libero luctus feugiat non nec turpis. Fusce quis elit semper, sollicitudin est nec, sagittis velit.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Escola da Cidadania Digital</h5>
                            <hr>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mollis augue. In feugiat hendrerit turpis, eget tempor nibh malesuada sed. Curabitur sit amet hendrerit magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris placerat, dolor id venenatis sagittis, nibh urna convallis ipsum, sed varius massa risus eget risus. Vivamus suscipit lacinia nisi, sodales cursus leo dignissim vitae. Fusce feugiat suscipit ex et finibus. Vestibulum imperdiet ac felis eget aliquet. Integer non leo et libero luctus feugiat non nec turpis. Fusce quis elit semper, sollicitudin est nec, sagittis velit.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Prêmio da Cidadania Digital</h5>
                            <hr>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac mollis augue. In feugiat hendrerit turpis, eget tempor nibh malesuada sed. Curabitur sit amet hendrerit magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris placerat, dolor id venenatis sagittis, nibh urna convallis ipsum, sed varius massa risus eget risus. Vivamus suscipit lacinia nisi, sodales cursus leo dignissim vitae. Fusce feugiat suscipit ex et finibus. Vestibulum imperdiet ac felis eget aliquet. Integer non leo et libero luctus feugiat non nec turpis. Fusce quis elit semper, sollicitudin est nec, sagittis velit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
