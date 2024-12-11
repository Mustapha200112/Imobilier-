<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Annonces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $annoncesProductslider = Annonces::with('user')->orderBy('created_at', 'desc')->get();
        $sliderAnnonces = Annonces::with('user')->orderBy('created_at', 'desc')->take(3)->get();
        $annonces = Annonces::with('user')->orderBy('created_at', 'desc')->skip(3)->paginate(10);
        return view('annonces.index', compact('sliderAnnonces', 'annonces','annoncesProductslider'));
    }

    public function afficheUserAnnonce()
    {
        //
        $userId = auth()->id();

        // Retrieve the announcements for the current user, ordered by creation date, skipping the first 3, and paginated
        $annonces = Annonces::with('user') // Corrected relationship name to 'user' assuming each annonce belongs to one user
                            ->where('users_id', $userId) // Filter by the current user's ID
                            ->orderBy('created_at', 'desc')
                            ->skip(3)
                            ->paginate(10);
        return view('annonces.Liste', compact('annonces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("annonces.store");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'price' => 'required',
            'category' => 'required',
            'image1' => 'image|mimes:jpeg,png,jpg,gif',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image6' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'posX' => 'required',
            'posY' => 'required',
        ]);

        // Enregistrer l'image principale
        $imagePath = $request->file('image')->store('images', 'public'); // Stocker dans public/images

        // Récupérer l'ID de l'utilisateur actuellement authentifié
        $userId = Auth::id();

        // Créer une nouvelle instance de modèle d'annonce avec les données validées
        $annonce = new Annonces();
        $annonce->title = $validatedData['title'];
        $annonce->description = $validatedData['description'];
        $annonce->price = $validatedData['price'];
        $annonce->category = $validatedData['category'];
        $annonce->image = $imagePath; // Lien de stockage relatif dans 'public/images'
        $annonce->posX = $validatedData['posX'];
        $annonce->posY = $validatedData['posY'];
        $annonce->users_id = $userId; // Enregistrement de l'ID de l'utilisateur

        // Enregistrer les autres images si elles existent
        $annonce->image1 = $request->file('image1') ? $request->file('image1')->store('images', 'public') : null;
        $annonce->image2 = $request->file('image2') ? $request->file('image2')->store('images', 'public') : null;
        $annonce->image3 = $request->file('image3') ? $request->file('image3')->store('images', 'public') : null;
        $annonce->image4 = $request->file('image4') ? $request->file('image4')->store('images', 'public') : null;
        $annonce->image5 = $request->file('image5') ? $request->file('image5')->store('images', 'public') : null;
        $annonce->image6 = $request->file('image6') ? $request->file('image6')->store('images', 'public') : null;

        // Enregistrer l'annonce dans la base de données
        $annonce->save();

        // Rediriger vers une autre page après avoir enregistré l'annonce
        $annoncesProductslider = Annonces::with('user')->orderBy('created_at', 'desc')->get();

        $sliderAnnonces = Annonces::with('user')->orderBy('created_at', 'desc')->take(3)->get();
        $annonces = Annonces::with('user')->orderBy('created_at', 'desc')->skip(3)->paginate(10);
        return view('annonces.index', compact('sliderAnnonces', 'annonces','annoncesProductslider'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $annonce = Annonces::with("user")->findOrFail($id);
        return view('annonces.show', compact('annonce'));
    }

    public function edit(string $id)
    {
        $annonce = Annonces::findOrFail($id);
        return view('annonces.edit', compact('annonce'));
    }

    public function update(Request $request, string $id)
    {
        $annonce = Annonces::findOrFail($id);

        // Valider les données du formulaire
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'posX' => 'required',
            'posY' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'image1' => 'image|mimes:jpeg,png,jpg,gif',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image6' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mettre à jour les données de l'annonce
        $annonce->title = $validatedData['title'];
        $annonce->description = $validatedData['description'];
        $annonce->price = $validatedData['price'];
        $annonce->category = $validatedData['category'];
        $annonce->posX = $validatedData['posX'];
        $annonce->posY = $validatedData['posY'];

        // Si une nouvelle image principale est téléchargée, la remplacer
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $annonce->image = $imagePath;
        }

        // Mettre à jour les autres images si elles sont fournies
        $annonce->image1 = $request->file('image1') ? $request->file('image1')->store('images', 'public') : $annonce->image1;
        $annonce->image2 = $request->file('image2') ? $request->file('image2')->store('images', 'public') : $annonce->image2;
        $annonce->image3 = $request->file('image3') ? $request->file('image3')->store('images', 'public') : $annonce->image3;
        $annonce->image4 = $request->file('image4') ? $request->file('image4')->store('images', 'public') : $annonce->image4;
        $annonce->image5 = $request->file('image5') ? $request->file('image5')->store('images', 'public') : $annonce->image5;
        $annonce->image6 = $request->file('image6') ? $request->file('image6')->store('images', 'public') : $annonce->image6;

        // Sauvegarder les modifications
        $annonce->save();

        // Rediriger l'utilisateur vers une autre page après avoir enregistré l'annonce
        $annoncesProductslider = Annonces::with('user')->orderBy('created_at', 'desc')->get();

        $sliderAnnonces = Annonces::with('user')->orderBy('created_at', 'desc')->take(3)->get();
        $annonces = Annonces::with('user')->orderBy('created_at', 'desc')->skip(3)->paginate(10);
        return view('annonces.index', compact('sliderAnnonces', 'annonces','annoncesProductslider'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $annonce = Annonces::findOrFail($id);
        $annonce->delete();

        // Redirection après la suppression
        $annoncesProductslider = Annonces::with('user')->orderBy('created_at', 'desc')->get();

        return redirect()->route('home');
    }
}
