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
        <center><h2>Mapbox Map Basic Example</h2></center>
       
    <pre>
        <code class="php">
$map = LaravelMaps::mapbox('xdxd',[
    "center"=>[106.827293,-6.174465],
    "zoom"=>13,
]);


$map->on('load',function($m){
    $m->addMarker(function(MapboxMarker $marker){
        return $marker
        ->lngLat([51.5, -0.09])
        ->setPopup('<b>Hello world!</b><br>I am a popup.');
    });
});
        </code>
    </pre>
  
    
    </div>
</div>
@endsection