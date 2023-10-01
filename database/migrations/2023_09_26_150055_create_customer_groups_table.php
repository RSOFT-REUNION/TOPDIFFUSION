<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom du groupe de clients
            $table->decimal('discount_percentage', 5, 2); // Pourcentage de remise par catégorie
            $table->boolean('is_default')->default(0); // Colonne pour indiquer si le groupe est par défaut (0 ou 1)
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_groups');
    }
};
