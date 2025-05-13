<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration pour créer la table "categories".
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            // Crée une colonne 'id' auto-incrémentée comme clé primaire
            $table->id();

            // Crée une colonne 'name' pour le nom de la catégorie
            $table->string('name');

            // Crée une colonne 'slug' qui doit être unique pour chaque catégorie
            $table->string('slug')->unique();

            // Crée une colonne 'image' de type texte pour stocker l'URL ou le chemin de l'image de la catégorie
            $table->text('image')->nullable();

            // Crée une colonne 'is_active' pour savoir si la catégorie est active (par défaut, elle est active)
            $table->boolean('is_active')->default(true)->nullable();

            // Crée les colonnes 'created_at' et 'updated_at' pour suivre les dates de création et de mise à jour
            $table->timestamps();
        });
    }

    /**
     * Annule la migration en supprimant la table "categories".
     */
    public function down(): void
    {
        // Supprime la table "categories" si elle existe
        Schema::dropIfExists('categories');
    }
};