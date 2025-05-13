<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration pour créer la table "order_items".
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            // Crée une colonne 'id' auto-incrémentée comme clé primaire
            $table->id();

            // Crée une colonne 'order_id' qui est une clé étrangère pointant vers la table 'orders'
            // En cas de suppression d'une commande, tous les éléments associés seront supprimés (cascadeOnDelete)
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();

            // Crée une colonne 'product_id' qui est une clé étrangère pointant vers la table 'products'
            // En cas de suppression d'un produit, tous les éléments associés seront supprimés (cascadeOnDelete)
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();

            // Crée une colonne 'quantity' pour stocker la quantité d'un produit dans la commande
            // La valeur par défaut est 1
            $table->integer('quantity')->default(1);

            // Crée une colonne 'unit_amount' pour stocker le prix unitaire du produit
            // Ce champ peut être nul, utile pour les produits ayant des prix variables
            $table->decimal('unit_amount', 10, 2)->nullable();

            // Crée une colonne 'total_amount' pour stocker le montant total de cet article dans la commande
            // Ce champ peut être nul
            $table->decimal('total_amount', 10, 2)->nullable();

            // Crée les colonnes 'created_at' et 'updated_at' pour suivre les dates de création et de mise à jour des éléments de la commande
            $table->timestamps();
        });
    }

    /**
     * Annule la migration en supprimant la table "order_items".
     */
    public function down(): void
    {
        // Supprime la table "order_items" si elle existe
        Schema::dropIfExists('order_items');
    }
};