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
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('state')->default(1);
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('delivery_point')->nullable()->constrained('delivery_point', 'id');
            $table->string('document_number');
            $table->integer('total_product')->default(1);
            $table->integer('payment_type')->default(1); // 1 = Paiement par carte; 2 = Paiement par chèque; 3 : Paiement par virement
            $table->double('total_ship');
            $table->double('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_orders');
    }
};
