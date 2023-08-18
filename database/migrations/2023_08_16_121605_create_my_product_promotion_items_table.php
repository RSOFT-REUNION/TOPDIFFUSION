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
        Schema::create('my_product_promotion_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('my_product_promotions', 'id');
            $table->foreignId('product_id')->constrained('my_products', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_product_promotion_items');
    }
};