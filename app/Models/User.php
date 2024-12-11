<?php


// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Relation entre un utilisateur et ses annonces
    public function annonces()
    {
        return $this->hasMany(Annonces::class, 'users_id'); // La clé étrangère est 'users_id' dans 'annonces'
    }

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'city', 'address', 'imageProfil',
    ];

    // Autres méthodes et configurations...
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
