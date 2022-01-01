@extends('layouts.app')
@section('title','Custom Icons')
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
        <center><h2>Leaflet Map Custom Icons Example</h2></center>
       
    <pre>
        <code class="php">
$icon = [
    'shadowUrl'=>'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
    'iconSize'=>[38, 95],
    'shadowSize'=>[50, 64],
    'iconAnchor'=>[22, 94],
    'shadowAnchor'=>[4, 62],
    'popupAnchor'=>[-3, -76]
];
$map = LaravelMaps::leaflet('map')
->setView([51.505, -0.09], 13)
->addMarker(function(LeafletMarker $marker)use($icon){
    $icon['iconUrl'] = 'https://leafletjs.com/examples/custom-icons/leaf-green.png';
    return $marker
    ->latLng([51.5, -0.09])
    ->icon($icon)
    ->bindPopup("I am a green leaf.");
})
->addMarker(function(LeafletMarker $marker)use($icon){
    $icon['iconUrl'] = 'https://leafletjs.com/examples/custom-icons/leaf-red.png';
    return $marker
    ->latLng([51.495, -0.083])
    ->icon($icon)
    ->bindPopup("I am a red leaf.");
})
->addMarker(function(LeafletMarker $marker)use($icon){
    $icon['iconUrl'] = 'https://leafletjs.com/examples/custom-icons/leaf-orange.png';
    return $marker
    ->latLng([51.49, -0.1])
    ->icon($icon)
    ->bindPopup("I am a orange leaf.");
});
        </code>
    </pre>
    </div>
</div>
@endsection