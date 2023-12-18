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
        Schema::create('kit_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('my_product_temps', 'id')->onDelete('cascade');
            $table->string('title');
            $table->string('reference');
            $table->string('description')->nullable();
            $table->boolean('have_tva')->default(1);
            $table->boolean('default_tva')->default(1);
            $table->double('tva_rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kit_temps');
    }
};
