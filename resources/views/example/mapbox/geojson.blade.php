@extends('layouts.app')
@section('title','Mapbox Map Geojson')
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
        <center><h2>Mapbox Map Geojson Example</h2></center>
       
    <pre>
        <code class="php">
$map = LaravelMaps::mapbox('map',[
    "center"=>[113.871012,-0.780236],
    "zoom"=>5,
]);

//load json file
$geojson = file_get_contents(url('geojson/provinsi.json'));
$map->on('load',function($m)use($geojson){
    $m->addSource('provinsi',[
        'type'=>'geojson',
        'data'=>json_decode($geojson)
    ]);

    $m->addLayer([
        'id'=> 'provinsi',
        'type'=> 'fill',
        'source'=> 'provinsi',
        'paint'=>[
            'fill-color'=>'#0080ff',
            'fill-opacity'=>0.5
        ]
    ]);

    $m->on(['click','provinsi'],function($m){
        $m->rawJs("
        const coordinates = e.lngLat;
        console.log(coordinates);
        const namaProvinsi = e.features[0].properties.nama_provinsi;
        ");
        $m->addPopup(new RawJs("'<h3>'+namaProvinsi+'</h3>'"),'coordinates');
    });
});
        </code>
    </pre>
  
    
    </div>
</div>
@endsection