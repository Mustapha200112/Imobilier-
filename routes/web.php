<?php

use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route pour la page de contact
Route::get('/contact', function() {
    return view('contact');
})->name('contact');

// Routes pour l'authentification
Auth::routes();

// Route vers la page d'accueil
Route::get('/', [AnnonceController::class, 'index'])->name('home');


// Routes pour les annonces, protégées par le middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::resource('annonces', AnnonceController::class)->except(['index', 'show']);
    Route::get('annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
    Route::post('annonces', [AnnonceController::class, 'store'])->name('annonces.store');
    Route::get('annonces/Liste', [AnnonceController::class, 'afficheUserAnnonce'])->name('Liste');
    Route::get('annonces/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('annonces/{id}', [AnnonceController::class, 'update'])->name('annonces.update');
    Route::delete('annonces/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');

});

// Route pour afficher une annonce (publique)
Route::get('annonces/{id}', [AnnonceController::class, 'show'])->name('annonces.show');

use App\Http\Controllers\UserController;

// Routes pour le profil utilisateur
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/delet', [UserController::class, 'deleteAccount'])->name('profile.delet');
