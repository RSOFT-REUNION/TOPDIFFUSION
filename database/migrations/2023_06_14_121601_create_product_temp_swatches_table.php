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
        Schema::create('product_temp_swatches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('product_temps', 'id');
            $table->integer('type')->default(1);
            $table->string('ugs')->nullable();
            $table->string('ugs_swatch')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('swatch_group_id')->nullable()->constrained('product_group_tags', 'id');
            $table->foreignId('swatch_tags_id')->nullable()->constrained('product_tags', 'id');
            $table->foreignId('kit_id')->nullable()->constrained('kits', 'id');
            $table->foreignId('chain_id')->nullable()->constrained('kits_chains', 'id');
            $table->foreignId('crown_id')->nullable()->constrained('kits_crowns', 'id');
            $table->foreignId('pignons_id')->nullable()->constrained('kits_pignons', 'id');
            $table->string('tire_position')->nullable();
            $table->string('tire_width')->nullable();
            $table->string('tire_height')->nullable();
            $table->string('tire_diameter')->nullable();
            $table->string('tire_charge')->nullable();
            $table->double('price_ht')->nullable();
            $table->double('price_ttc')->nullable();
            $table->boolean('have_tva')->default(1);
            $table->boolean('default_tva')->default(1);
            $table->double('tva_rate')->nullable();
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_temp_swatches');
    }
};
