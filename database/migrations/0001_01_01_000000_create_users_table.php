<?php

use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('discount')->default(0.0);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('admin')->default(0);
            $table->integer('type')->default(0); // 0: particulier, 1: professionnel
            $table->foreignId('group_id')->nullable()->constrained('user_groups', 'id');
            $table->string('code')->unique();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('commercial_name')->nullable();
            $table->string('siret');
            $table->string('rcs');
            $table->string('tva')->nullable();
            $table->timestamps();
        });

        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->string('address_bis')->nullable();
            $table->string('zip_code');
            $table->string('city');
            $table->boolean('is_default')->default(0);
            $table->timestamps();
        });

        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('public_price')->default(0);
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Configuration par défaut
        UserGroup::create(['key' => Str::slug('Particulier'), 'name' => 'Particulier', 'description' => 'Il s\'agit du groupe par défaut', 'discount' => 0.0]);
        User::create([
            'admin' => 1,
            'type' => 2,
            'group_id' => 1,
            'code' => 'ADMIN',
            'lastname' => 'Admin',
            'firstname' => 'Admin',
            'email' => 'admin@topdiffusion.test',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
        ]);
        UserSetting::create(['user_id' => 1, 'public_price' => 1]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_groups');
        Schema::dropIfExists('user_companies');
        Schema::dropIfExists('user_settings');
        Schema::dropIfExists('user_addresses');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
