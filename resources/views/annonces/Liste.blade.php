@extends("welcome")
@section("title","Accueil - Site Immobilier")

@section("content")

<!-- Annonces Section -->
<div class="container my-5">
    @if ($annonces->count() > 0)
    <h4 class="text-center mb-4">Les immobilier disponible</h4>
    @else
    <h4 class="text-center mb-4">Vous n'avez pas des annonces</h4>
    @endif
    @if ($annonces->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Publié par</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($annonces as $annonce)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $annonce->title }}</td>
                    <td>{{ Str::limit($annonce->description, 50) }}</td>
                    <td>{{ $annonce->price }}€</td>
                    <td>{{ $annonce->user->name }}</td>
                    <td>
                        <a href="{{ route('annonces.edit', $annonce->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('annonces.destroy', $annonce->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $annonces->links('vendor.pagination.bootstrap-4') }}
    </div>
    @endif
</div>
@endsection
