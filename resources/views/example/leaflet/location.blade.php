@extends('layouts.app')
@section('title','Locate Function and Event')
@section('cssBody','max-height')
@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
<link rel="stylesheet" href="{{ asset('css/dracula.css') }}">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
{!! @$map->styles() !!}
@endpush
@push('scripts')
<script>
    hljs.highlightAll();
    var toggle = document.getElementById('toggle');
    toggle.addEventListener('click', function() {
        var bottomModal = document.querySelector('.bottom-modal');
        bottomModal.classList.toggle('active');
    });
</script>
{!! @$map->scripts() !!}  
@endpush
@section('content')
{!! @$map->render() !!}
<div class="bottom-modal">
    <div class="toggle" id="toggle">
        <span class="iconify" data-icon="bi:arrow-down-circle"></span>
    </div>
    <div class="modal-content">
        <center><h2>Leaflet Map Location Example</h2></center>
       
    <pre>
        <code class="php">
$map = LaravelMaps::leaflet('map')
->locate([
    'setView'=>true,
    'maxZoom'=>16
])
->on('locationfound',function($m){
    $m->rawJs('var radius = e.accuracy;');
    $m->addMarker(function(LeafletMarker $marker){
        return $marker
        ->latLng('e.latlng')
        ->bindPopup(new RawJs("'You are within '+ radius + ' meters from this point'"));
    });
})
->on('locationerror',function($m){
    //use rawJs() to add javascript code
    $m->rawJs('alert(e.message);');
});
        </code>
    </pre>
    <h3>
        Event
    </h3>
    <pre>
        <code class="php">
//using rawJs() method to add javascript code
$map->on('locationfound',function($m){
    $m->rawJs('var radius = e.accuracy;');
    $m->addMarker(function(LeafletMarker $marker){
        return $marker
        //some functions will also read the arguments given as javascript code if the format is string for example like latLng() function
        ->latLng('e.latlng')
        ->bindPopup(new RawJs("'You are within '+ radius + ' meters from this point'"));
    });
});

        </code>
    </pre>
    </div>
</div>
@endsection