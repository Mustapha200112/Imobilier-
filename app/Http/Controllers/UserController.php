<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Annonces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Afficher le profil de l'utilisateur connecté.
     */
    public function profile()
    {
        $user = Auth::user();
        return view("User.profile", compact("user"));
    }

    /**
     * Afficher le formulaire de modification du profil de l'utilisateur.
     */
    public function editProfile()
    {
        $user = Auth::user(); // Récupérer l'utilisateur authentifié
        return view("User.edit", compact("user"));
    }

    /**
     * Mettre à jour le profil de l'utilisateur.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validation des données entrées
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'imageProfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Limite à 2MB
        ]);

        // Mettre à jour les informations textuelles
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $request->input('phone');
        $user->city = $request->input('city');
        $user->address = $request->input('address');

        // Gestion de l'image
        if ($request->hasFile('imageProfil')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->imageProfil) {
                Storage::delete('public/imagesProfils/' . basename($user->imageProfil));
            }

            // Sauvegarder la nouvelle image
            $path = $request->file('imageProfil')->store('imagesProfils', 'public');
            $user->imageProfil = $path;
            
        }

        // Sauvegarder les modifications
        $user->save();

        // Rediriger vers la page de profil avec un message de succès
        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Supprimer le compte de l'utilisateur.
     */
    public function deleteAccount()
    {
        $user = Auth::user();

        // Supprimer les annonces de l'utilisateur
        $user->annonces()->delete();

        // Supprimer l'image de profil si elle existe
        if ($user->imageProfil) {
            Storage::delete('public/' . $user->imageProfil);
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Rediriger vers une page d'accueil ou de confirmation
        $sliderAnnonces = Annonces::with('user')->orderBy('created_at', 'desc')->take(3)->get();
        $annonces = Annonces::with('user')->orderBy('created_at', 'desc')->skip(3)->paginate(10);
        
        return redirect()->route('home')->with(compact('sliderAnnonces', 'annonces'))
            ->with('success', 'Compte supprimé avec succès.');
    }
}
