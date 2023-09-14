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
        Schema::create('my_products', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->integer('state')->default(1); // 1 -> Create; 2 -> Stock out;
            $table->string('title');
            $table->string('slug');
            $table->integer('type')->default(1); // 1 -> Simple Product; 2 -> Swatches Product;
            $table->string('cover')->nullable();
            $table->foreignId('category_id')->constrained('product_categories', 'id');
            $table->foreignId('brand_id')->nullable()->constrained('product_brands', 'id');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_products');
    }
};
