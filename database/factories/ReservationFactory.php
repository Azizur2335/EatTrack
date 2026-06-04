<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $restaurant = Restaurant::factory()->create();
        $table      = Table::create([
            'restaurant_id' => $restaurant->id,
            'table_number'  => 'Meja 1',
            'capacity'      => 4,
            'status'        => 'available',
        ]);

        return [
            'customer_id'   => User::factory()->create(['role' => 'customer'])->id,
            'restaurant_id' => $restaurant->id,
            'table_id'      => $table->id,
            'date'          => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'time'          => $this->faker->randomElement(['11:00', '13:00', '17:00', '19:00']),
            'guest_count'   => $this->faker->numberBetween(1, 6),
            'status'        => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'notes'         => $this->faker->optional()->sentence(),
        ];
    }
}