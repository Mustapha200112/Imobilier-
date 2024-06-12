@extends("welcome")
@section("title","Accueil - Site Immobilier")

<!-- Inclure Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
  /* Ajuster la taille des images du slider principal */
  .carousel-item2 img {
      height: 30rem;
      object-fit: cover;
      
  }
  .Serves img {
      height: 8rem;
      object-fit: fill;
      border-radius: 12%
  }
  .carousel-itemsiez2 img {
      height: 18rem;
      object-fit: cover;
  }
  .carousel-inner12{
    border-radius: 12%
  }
  /* Ajouter une animation sur les cartes */
  .carousel-itemsiez2 img {
      height: 18rem; /* Ajustez cette valeur selon vos besoins */
      object-fit: cover;
  }
  .carousel-itemsiez2 img.rounded {
      border-radius: 15px; /* Ajouter des coins arrondis */
  }
  .carousel-item {
      display: flex;
  }
  
  .product-info {
      text-align: center;
  }


  .slidT img {
      height: 30rem;
      object-fit: fill;
  }
  .intro {
      width: 100%;
      height: 80%;
      position: relative;
      z-index: 10;
      background-attachment: fixed !important;
      background-repeat: no-repeat !important;
      background-position: 50% 50%;
      background-size: cover !important;
      background-image: url("https://th.bing.com/th/id/OIP.9G7B7cLcY3ew9GDRyprgBwHaE7?w=287&h=190&c=7&r=0&o=5&dpr=1.3&pid=1.7");
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      text-align: center;
      padding: 20px;
  }
  .intro-logo {
      max-width: 150px;
      margin-bottom: 20px;
  }
  .intro-title {
      font-size: 2.5rem;
      margin-bottom: 10px;
  }
  .intro-description {
      font-size: 1.25rem;
  }

</style>



@section("content")



    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide co" data-ride="carousel">
      <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
          @foreach($sliderAnnonces as $index => $annonce)
          <div class="slidT carousel-item {{ $index == 0 ? 'active' : '' }}">
            <a href="{{route("annonces.show",$annonce->id)}}" >

              <img class="d-block w-100" src="{{  $annonce->image }}" alt="{{ $annonce->title }}">   
            </a>
              <div class="carousel-caption d-none d-md-block">
                  <h5>{{ $annonce->title }}</h5>
                  <p>{{ Str::limit($annonce->description, 100) }}</p>
              </div>
          </div>
          @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
  </div>





<!-- Product Slider -->
    <div class="container my-5">
        @if ($annonces->count() > 0)
            <h4 class="text-center mb-5 text-primary">Nos Servise</h4>
        @endif
        <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($annonces->chunk(5) as $index => $productChunk)
                    <div class="carousel-item @if($index == 0) active @endif">
                        <div class="d-flex flex-wrap justify-content-between">
                            @foreach ($productChunk as $product)
                                <div class="col-12 col-sm-6 col-md-2 mb-5 Serves">
                                    <img src="{{ $product->image }}" class="d-block w-100" alt="{{ $product->title }}">
                                    <div class="product-info">
                                        <h5 class="text-black">{{ $product->title }}</h5>
                                        <p class="text-black">{{ $product->category }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    
    <div class="Intro"> 

      <img src="{{ asset("2.png") }}" alt="Logo" class="intro-logo">
      <h1 class="intro-title">Bienvenu a nos services</h1>
      <p class="intro-description">Découvrez les meilleurs maison Cher imobilier pplayers</p>

    </div>





    <!-- Annonces Section -->
    <div class="container my-5">
        <h4 class="text-center mb-4 text-primary">Les Imobillers</h4>
        <div class="row">
            @foreach ($annonces as $annonce)
            <div class="col-md-4">
                <a href="{{ route('annonces.show', $annonce->id) }}" class="text-decoration-none">
                    <div class="mb-4">
                        <!-- Ajouter le slider dans la carte -->
                        <div id="carousel-{{ $annonce->id }}" class="carousel slide " data-ride="carousel" data-interval="false">
                            <div class="carousel-inner carousel-inner1 carousel-inner12">
                                <div class="carousel-item active carousel-itemsiez  carousel-itemsiez2 carousel-item2">
                                    <img class="d-block w-100" src="{{ $annonce->image }}" alt="{{ $annonce->title }}">
                                </div>
                                @foreach (range(1, 6) as $i)
                                    @if($annonce->{'image'.$i})
                                    <div class="carousel-item carousel-itemsiez carousel-itemsiez2 carousel-item2">
                                        <img class="d-block w-100" src="{{ $annonce->{'image'.$i} }}" alt="{{ $annonce->title }}">
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- Ajouter les contrôles de navigation -->
                            <a class="carousel-control-prev" href="#carousel-{{ $annonce->id }}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon tm" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-{{ $annonce->id }}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon tm" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body text-dark">
                            <h5 class="card-title">{{ $annonce->title }}</h5>
                            <p class="card-text">{{ Str::limit($annonce->description, 100) }}</p>
                            <p class="card-text"><strong>Prix: {{ $annonce->price }}€</strong></p>
                            <p class="card-text">Publié par: {{ $annonce->user->name }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $annonces->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Désactiver le défilement automatique des sliders d'annonces
        $('.carousel').carousel({
            pause: 'hover'
        });
    });
</script>
@endpush
