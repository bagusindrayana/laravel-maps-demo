<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Laravel Maps')</title>
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    
    @stack('styles')
</head>
<body class="@yield('cssBody')">
  
<div class="loading" id="loading">
  
  <div class="bar-1"></div>
  <div class="bar-2"></div>
  
  
</div>
<div class="loading-text">
  <h2>Loading...</h2>
</div>
    <div class="navbar" id="navbar">
        <a href="{{ route('home') }}">Home</a>
        <div class="dropdown">
          <button class="dropbtn">Leaflet JS 
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
                <a href="{{ route('leaflet','basic') }}">Basic Usage</a>
                <a href="{{ route('leaflet','location') }}">Location</a>
                <a href="{{ route('leaflet','custom-icons') }}">Custom Icons</a>
                <a href="{{ route('leaflet','geojson') }}">Geojson</a>
          </div>
        </div> 
        <div class="dropdown">
            <button class="dropbtn">Mapbox GL JS
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="{{ route('mapbox','basic') }}">Basic Usage</a>
                <a href="{{ route('mapbox','geojson') }}">Geojson</a>
            </div>
          </div> 
          <a href="javascript:void(0);" class="icon" onclick="openMenu()">
            <span class="iconify" data-icon="ant-design:menu-outlined"></span>
          </a>
      </div>
    

    @yield('content')

    <footer>
      <a href="https://github.com/bagusindrayana/laravel-maps" target="_blank"><span class="iconify" data-icon="akar-icons:github-fill"></span> bagusindrayana/laravel-maps</a>
    </footer>
    
    @stack('scripts')
     
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>
    
    <script>
      window.onload = function() {
        
        var loading = document.getElementById('loading');
        
       
        setTimeout(() => {
          document.querySelector('.loading-text').classList.add('close');
        }, 300);
        setTimeout(() => {
          loading.classList.add('close');
        }, 1000);
        setTimeout(() => {
          loading.style.display = 'none';
          
        }, 3000);
      }

      function openMenu() {
        var x = document.getElementById("navbar");
        if (x.className === "navbar") {
          x.className += " responsive";
        } else {
          x.className = "navbar";
        }
      }
    </script>
</body>
</html>