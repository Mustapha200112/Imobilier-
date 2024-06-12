<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 56px; /* Hauteur de la navbar fixe */
        }
        /* Navbar styles */
        .navbar {
            background-color: #2c3e50; /* Couleur de fond similaire à l'image */
            height: 10%;
            
        }

        .navbar-brand img {
            width: 10%; /* Ajuster la taille de l'image du logo si nécessaire */
            height: auto;
            border-radius: 50%
        }

        .navbar-nav .nav-link {
            color: #ffffff !important; /* Couleur du texte blanc */
            margin: 0 15px; /* Espacement entre les liens */
        }

        .navbar-nav .nav-link:hover {
            color: #1abc9c !important; /* Couleur de survol */
            text-decoration: none;
        }

        .nav-item.active .nav-link {
            background-color: #1abc9c; /* Couleur de fond pour l'élément actif */
            border-radius: 20px; /* Pour les bords arrondis */
            padding: 10px 20px; /* Pour un peu de padding */
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            color: #fff;
        }


        /* Footer styles */
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            margin-top: auto;
        }

        footer p {
            margin: 0;
        }

        .footer-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 20px;
        }

        .footer-icons a:hover {
            color: #f8f9fa;
        }
        .carousel-control-prev-icon,
      .carousel-control-next-icon {
      background-color: black !important; /* Couleur noire */
      width: 20%;
      height: 20%;
      border-radius: 50%
  }
  .tm{
    width: 34%!important;
    height: 7% !important;
  }
      

  

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="{{ Route('home') }}">
            <img src="{{ asset('2.png') }}" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item {{ Route::currentRouteName() == 'login' ? 'active' : '' }} "><a class="nav-link text-decoration-none" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }} "><a class="nav-link text-decoration-none" href="{{ route('register') }}">Register</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }} "><a class="nav-link text-decoration-none" href="{{ Route('home') }}">Accueil</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}"><a class="nav-link text-decoration-none" href="{{ route('contact') }}">Contact</a></li>
                @else
                    <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }} "><a class="nav-link text-decoration-none" href="{{ Route('home') }}">Accueil</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'annonces.create' ? 'active' : '' }} "><a class="nav-link text-decoration-none" href="{{ Route('annonces.create') }}">Ajouter</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'Liste' ? 'active' : '' }} "><a class="nav-link text-decoration-none" href="{{ Route('Liste') }}">Liste</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }} "><a class="nav-link text-decoration-none" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"><a class="nav-link text-decoration-none" href="{{ route('profile') }}">Profil</a></li>
                    <li class="nav-item {{ Route::currentRouteName() == 'logout' ? 'active' : '' }}"><a class="nav-link text-decoration-none" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </nav>

    @yield("content")

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 ImmoSite. Tous droits réservés.</p>
            <div class="footer-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Font Awesome for social icons -->
</body>
</html>
