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
        Schema::create('tva_rates', function (Blueprint $table) {
            $table->id();
            $table->boolean('default')->default(false);
            $table->string('name');
            $table->double('rate');
            $table->string('country');
            $table->string('state');
            $table->timestamps();
        });

        \App\Models\TvaRate::create([
           'default' => true,
            'name' => 'TVA 8,5%',
            'rate' => '8.5',
            'country' => 'RE',
            'state' => '974',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tva_rates');
    }
};