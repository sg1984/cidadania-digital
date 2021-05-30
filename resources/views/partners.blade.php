<h2 class="home-title">Parceiros</h2>

<div id="partners-list" class="mt-3 row carousel slide w-100">
    <div class="carousel-inner w-100" role="listbox">
        @foreach($partners as $key => $partner)
            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                <div class="col-md-3">
                    <div class="card card-body p-0">
                        <img class="img-fluid" src="{{ $partner }}" alt="Logo">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
