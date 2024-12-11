@extends("welcome")
@section('title', "{{$annonce->title}}")
<style>
  #toggle-button img {
      width: 40px; /* Ajuster la taille de l'image si nécessaire */
      height: 40px;
      border-radius: 50%; /* Ajoute une bordure circulaire */
      border: 2px solid black; /* Ajoute une bordure noire */
  }
  #toggle-button:focus {
      outline: none; /* Supprime le cadre de mise au point */
  }
    .jumbotron {
        background-color: #f8f9fa;
        padding: 3rem;
        margin-bottom: 3rem;
        border-radius: 0;
    }
    .card {
        border: none;
        background: none;
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #007bff;
        color: #fff;
        border-radius: 0;
    }
    .btn-contact {
        background-color: #28a745;
        border-color: #28a745;
        border-radius: 0;
    }
    .btn-contact:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    #map-container {
        margin-bottom: 20px;
        border: 1px solid #ccc; /* Ajoute une bordure pour délimiter le cadre */
        border-radius: 5px; /* Ajoute des coins arrondis au cadre */
        overflow: hidden; /* Empêche la carte de déborder du cadre */
        position: relative;
    }
    #map {
        width: 100%;
        height: 400px;
    }

    #toggle-button {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .seller-card {
        border: none;
        background: none;
        margin-bottom: 20px;
    }

    .seller-image {
        border-radius: 50%;
        width: 100px;
        height: 100px;
    }

    .seller-info {
        margin-top: 10px;
    }
</style>

@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <!-- Slider -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @for ($i = 1; $i <= 6; $i++)
                        @if (!empty($annonce["image$i"]))
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i - 1 }}" class="{{ $i === 1 ? 'active' : '' }}"></li>
                        @endif
                    @endfor
                </ol>
                <div class="carousel-inner">
                    @for ($i = 1; $i <= 6; $i++)
                        @if (!empty($annonce["image$i"]))
                            <div class="carousel-item {{ $i === 1 ? 'active' : '' }}">
                                <img src="{{asset('storage/images/'. basename($annonce["image$i"])) }}" class="d-block w-100" alt="Image {{ $i }}">
                            </div>
                        @endif
                    @endfor
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <!-- Détails de l'annonce -->
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0" style="color: #2a77c9">{{ $annonce->title }}</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Prix: €{{ $annonce->price }}</li>
                        <li class="list-group-item">Category: {{ $annonce->category }}</li>
                        <li class="list-group-item">
                            <ul class="list-group list-group-flush">Contact
                                <li class="list-group-item">Email: {{ $annonce->user->email }}</li>
                                <li class="list-group-item">Téléphone: {{ $annonce->user->phone }}</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-right">
                    <a href="#" class="btn btn-contact">Contacter le vendeur</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Séparateur -->
    <hr>
    <!-- Présentation du vendeur -->
    <div class="row">
      <div class="col-md-4">
          <div class="seller-card text-center">
            
              <img src="{{asset('storage/imagesProfils/'. basename($annonce->user->imageProfil)) }}" alt="Vendeur" class="seller-image">
              <div class="seller-info">
                  <span class="list-group-item">{{ $annonce->user->name }}</span>
                  
                  <span class="list-group-item">Email: {{ $annonce->user->email }}</span>
                  <span class="list-group-item">Téléphone: {{ $annonce->user->phone }}</span>
              </div>
          </div>
      </div>
  </div>
  <!-- Séparateur -->
  <hr>
  <!-- Description de l'annonce -->
  <p class="card-text">{{ $annonce->description }}</p>
  <!-- Séparateur -->
  <hr>
  <h3>Positionnement</h3>  
  <div id="map-container">
      <button id="toggle-button">
          <img  src="https://th.bing.com/th/id/OIP.47VZP9vr4B_xAOO15KfeVgHaD4?w=295&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Satellite View">
      </button>
      <div id="map"></div>
  </div>
</div>

<!-- Inclusion de la bibliothèque Leaflet -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<!-- Inclusion de la bibliothèque Mapbox -->
<script src='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css' rel='stylesheet' />

<script>
  // Mapbox Access Token
  var mapboxAccessToken = 'pk.eyJ1IjoibXVzdGFmYTIwMDEiLCJhIjoiY2x3dzQ3MHhnMHdoeTJvcjF3cGRubmlmYyJ9.oxbOG-lN2LjOs_3e-c3sfQ';

  var map = L.map('map').setView([{{ $annonce->posX }}, {{ $annonce->posY }}], 10);
  
  var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  var satelliteLayer = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-streets-v11/tiles/256/{z}/{x}/{y}@2x?access_token=' + mapboxAccessToken, {
      attribution: '&copy; Mapbox &copy; OpenStreetMap',
      tileSize: 512,
      zoomOffset: -1
  });

  var currentLayer = osmLayer;

  document.getElementById('toggle-button').addEventListener('click', function () {
      if (map.hasLayer(osmLayer)) {
          map.removeLayer(osmLayer);
          map.addLayer(satelliteLayer);
          this.querySelector('img').src = 'https://th.bing.com/th/id/OIP.nzkBi3V8EHiu9CjsfwQHyAHaDt?w=295&h=175&c=7&r=0&o=5&dpr=1.3&pid=1.7';
      } else {
          map.removeLayer(satelliteLayer);
          map.addLayer(osmLayer);
          this.querySelector('img').src = 'https://th.bing.com/th/id/OIP.47VZP9vr4B_xAOO15KfeVgHaD4?w=295&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7';
      }
  });

  // Ajout du marqueur sur la carte
  L.marker([{{ $annonce->posX }}, {{ $annonce->posY }}]).addTo(map)
      .bindPopup("{{ $annonce->title }}");
</script>
@endsection

