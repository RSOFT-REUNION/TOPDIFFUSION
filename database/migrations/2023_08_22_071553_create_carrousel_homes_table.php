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
        Schema::create('carrousel_homes', function (Blueprint $table) {
            $table->id();
            $table->integer('active')->default(1);
            $table->string('key');
            $table->integer('media_id')->constrained('media', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrousel_homes');
    }
};
