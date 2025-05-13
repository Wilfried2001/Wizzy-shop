<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration pour créer la table "brands".
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            // Crée une colonne 'id' auto-incrémentée comme clé primaire
            $table->id();

            // Crée une colonne 'name' pour le nom de la marque
            $table->string('name');

            // Crée une colonne 'slug' qui doit être unique pour chaque marque
            $table->string('slug')->unique();

            // Crée une colonne 'image' de type texte pour stocker l'URL ou le chemin de l'image de la marque
            $table->text('image')->nullable();

            // Crée une colonne 'is_active' pour savoir si la marque est active (par défaut, elle est active)
            $table->boolean('is_active')->default(true);

            // Crée les colonnes 'created_at' et 'updated_at' pour suivre les dates de création et de mise à jour
            $table->timestamps();
        });
    }

    /**
     * Annule la migration en supprimant la table "brands".
     */
    public function down(): void
    {
        // Supprime la table "brands" si elle existe
        Schema::dropIfExists('brands');
    }
};