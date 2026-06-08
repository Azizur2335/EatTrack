<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->integer('minimal_tamu')->nullable()->after('discount');
            $table->integer('kuota_total')->nullable()->after('minimal_tamu');
            $table->integer('kuota_terpakai')->default(0)->after('kuota_total');
            $table->string('banner')->nullable()->after('kuota_terpakai');
        });
    }

    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn(['minimal_tamu', 'kuota_total', 'kuota_terpakai', 'banner']);
        });
    }
};