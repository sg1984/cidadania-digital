@foreach($resources->items() as $resource)
    <div class="col-md-4">
        {{ view('resources.content', compact('resource')) }}
    </div>
@endforeach
