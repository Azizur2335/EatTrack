<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Table;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@eattrack.com'], [
            'name'      => 'Admin EatTrack',
            'password'  => Hash::make('password123'),
            'role'      => 'admin',
            'phone'     => '08100000000',
            'is_active' => true,
        ]);

        $owner = User::firstOrCreate(['email' => 'owner@eattrack.com'], [
            'name'      => 'Budi Owner',
            'password'  => Hash::make('password123'),
            'role'      => 'owner',
            'phone'     => '08123456789',
            'is_active' => true,
        ]);

        $customer = User::firstOrCreate(['email' => 'customer@eattrack.com'], [
            'name'      => 'Jijur Customer',
            'password'  => Hash::make('password123'),
            'role'      => 'customer',
            'phone'     => '08987654321',
            'is_active' => true,
        ]);

        $restaurant = Restaurant::firstOrCreate(['owner_id' => $owner->id], [
            'name'        => 'Warung Budi',
            'description' => 'Warung makan enak dan murah.',
            'address'     => 'Jl. Contoh No. 1',
            'city'        => 'Mataram',
            'phone'       => '08123456789',
            'category'    => 'Indonesian',
            'open_time'   => '08:00',
            'close_time'  => '22:00',
            'status'      => 'active',
            'latitude'    => -8.5855,
            'longitude'   => 116.1014,
        ]);

        // Tables
        $tableCapacities = [1 => 2, 2 => 4, 3 => 4, 4 => 6, 5 => 8];
        for ($i = 1; $i <= 5; $i++) {
            Table::firstOrCreate(
                ['restaurant_id' => $restaurant->id, 'table_number' => 'Meja ' . $i],
                ['capacity' => $tableCapacities[$i], 'status' => 'available']
            );
        }

        $menus = [
            ['name' => 'Nasi Goreng',   'price' => 15000, 'category' => 'makanan'],
            ['name' => 'Mie Goreng',    'price' => 13000, 'category' => 'makanan'],
            ['name' => 'Es Teh Manis',  'price' => 5000,  'category' => 'minuman'],
            ['name' => 'Es Jeruk',      'price' => 6000,  'category' => 'minuman'],
            ['name' => 'Pudding Coklat','price' => 8000,  'category' => 'dessert'],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate(
                ['restaurant_id' => $restaurant->id, 'name' => $menu['name']],
                [
                    'price'        => $menu['price'],
                    'category'     => $menu['category'],
                    'is_available' => true,
                ]
            );
        }

        $table = Table::where('restaurant_id', $restaurant->id)->first();

        Reservation::firstOrCreate(
            [
                'customer_id'   => $customer->id,
                'restaurant_id' => $restaurant->id,
                'date'          => now()->addDays(2)->toDateString(),
                'time'          => '19:00:00',
            ],
            [
                'table_id'    => $table->id,
                'guest_count' => 2,
                'status'      => 'pending',
                'notes'       => 'Meja dekat jendela kalau bisa.',
            ]
        );
    }
}