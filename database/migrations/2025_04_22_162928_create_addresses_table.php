<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration pour créer la table "addresses".
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            // Crée une colonne 'id' auto-incrémentée comme clé primaire
            $table->id();

            // Crée une colonne 'order_id' qui est une clé étrangère pointant vers la table 'orders'
            // En cas de suppression d'une commande, l'adresse associée sera également supprimée (cascadeOnDelete)
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();

            // Crée une colonne 'first_name' pour stocker le prénom du destinataire
            $table->string('first_name')->nullable();

            // Crée une colonne 'last_name' pour stocker le nom de famille du destinataire
            $table->string('last_name')->nullable();

            // Crée une colonne 'phone' pour stocker le numéro de téléphone du destinataire
            $table->string('phone')->nullable();

            // Crée une colonne 'street_address' pour stocker l'adresse de rue
            $table->string('street_address')->nullable();

            // Crée une colonne 'city' pour stocker la ville du destinataire
            $table->string('city')->nullable();

            // Crée une colonne 'state' pour stocker l'état ou la région du destinataire
            $table->string('state')->nullable();

            // Crée une colonne 'country' pour stocker le pays du destinataire
            $table->string('country')->nullable();

            // Crée une colonne 'zip_code' pour stocker le code postal du destinataire
            $table->string('zip_code')->nullable();

            // Crée les colonnes 'created_at' et 'updated_at' pour suivre les dates de création et de mise à jour de l'adresse
            $table->timestamps();
        });
    }

    /**
     * Annule la migration en supprimant la table "addresses".
     */
    public function down(): void
    {
        // Supprime la table "addresses" si elle existe
        Schema::dropIfExists('addresses');
    }
};