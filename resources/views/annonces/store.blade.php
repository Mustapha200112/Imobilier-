@extends("welcome")
@section('title', "Ajouter une Annonce")

<style>
  .containerForm {
      max-width: 600px;
      margin: auto;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
      text-align: center;
      margin-bottom: 30px;
  }

  .form-group {
      margin-bottom: 20px;
  }
  .form-group img{

    border-radius:50px;
    width: 10% 
  }

  label {
      font-weight: bold;
  }

  input[type="text"],
  textarea,
  input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
  }

  textarea {
      resize: vertical;
  }

  input[type="file"] {
      border: none;
      background-color: transparent;
  }

  input[type="file"]::-webkit-file-upload-button {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
  }

  input[type="file"]::-webkit-file-upload-button:hover {
      background-color: #0056b3;
  }

  input[type="submit"] {
      background-color: #2ed02b;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
      font-size: 16px;
  }

  input[type="submit"]:hover {
      background-color: #21b300;
  }

  .preview-image {
      display: block;
      margin-top: 10px;
      max-width: 100%;
      height: auto;
  }

  #map-container {
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      overflow: hidden;
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

  #toggle-button img {
      width: 30px;
      height: 30px;
  }
</style>

@section("content")
<div class="container mt-5 containerForm">
    <h2>Ajouter une Annonce</h2>
    <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Vos champs de formulaire ici -->
        <div class="form-group">
            <label for="title">Titre:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Prix:</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="category">Catégorie:</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="form-group">
            <label for="image">Image Principal:</label>
            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(this, 'preview-image')" required>
            <img id="preview-image" src="#" alt="Image preview" width="200" style="display: none">
        </div>
        
        <div class="row">
                <div class="form-group col-4">
                  <label for="image1">Image 1:</label>
                  <input type="file" class="form-control-file" id="image1" name="image1" onchange="previewImage(this, 'preview-image1')" >
                  <img id="preview-image1" src="#" alt="Image preview1" width="200" style="display: none">
              </div>
              <div class="form-group col-4">
                  <label for="image2">Image 2:</label>
                  <input type="file" class="form-control-file" id="image2" name="image2" onchange="previewImage(this, 'preview-image2')" >
                  <img id="preview-image2" src="#" alt="Image preview2" width="200" style="display: none">
              </div>
              <div class="form-group col-4">
                  <label for="image3">Image 3:</label>
                  <input type="file" class="form-control-file" id="image3" name="image3" onchange="previewImage(this, 'preview-image3')" >
                  <img id="preview-image3" src="#" alt="Image preview3" width="200" style="display: none">
              </div>
        </div>
        <div class="row">
              <div class="form-group col-4">
                <label for="image4">Image 4:</label>
                <input type="file" class="form-control-file" id="image4" name="image4" onchange="previewImage(this, 'preview-image4')" >
                <img id="preview-image4" src="#" alt="Image preview4" width="200" style="display: none">   
            </div>
            <div class="form-group col-4">
                <label for="image5">Image 5:</label>
                <input type="file" class="form-control-file" id="image5" name="image5" onchange="previewImage(this, 'preview-image5')" >
                <img id="preview-image5" src="#" alt="Image preview5" width="200" style="display: none">
            </div>
            <div class="form-group col-4">
                <label for="image6">Image 6:</label>
                <input type="file" class="form-control-file" id="image6" name="image6" onchange="previewImage(this, 'preview-image6')" >
                <img id="preview-image6" src="#" alt="Image preview6" width="200" style="display: none">
            </div>
        </div>

        <!-- Conteneur de la carte -->
        <div id="map-container">
            <button type="button"  class="" id="toggle-button">
                <img src="https://th.bing.com/th/id/OIP.47VZP9vr4B_xAOO15KfeVgHaD4?w=295&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Satellite View">
            </button>
            <div id="map"></div>
        </div>
        
        <!-- Champs cachés pour les coordonnées -->
        <input type="hidden" name="posX" id="posX">
        <input type="hidden" name="posY" id="posY">
        
        <input type="submit" value="Ajouter l'annonce">
    </form>
</div>

<!-- Inclusion des scripts nécessaires -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.css" />
<script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/bundle.min.js"></script>
<script>
    var mapboxAccessToken = 'pk.eyJ1IjoibXVzdGFmYTIwMDEiLCJhIjoiY2x3dzQ3MHhnMHdoeTJvcjF3cGRubmlmYyJ9.oxbOG-lN2LjOs_3e-c3sfQ';

    var map = L.map('map').setView([34.016640, -6.828108], 7);
    var marker = L.marker([34.016640, -6.828108], { draggable: true }).addTo(map);

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

    // Ajouter le contrôle de zoom
    L.control.zoom({ position: 'bottomright' }).addTo(map);

    // Gestionnaire d'événements de déplacement de marqueur
    marker.on('dragend', function (e) {
        var position = marker.getLatLng();
        document.getElementById('posX').value = position.lat;
        document.getElementById('posY').value = position.lng;
        map.panTo(position); // Centrer la carte sur la nouvelle position du marqueur
    });

    // Gestionnaire d'événements de clic sur la carte
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('posX').value = e.latlng.lat;
        document.getElementById('posY').value = e.latlng.lng;
    });

    // Ajouter le contrôle de recherche
    const provider = new window.GeoSearch.OpenStreetMapProvider();
    const searchControl = new window.GeoSearch.GeoSearchControl({
        provider: provider,
        style: 'bar',
        autoComplete: true,
        autoCompleteDelay: 250,
        showMarker: false,
        retainZoomLevel: false,
        animateZoom: true,
        keepResult: true
    });

    map.addControl(searchControl);

    // Gestionnaire d'événements de recherche
    map.on('geosearch/showlocation', function(e) {
        var position = e.location;
        marker.setLatLng([position.y, position.x]);
        document.getElementById('posX').value = position.y;
        document.getElementById('posY').value = position.x;
        map.setView([position.y, position.x], 14); // Zoomer sur la position trouvée
    });

    // Getion des images
    function previewImage(input, imgId) {
        var preview = document.getElementById(imgId);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Afficher l'image prévisualisée
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection