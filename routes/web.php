<?php

use App\Http\Controllers\WelcomeController;
use Bagusindrayana\LaravelMaps\LaravelMap;
use Bagusindrayana\LaravelMaps\Leaflet\LeafletMarker;
use Bagusindrayana\LaravelMaps\Leaflet\LeafletPopup;
use Bagusindrayana\LaravelMaps\Mapbox\MapboxMarker;
use Bagusindrayana\LaravelMaps\RawJs;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',WelcomeController::class.'@index')->name('home');

Route::get('/leaflet/{menu}',WelcomeController::class.'@leaflet')->name('leaflet');
Route::get('/mapbox/{menu}',WelcomeController::class.'@mapbox')->name('mapbox');