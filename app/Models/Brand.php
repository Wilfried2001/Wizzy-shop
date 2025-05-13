<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory; // Permet d'utiliser les factories pour générer des marques fictives pour les tests ou les seeders

    // Champs que l'on peut remplir en masse via un formulaire ou lors de la création du modèle
    protected $fillable = [
        'name',       // Nom de la marque (ex: Nike, Samsung)
        'slug',       // Slug SEO-friendly généré à partir du nom (ex: nike)
        'image',      // Image/logo associé à la marque
        'is_active',  // Statut d'activation de la marque (true = active/affichée)
    ];

    // Une marque peut avoir plusieurs produits associés
    public function products()
    {
        return $this->hasMany(Product::class); // Relation One-to-Many : une marque => plusieurs produits
    }
}