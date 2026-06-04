<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'owner_id'    => User::factory()->create(['role' => 'owner'])->id,
            'name'        => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'address'     => $this->faker->address(),
            'city'        => $this->faker->city(),
            'phone'       => $this->faker->phoneNumber(),
            'category'    => $this->faker->randomElement(['Indonesian', 'Chinese', 'Western', 'Japanese']),
            'open_time'   => '08:00',
            'close_time'  => '22:00',
            'status'      => 'active',
        ];
    }
}