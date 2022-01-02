@extends('layouts.app')
@section('title','Laravel Maps')
@push('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
<link rel="stylesheet" href="{{ asset('css/dracula.css') }}">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
@endpush
@push('scripts')
<script>
    hljs.highlightAll();
</script>
@endpush
@section('content')

    <div class="main-page">
        <h2>Laravel Maps</h2>
        <h4>set mapbox and leaflet map initiation from within laravel</h4>
        <h3>Installation</h3>
        <pre>
            <code class="bash">
    composer require bagusindrayana/laravel-maps
            </code>
        </pre>

        <p>Add LaravelMapServiceProvider::class to config/app.php</p>
        <pre>
            <code class="php">
    'providers'=>[
        //....

        Bagusindrayana\LaravelMaps\LaravelMapsServiceProvider::class,

        //...
    ],
            </code>
        </pre>
        <p>Publish provider</p>
        <pre>
            <code class="bash">
    php artisan vendor:publish --provider=Bagusindrayana\LaravelMaps\LaravelMapsServiceProvider
            </code>
        </pre>
        <p>if want use mapbox</p>
        <p>Add Mapbox Acces Token in .env</p>
        <pre>
            <code class="bash">
    MAPBOX_ACCESS_TOKEN=
            </code>
        </pre>
        <h3>Usage</h3>
        <p>In Controller</p>
        <pre>
            <code class="php">
    $map = LaravelMaps::leaflet('map')
    ->setView([51.505, -0.09], 13);
    
    return view('your-view',compact('map'));
            </code>
        </pre>
        <p>In View</p>
        <pre>
            <code class="html">
    {{$html}}
            </code>
        </pre>
        <h3>Leaflet</h3>
        <hr>
        <h4>Features</h4>
        <ul>
            <li>
                marker
            </li>
            <li>
                circle
            </li>
            <li>
                polygon
            </li>
            <li>
                geojson
            </li>
            <li>
                basic event and method
            </li>
        </ul>
        <h4>Basic Usage</h4>
        <pre>
            <code class="php">
    //'map' is variable name will be use in javascript code
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

        <h3>Mapbox</h3>
        <hr>
        <h4>Features</h4>
        <ul>
            <li>
                marker
            </li>
            <li>
                geojson
            </li>
            <li>
                basic event and method
            </li>
        </ul>
        <h4>Basic Usage</h4>
        <pre>
            <code class="php">
    //'map' is variable name will be use in javascript code
    $map = LaravelMaps::mapbox('map',[
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

   
@endsection