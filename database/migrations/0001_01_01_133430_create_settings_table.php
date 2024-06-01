<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        $settings = [
            ['key' => 'active', 'value' => '0'],
            ['key' => 'payment', 'value' => '0'],
            ['key' => 'payment_TTC', 'value' => '0'],
            ['key' => 'show_TTC', 'value' => '0'],
            ['key' => 'shipping', 'value' => '0'],
            // Ajoutez autant de lignes que nécessaire
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
