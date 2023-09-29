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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('messages_groups', 'id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->text('message');
            $table->timestamp('reply_at')->nullable();
            $table->foreignId('reply_by')->nullable()->constrained('users', 'id');
            $table->integer('state')->default(1);
            $table->boolean('closed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
