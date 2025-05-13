<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modèle Product représentant un produit dans la boutique
class Product extends Model
{
    use HasFactory; // Permet d'utiliser des factories pour générer des produits fictifs (tests, seeders)

    // Liste des champs pouvant être remplis en masse via create() ou update()
    protected $fillable = [
        'category_id',   // Catégorie à laquelle appartient le produit
        'brand_id',      // Marque associée au produit
        'name',          // Nom du produit
        'slug',          // Slug unique utilisé dans les URLs
        'images',        // Galerie d'images du produit (stockée en format JSON)
        'description',   // Description détaillée du produit
        'price',         // Prix unitaire du produit
        'is_active',     // Le produit est-il actif (visible) ?
        'is_feature',    // Produit en vedette ?
        'in_stock',      // Est-il en stock ?
        'on_sale',       // Est-il en promotion ?
    ];

    // Caste le champ "images" pour qu’il soit automatiquement converti en tableau (array)
    protected $casts = [
        'images' => 'array',
    ];

    // Relation : un produit appartient à une catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation : un produit appartient à une marque
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relation : un produit peut apparaître dans plusieurs lignes de commande
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}