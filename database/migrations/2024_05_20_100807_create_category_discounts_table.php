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
        Schema::create('category_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('product_categories', 'id')->onDelete('cascade');
            $table->foreignId('user_group_id')->constrained('user_groups', 'id')->onDelete('cascade');
            $table->double('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_discounts');
    }
};
