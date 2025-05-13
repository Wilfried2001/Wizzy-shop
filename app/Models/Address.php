<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modèle Address représentant une adresse de livraison associée à une commande
class Address extends Model
{
    use HasFactory; // Active les model factories pour générer facilement des adresses fictives (utile pour les tests ou le seed)

    // Champs que l'on peut remplir en masse via un formulaire ou lors de la création du modèle
    protected $fillable = [
        'order_id',        // ID de la commande liée à cette adresse
        'first_name',      // Prénom du destinataire
        'last_name',       // Nom de famille du destinataire
        'phone',           // Numéro de téléphone du destinataire
        'street_address',  // Adresse complète (rue, numéro, etc.)
        'city',            // Ville
        'state',           // Région ou département
        'zip_code',        // Code postal
    ];

    // Une adresse appartient à une seule commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Accessor : permet d'accéder à $address->full_name pour obtenir "Prénom Nom"
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}