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
        Schema::create('user_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('product_id')->constrained('my_products', 'id')->onDelete('cascade');
            $table->foreignId('swatch_id')->constrained('my_product_swatches', 'id');
            $table->integer('quantity')->default(1);
            $table->integer('state')->default(0); // 0 = En cours, 1 = En attente de paiement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_carts');
    }
};
