<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; // Permet d'utiliser des factories pour générer des catégories fictives

    // Champs que l'on peut remplir en masse via un formulaire ou lors de la création du modèle
    protected $fillable = [
        'name',       // Nom de la catégorie (ex: Électronique, Mode)
        'slug',       // Slug SEO-friendly généré à partir du nom (ex: electronique)
        'image',      // Chemin ou URL de l'image associée à la catégorie
        'is_active',  // Statut d'activation de la catégorie (true = visible)
    ];

    // Une catégorie peut contenir plusieurs produits
    public function products()
    {
        return $this->hasMany(Product::class); // Relation One-to-Many : une catégorie => plusieurs produits
    }
}