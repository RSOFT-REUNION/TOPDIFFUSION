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
        Schema::create('messages_groups', function (Blueprint $table) {
            $table->id();
            $table->string('sav_number');
            $table->integer('subject')->default(0);
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->string('command_number')->nullable();
            $table->string('subject_other')->nullable();
            $table->text('message');
            $table->integer('state')->default(1);
            $table->boolean('closed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages_groups');
    }
};
