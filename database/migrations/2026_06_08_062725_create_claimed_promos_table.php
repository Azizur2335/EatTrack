<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claimed_promos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['promo_id', 'customer_id']); // 1 customer = 1 klaim per promo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claimed_promos');
    }
};