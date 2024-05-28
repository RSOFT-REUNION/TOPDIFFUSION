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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('slug')->unique();
            $table->string('name');
            $table->foreignId('brand_id')->constrained('product_brands', 'id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('product_categories', 'id')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('cover')->nullable();
            $table->timestamps();
        });

        Schema::create('product_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('type')->default(0); // 0: Produit simple, 1: Produit variable
            $table->string('ugs_code');
            $table->string('ugs_code_variant')->nullable();
            $table->string('color_name')->nullable();
            $table->string('color')->nullable();
            $table->string('size_name')->nullable();
            $table->string('size')->nullable();
            $table->string('kit_element')->nullable();
            $table->double('price_unit');
            $table->integer('stock_state')->default(0); // 0: En stock, 1: En rupture de stock, 2: Stock faible
            $table->timestamps();
        });

        Schema::create('product_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_bikes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('bike_id')->constrained('bikes', 'id')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variant_id')->constrained('product_data', 'id')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
