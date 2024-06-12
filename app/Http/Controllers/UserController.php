<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Annonces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      $user = auth()->user(); // Récupérer l'utilisateur authentifié
      return view("User.edit", compact("user"));
    }
    
    /**
     * Mettre à jour le profil de l'utilisateur.
     */
    public function updateProfile(Request $request)
    {
        $userUpdate = Auth::user();
        $userUpdate->update($request->all());
        $user = Auth::user();
        return view("User.profile", compact("user"));

    }

    /**
     * Supprimer le compte de l'utilisateur.
     */
    public function deleteAccount()
    {
        $user = Auth::user();
        // Supprimer l'utilisateur et toutes ses données associées
        $user->delete();
                // Rediriger l'utilisateur vers une autre page après avoir enregistré l'annonce
        $sliderAnnonces = Annonces::with('user')->orderBy('created_at', 'desc')->take(3)->get();
        $annonces = Annonces::with('user')->orderBy('created_at', 'desc')->skip(3)->paginate(10);
        return view('annonces.index', compact('sliderAnnonces', 'annonces'));    
    }
}
