<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('promo_id')->nullable()->after('notes')->constrained('promos')->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['promo_id']);
            $table->dropColumn('promo_id');
        });
    }
};
