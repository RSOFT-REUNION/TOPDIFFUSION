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
        Schema::table('user_order_items', function (Blueprint $table) {
            $table->foreignId('product_swatch_id')->constrained('my_product_swatches', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_order_items', function (Blueprint $table) {
            //
        });
    }
};