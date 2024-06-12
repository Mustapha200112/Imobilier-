<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonces extends Model
{
    use HasFactory;

    // Une annonce appartient à un seul utilisateur
    public function user(){
        return $this->belongsTo(User::class,"users_id");
    }

    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'category',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'users_id', // Assurez-vous que cette colonne est incluse dans le tableau fillable
        'posX',
        'posY'
    ];
}