<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->index('status', 'restaurants_status_index');
            $table->index('owner_id', 'restaurants_owner_id_index');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->index('restaurant_id', 'menus_restaurant_id_index');
            $table->index('is_available', 'menus_is_available_index');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->index('customer_id', 'reservations_customer_id_index');
            $table->index('status', 'reservations_status_index');
        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropIndex('restaurants_status_index');
            $table->dropIndex('restaurants_owner_id_index');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropIndex('menus_restaurant_id_index');
            $table->dropIndex('menus_is_available_index');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex('reservations_customer_id_index');
            $table->dropIndex('reservations_status_index');
        });
    }
};
