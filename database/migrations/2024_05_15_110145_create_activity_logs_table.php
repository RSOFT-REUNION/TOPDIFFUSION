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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('key');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->text('error')->nullable();
            $table->integer('severity')->nullable();
            $table->boolean('is_resolved')->default(0);
            $table->boolean('notified')->default(0); // Notification aux admins
            $table->boolean('support_notified')->default(0); // Notification à Rsoft
            $table->boolean('support_2_notified')->default(0); // Notification à Hivedrops
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
