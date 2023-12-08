<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relais_points', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du point relais
            $table->text('address'); // Adresse du point relais
            $table->text('opening_hours'); // Horaires d'ouverture
            $table->boolean('available')->default(true); // Statut de disponibilité
            $table->string('contact_phone')->nullable(); // Numéro de téléphone de contact
            $table->string('contact_email')->nullable(); // Adresse e-mail de contact
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relais_points');
    }
};
