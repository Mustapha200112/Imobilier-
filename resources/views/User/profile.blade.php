@extends("welcome")
<style>
  
    .profileContainer{
      max-width: 600px;
      margin: auto;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .imageProfil{
      border-radius:50px;
      width: 50% 
    }
  
</style>
@section('content')
    <div class="container profileContainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Profile
                        <div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
                            <form action="{{ route('profile.delet') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete your profile?')">Delete Profile</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right">
                                <label for="name" class="col-form-label">Name:</label>
                            </div>

                            <div class="col-md-6">
                                <p>{{ $user->name }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right">
                                <label for="email" class="col-form-label">Email:</label>
                            </div>

                            <div class="col-md-6">
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right">
                                <label for="phone" class="col-form-label">Phone:</label>
                            </div>

                            <div class="col-md-6">
                                <p>{{ $user->phone }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right">
                                <label for="city" class="col-form-label">City:</label>
                            </div>

                            <div class="col-md-6">
                                <p>{{ $user->city }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right">
                                <label for="address" class="col-form-label">Address:</label>
                            </div>

                            <div class="col-md-6">
                                <p>{{ $user->address }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 text-md-right">
                                <label for="image" class="col-form-label">Profile Picture:</label>
                            </div>

                            <div class="col-md-6">
                                @if ($user->imageProfil)
                                    <img src="{{ $user->imageProfil }}" alt="Profile Picture" class="imageProfil">
                                @else
                                    <p>No profile picture uploaded</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
