@extends('layouts.app')
@section('title','Basic Usage')
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
        <center><h2>Leaflet Map Basic Example</h2></center>
       
    <pre>
        <code class="php">
$map = LaravelMaps::leaflet('map')
->setView([51.505, -0.09], 13)
->addMarker(function(LeafletMarker $marker){
    return $marker
    ->latLng([51.5, -0.09])
    ->bindPopup('<b>Hello world!</b><br>I am a popup.');
})
->addCircle(function(LeafletCircle $circle){
    return $circle
    ->latLng([51.508, -0.11])
    ->options([
        'radius'=>500,
        'color'=>'red',
        'fillColor'=>'#f03',
        'fillOpacity'=>0.5
    ])
    ->bindPopup("I am a circle.");
})
->addPolygon(function(LeafletPolygon $polygon){
    return $polygon
    ->latLng([
        [51.509, -0.08],
        [51.503, -0.06],
        [51.51, -0.047]
    ])
    ->bindPopup("I am a polygon.");                
})
->addPopup("I am a standalone popup.",[51.513, -0.09]);
        </code>
    </pre>
    <h3>
        Marker
    </h3>
    <pre>
        <code class="php">
//using closure

$map->addMarker(function(LeafletMarker $marker){
    return $marker
    ->latLng([51.5, -0.09])
    ->bindPopup('{{ '<b>Hello world!</b><br>I am a popup.' }}');
});

//using class LeafletMarker
$marker = new LeafletMarker([51.5, -0.09]);
$marker->bindPopup('{{ '<b>Hello world!</b><br>I am a popup.' }}');
$map->addMarker($marker);


//using coordinate array directly
$map->addMarker([51.5, -0.09]);

        </code>
    </pre>
    <h3>
        Circle
    </h3>
    <pre>
        <code class="php">
//using closure
$map->addCircle(function(LeafletCircle $circle){
    return $circle
    ->latLng([51.508, -0.11])
    ->options([
        'radius'=>500,
        'color'=>'red',
        'fillColor'=>'#f03',
        'fillOpacity'=>0.5
    ])
    ->bindPopup("I am a circle.");
});

//using class LeafletCircle
$circle = new LeafletCircle([51.508, -0.11],[
    'radius'=>500,
    'color'=>'red',
    'fillColor'=>'#f03',
    'fillOpacity'=>0.5
]);
$circle->bindPopup('{{ 'I am a circle.' }}');
$map->addCircle($marker);


//using coordinate array directly
$map->addCircle([51.5, -0.11],[
    'radius'=>500,
    'color'=>'red',
    'fillColor'=>'#f03',
    'fillOpacity'=>0.5
]);

        </code>
    </pre>
    <h3>
        Polygon
    </h3>
    <pre>
        <code class="php">
//using closure
$map->addPolygon(function(LeafletPolygon $polygon){
    return $polygon
    ->latLng([
        [51.509, -0.08],
        [51.503, -0.06],
        [51.51, -0.047]
    ])
    ->bindPopup("I am a polygon.");                
});

//using class LeafletPolygon
$polygon = new LeafletPolygon(([
    [51.509, -0.08],
    [51.503, -0.06],
    [51.51, -0.047]
]);
$polygon->bindPopup('{{ 'I am a polygon.' }}');
$map->addPolygon($marker);


//using coordinate array directly
$map->addPolygon(([
    [51.509, -0.08],
    [51.503, -0.06],
    [51.51, -0.047]
]);

        </code>
    </pre>
    <h3>
        Popup
    </h3>
    <pre>
        <code class="php">
//using coordinate array directly
$map->addPopup("I am a standalone popup.",[51.513, -0.09]);

//using class LeafletPopup
$polygon = new LeafletPopup("I am a standalone popup.");
$polygon->latLng([51.513, -0.09]);
$map->openOn($map);

        </code>
    </pre>
    </div>
</div>
@endsection