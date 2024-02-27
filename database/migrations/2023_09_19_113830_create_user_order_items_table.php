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
        Schema::create('user_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('user_orders', 'id');
            $table->foreignId('invoice_id')->nullable()->constrained('user_invoices', 'id');
            $table->foreignId('product_id')->constrained('my_products', 'id')->onDelete('cascade');
            $table->foreignId('product_swatch_id')->constrained('my_product_swatches', 'id')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->double('product_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_order_items');
    }
};
