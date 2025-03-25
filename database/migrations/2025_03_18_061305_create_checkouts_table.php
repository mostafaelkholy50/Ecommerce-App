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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();;
            $table->string('Address');
            $table->string('Phone')->unique();
            $table->enum('payment_method', ['fawry', 'cash_on_delivery'])->default('cash_on_delivery');
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->enum('shipping_status', ['pending', 'shipped', 'delivered'])->default('pending');
            $table->decimal('total_price', 10, 2)->default(0);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
