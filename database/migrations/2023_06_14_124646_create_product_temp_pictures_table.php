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
        Schema::create('product_temp_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('product_temps', 'id')->onDelete('cascade');
            $table->string('picture_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_temp_pictures');
    }
};
