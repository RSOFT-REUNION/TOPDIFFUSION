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
        Schema::create('compatible_temp_bikes', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('product_id')->constrained('my_products', 'id');
            $table->foreignId('bike_id')->constrained('bikes', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
