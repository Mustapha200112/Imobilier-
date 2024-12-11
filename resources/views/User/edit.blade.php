@extends("welcome")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier le profil</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Champ Nom -->
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nom :</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ Email -->
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email :</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ Téléphone -->
                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Téléphone :</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ Ville -->
                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-right">Ville :</label>
                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->city }}">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Champ Adresse -->
                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Adresse :</label>
                                <div class="col-md-6">
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="3">{{ $user->address }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                           <!-- Champ Image Profil -->
<div class="row mb-3">
    <label for="imageProfil" class="col-md-4 col-form-label text-md-right">Image de profil :</label>
    <div class="col-md-6">
        <!-- Input file avec événement onchange pour prévisualisation -->
        <input id="imageProfil" type="file" class="form-control @error('imageProfil') is-invalid @enderror" 
               name="imageProfil" onchange="previewImage(this, 'imagePreview')">

        <!-- Image actuelle ou placeholder -->
        @if($user->imageProfil)
            <small class="d-block mt-2">Image actuelle :</small>
            <img id="imagePreview" src="{{ asset('storage/imagesProfils/' . basename($user->imageProfil)) }}" 
                 alt="Image Profil" class="img-thumbnail" width="100">
        @else
            <!-- Placeholder si aucune image n'existe -->
            <img id="imagePreview" src="{{ asset('default-placeholder-image.png') }}" 
                 alt="Aucune image" class="img-thumbnail" width="100">
        @endif

        <!-- Gestion des erreurs -->
        @error('imageProfil')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

                            <!-- Bouton Enregistrer -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(input, imgId) {
            var preview = document.getElementById(imgId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    
    
@endsection
