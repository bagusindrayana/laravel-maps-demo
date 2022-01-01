@extends('layouts.app')
@section('title','Geojson')
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
        <center><h2>Leaflet Map Geojson Example</h2></center>
       
    <pre>
        <code class="php">
//load json file
$geojson = file_get_contents("{{ url('geojson/provinsi.json') }}");
$map = LaravelMaps::leaflet('map')
->setView([-0.780236,113.871012], 6)
->addGeojson($geojson,[
    "onEachFeature"=>"function(feature, layer){
        layer.bindPopup(feature.properties.nama_provinsi);
    }"
]);
        </code>
    </pre>
    <h3>
        Geojson
    </h3>
    <pre>
        <code class="php">
//option onEachFeature will read value as javascript code
$options = [
    "onEachFeature"=>"function(feature, layer){
        layer.bindPopup(feature.properties.nama_provinsi);
    }"
];
$map->addGeojson($geojsonData,$options);


//using class LeafletGeojson
$geojson = new LeafletMarker($geojsonData,$options);
$map->addGeojson($geojson);

        </code>
    </pre>
    </div>
</div>
@endsection