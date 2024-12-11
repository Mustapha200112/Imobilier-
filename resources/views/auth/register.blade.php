@extends("welcome")
@section("title", "Register")
<style>
  /* Global Styles */
  .login-container {
      max-width: 500px;
      margin: auto;
      background-color: #f9f9f9;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
  }

  .card-header {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
  }

  .form-control {
      border-radius: 20px;
      padding: 15px;
      font-size: 16px;
  }

  .btn-primary {
      border-radius: 20px;
      padding: 15px 30px;
      font-size: 18px;
      font-weight: bold;
      background-color: #007bff;
      border: none;
      width: 100%;
  }

  .btn-primary:hover {
      background-color: #0056b3;
  }

  .invalid-feedback {
      display: block;
      color: red;
      margin-top: 5px;
  }

  label {
      font-weight: bold;
  }

  /* Style for file input */
  .input-file-container {
      position: relative;
      margin-bottom: 20px;
  }

  input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      display: none;
  }

  .file-label {
      background-color: #007bff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
      font-size: 16px;
      width: 100%;
      display: inline-block;
  }

  .file-label:hover {
      background-color: #0056b3;
  }

  .image-preview {
      margin-top: 15px;
      text-align: center;
  }

  .image-preview img {
      border-radius: 50%;
      width: 100px;
      height: 100px;
      object-fit: cover;
      border: 3px solid #007bff;
  }
</style>

@section('content')
<div class="container login-container">
    <div class="card">
        <div class="card-header">{{ __('Register') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-12">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="col-md-12">
                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Image input and preview -->
                <div class="col-md-12 input-file-container">
                    <label for="imageProfil" class="form-label">{{ __('Profile Image') }}</label>
                    <input id="imageProfil" type="file" onchange="previewImage(this, 'imageShow')" class="form-control @error('imageProfil') is-invalid @enderror" name="imageProfil" value="{{ old('imageProfil') }}" required>
                    <label for="imageProfil" class="file-label">{{ __('Choose Image') }}</label>

                    <!-- Affichage de l'image prévisualisée -->
                    <div class="image-preview">
                        <img id="imageShow" src="#" style="display: none" alt="Profile Image">
                    </div>

                    @error('imageProfil')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="city" class="form-label">{{ __('City') }}</label>
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                </div>
            </form>
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
                preview.style.display = 'block'; // Afficher l'image prévisualisée
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
