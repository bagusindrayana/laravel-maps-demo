<?php

namespace App\Http\Controllers;

use Bagusindrayana\LaravelMaps\LaravelMaps;
use Bagusindrayana\LaravelMaps\Leaflet\LeafletCircle;
use Bagusindrayana\LaravelMaps\Leaflet\LeafletMarker;
use Bagusindrayana\LaravelMaps\Leaflet\LeafletPolygon;
use Bagusindrayana\LaravelMaps\Leaflet\LeafletPopup;
use Bagusindrayana\LaravelMaps\Mapbox\MapboxMarker;
use Bagusindrayana\LaravelMaps\RawJs;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{   

    public function index()
    {
        return view('welcome');
    }

    public function leaflet($menu)
    {   
        $map = null;
        switch ($menu) {
            case 'basic':
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
                break;
            case 'location':
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
                    $m->rawJs('alert(e.message);');
                });
                
                break;
            case 'custom-icons':
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
                
                break;
            case 'geojson':
                $geojson = file_get_contents(url('geojson/provinsi.json'));
                $map = LaravelMaps::leaflet('map')
                ->setView([-0.780236,113.871012], 6)
                ->addGeojson($geojson,[
                    "onEachFeature"=>"function(feature, layer){
                        layer.bindPopup(feature.properties.nama_provinsi);
                    }"
                ]);
                
                break;
            default:
                return abort(404);
                break;
        }

        return view('example.leaflet.'.$menu,compact('map'));
    }

    public function mapbox($menu)
    {
        $map = null;
        switch ($menu) {
            case 'basic':
                $map = LaravelMaps::mapbox('map',[
                    "center"=>[106.827293,-6.174465],
                    "zoom"=>10,
                ]);
            
                
                $map->on('load',function($m){
                    $m->addMarker(function(MapboxMarker $marker){
                        return $marker
                        ->lngLat([106.827293,-6.174465])
                        ->setPopup('<b>Hello world!</b><br>I am a popup.');
                    });
                });
                
                break;
            case 'geojson':
                $map = LaravelMaps::mapbox('map',[
                    "center"=>[113.871012,-0.780236],
                    "zoom"=>5,
                ]);
            
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
                
                
                break;
            default:
                return abort(404);
                break;
        }

        return view('example.mapbox.'.$menu,compact('map'));
    }
}
