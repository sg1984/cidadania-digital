<h2 class="home-title">Verbetes</h2>

<div id="verbetes-list" class="mt-4 row carousel slide w-100">
    <div class="carousel-inner w-100" role="listbox">
        @foreach($subjects as $key => $subject)
            <div class="carousel-item {{ $key === \App\Subject::ALGORITMOS_CIDADANIA ? 'active' : '' }}">
                <div class="col-md-4">
                    <div class="card card-body p-0">
                        <a href="{{ route('showSpecialPage', $key) }}">
                            <img class="img-fluid" src="{{ $subject['image'] }}" alt="Video thumbnail">
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev-slide w-auto" href="#verbetes-list" role="button" data-slide="prev">
        <div class="carrousel-background left">
            <div class="carousel-control-prev-icon arrow">
                <i class="fas fa-chevron-circle-left fa-4x mt-4"></i>
            </div>
        </div>
    </a>
    <a class="carousel-control-next-slide w-auto" href="#verbetes-list" role="button" data-slide="next">
        <div class="carrousel-background right">
            <div class="carousel-control-next-icon arrow">
                <i class="fas fa-chevron-circle-right fa-4x mt-4"></i>
            </div>
        </div>
    </a>
</div>
