<div class="card-columns">
    @foreach($resources->items() as $resource)
        {{ view('resources.content', compact('resource')) }}
    @endforeach
</div>
