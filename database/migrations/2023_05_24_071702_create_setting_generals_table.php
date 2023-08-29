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
        Schema::create('setting_generals', function (Blueprint $table) {
            $table->id();
            $table->boolean('maintenance_mode')->default(0);
            $table->boolean('development_mode')->default(0);
            $table->string('site_name');
            $table->string('site_logo')->nullable();
            $table->boolean('professionnal_customers')->default(1);
            $table->boolean('favorite')->default(1);
            $table->boolean('catalogue_mode')->default(0);
            $table->integer('prices_type')->default(1);
            $table->boolean('bikes_compatibility')->default(1);
            $table->string('main_email')->nullable();
            $table->string('main_phone')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_insta')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_generals');
    }
};
