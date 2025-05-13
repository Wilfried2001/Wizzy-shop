<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration pour créer la table "products".
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // Crée une colonne 'id' auto-incrémentée comme clé primaire
            $table->id();

            // Crée une colonne 'category_id' qui est une clé étrangère pointant vers la table 'categories'
            // En cas de suppression d'une catégorie, les produits associés seront aussi supprimés (cascadeOnDelete)
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            // Crée une colonne 'brand_id' qui est une clé étrangère pointant vers la table 'brands'
            // En cas de suppression d'une marque, les produits associés seront aussi supprimés (cascadeOnDelete)
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();

            // Crée une colonne 'name' pour le nom du produit
            $table->string('name');

            // Crée une colonne 'slug' unique pour chaque produit (généralement utilisée pour les URLs)
            $table->string('slug')->unique();

            // Crée une colonne 'images' de type JSON pour stocker les images associées au produit
            // Cette colonne peut être vide (nullable)
            $table->json('images')->nullable();

            // Crée une colonne 'description' de type longText pour stocker une description détaillée du produit
            // Cette colonne peut être vide (nullable)
            $table->longText('description')->nullable();

            // Crée une colonne 'price' pour le prix du produit avec 10 chiffres au total et 2 décimales
            $table->decimal('price', 10, 2);

            // Crée une colonne 'is_active' pour savoir si le produit est actif (par défaut, il est actif)
            $table->boolean('is_active')->default(true);

            // Crée une colonne 'is_feature' pour savoir si le produit est mis en avant (par défaut, il ne l'est pas)
            $table->boolean('is_feature')->default(false);

            // Crée une colonne 'in_stock' pour savoir si le produit est en stock (par défaut, il est en stock)
            $table->boolean('in_stock')->default(true);

            // Crée une colonne 'on_sale' pour savoir si le produit est en promotion (par défaut, il ne l'est pas)
            $table->boolean('on_sale')->default(false);

            // Crée les colonnes 'created_at' et 'updated_at' pour suivre les dates de création et de mise à jour
            $table->timestamps();
        });
    }

    /**
     * Annule la migration en supprimant la table "products".
     */
    public function down(): void
    {
        // Supprime la table "products" si elle existe
        Schema::dropIfExists('products');
    }
};