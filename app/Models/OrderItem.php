<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modèle OrderItem représentant un article (produit) dans une commande
class OrderItem extends Model
{
    use HasFactory; // Active les model factories pour générer des articles de commande fictifs (utile pour les tests ou les seeders)

    // Champs que l'on peut remplir en masse lors de la création ou de la mise à jour du modèle
    protected $fillable = [
        'order_id',      // ID de la commande associée
        'product_id',    // ID du produit commandé
        'quantity',      // Quantité commandée de ce produit
        'unit_amount',   // Prix unitaire du produit au moment de la commande
        'total_amount'   // Prix total (unit_amount * quantity)
    ];

    // Un article appartient à une commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Un article est lié à un produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}