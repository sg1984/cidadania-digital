<h2 class="home-title">Verbetes</h2>

<div class="row">
    @foreach($subjects as $key => $subject)
        <div class="col-md-3 mb-3">
            <div class="card card-body p-0">
                <a href="{{ route('showSpecialPage', $key) }}">
                    <img class="img-fluid" src="{{ $subject['image'] }}" alt="Video thumbnail">
                </a>
            </div>
        </div>
    @endforeach
</div>
