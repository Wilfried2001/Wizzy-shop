<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory; // Permet d'utiliser des factories pour générer des commandes fictives

    // Champs que l'on peut remplir en masse via un formulaire ou lors de la création du modèle
    protected $fillable = [
        'user_id',           // L'utilisateur qui a passé la commande
        'grand_total',       // Le montant total de la commande
        'payment_method',    // Méthode de paiement utilisée (ex: carte, PayPal...)
        'payment_status',    // Statut du paiement (ex: paid, pending, failed)
        'status',            // Statut général de la commande (ex: processing, shipped, cancelled)
        'currency',          // Devise utilisée (ex: EUR, USD)
        'shipping_amount',   // Montant des frais de livraison
        'shipping_method',   // Méthode de livraison choisie (ex: DHL, Chronopost)
        'notes',             // Notes ou instructions laissées par le client
    ];

    // Une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une commande peut avoir plusieurs articles (OrderItem)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Une commande a une adresse de livraison associée
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}