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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('verified')->default(1);
            $table->timestamp('verified_at')->nullable();
            $table->boolean('professionnal')->default(0);
            $table->integer('grade')->default(1);
            $table->boolean('team')->default(0);
            $table->integer('team_grade')->default(0);
            $table->integer('group_user')->default(1);
            $table->boolean('rsoft_team')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
