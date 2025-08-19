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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // guest => null
            $table->string('guest_email', 191)->nullable();
            $table->string('status', 20)->index(); // pending|paid|fulfilled|refunded
            $table->integer('total_amount')->default(0);
            $table->string('currency', 3)->default('IDR');
            $table->timestamps();
            $table->index(['created_at']);
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->integer('quantity')->default(1);
            $table->integer('unit_price_amount');
            $table->string('currency', 3)->default('IDR');
            $table->timestamps();
            $table->unique(['order_id', 'product_id']); // Prevent duplicate items in the same order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
