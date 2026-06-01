<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->string('city')->nullable()->after('address');
            $table->string('maps_link')->nullable()->after('longitude');
            $table->time('open_time')->nullable()->after('maps_link');
            $table->time('close_time')->nullable()->after('open_time');
        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn(['category', 'city', 'maps_link', 'open_time', 'close_time']);
        });
    }
};
