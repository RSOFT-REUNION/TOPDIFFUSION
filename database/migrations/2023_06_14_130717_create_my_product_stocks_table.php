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
        Schema::create('my_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('my_products', 'id');
            $table->foreignId('swatch_id')->nullable()->constrained('my_product_swatches', 'id');
            $table->boolean('is_swatch')->default(0);
            $table->string('ugs');
            $table->integer('quantity');
            $table->timestamp('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_product_stocks');
    }
};
