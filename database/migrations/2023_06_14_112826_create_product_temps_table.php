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
        Schema::create('product_temps', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('type')->nullable();
            $table->integer('kit_element')->nullable();
            $table->string('cover')->nullable();
            $table->string('slug')->nullable();
            $table->text('long_description')->nullable();
            $table->text('short_description')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_temps');
    }
};
