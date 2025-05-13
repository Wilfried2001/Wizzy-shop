<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration pour créer la table "orders".
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            // Crée une colonne 'id' auto-incrémentée comme clé primaire
            $table->id();

            // Crée une colonne 'user_id' qui est une clé étrangère pointant vers la table 'users'
            // En cas de suppression d'un utilisateur, toutes les commandes associées seront supprimées (cascadeOnDelete)
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            // Crée une colonne 'grand_total' pour stocker le montant total de la commande
            // Le type 'decimal' permet de gérer les valeurs monétaires avec 10 chiffres au total et 2 décimales
            $table->decimal('grand_total', 10, 2);

            // Crée une colonne 'payment_method' pour enregistrer la méthode de paiement utilisée (ex : carte, PayPal)
            $table->string('payment_method');

            // Crée une colonne 'payment_status' pour indiquer le statut du paiement (ex : payé, en attente, échoué)
            $table->string('payment_status');

            // Crée une colonne 'status' pour suivre l'état de la commande, avec des valeurs prédéfinies
            // La valeur par défaut est 'new' (nouvelle commande)
            $table->enum('status', ['new', 'processing', 'shipped', 'delivered', 'cancelled'])->default('new');

            // Crée une colonne 'currency' pour indiquer la devise utilisée (ex : EUR, USD)
            // Cette colonne peut être vide (nullable)
            $table->string('currency')->nullable();

            // Crée une colonne 'shipping_amount' pour enregistrer le montant des frais de livraison
            // Cette colonne peut être vide (nullable)
            $table->decimal('shipping_amount', 10, 2)->nullable();

            // Crée une colonne 'shipping_method' pour enregistrer la méthode de livraison choisie (ex : DHL, Chronopost)
            // Cette colonne peut être vide (nullable)
            $table->string('shipping_method')->nullable();

            // Crée une colonne 'notes' pour stocker des notes supplémentaires ou des instructions laissées par le client
            // Cette colonne peut être vide (nullable)
            $table->text('notes')->nullable();

            // Crée les colonnes 'created_at' et 'updated_at' pour suivre les dates de création et de mise à jour de la commande
            $table->timestamps();
        });
    }

    /**
     * Annule la migration en supprimant la table "orders".
     */
    public function down(): void
    {
        // Supprime la table "orders" si elle existe
        Schema::dropIfExists('orders');
    }
};