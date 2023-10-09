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
        Schema::create('category_customer_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_id'); // Référence à la catégorie de produits
            $table->unsignedBigInteger('customer_group_id'); // Référence au groupe de clients
            $table->decimal('discount_percentage', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_customer_group');
    }
};
