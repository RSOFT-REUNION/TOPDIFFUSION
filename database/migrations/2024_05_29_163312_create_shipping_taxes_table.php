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
        Schema::create('shipping_taxes', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->double('max_price');
            $table->timestamps();
        });

        \App\Models\ShippingTaxe::created([
            'amount' => 3.0,
            'max_price' => 50.0,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_taxes');
    }
};
