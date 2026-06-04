<?php

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\User;
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->customer = User::factory()->create(['role' => 'customer', 'is_active' => true]);
    $this->owner    = User::factory()->create(['role' => 'owner', 'is_active' => true]);

    $this->restaurant = Restaurant::create([
        'owner_id' => $this->owner->id,
        'name'     => 'Test Resto',
        'address'  => 'Jl. Test',
        'category' => 'Indonesian',
        'status'   => 'active',
    ]);

    $this->table = Table::create([
        'restaurant_id' => $this->restaurant->id,
        'table_number'  => 'Meja 1',
        'capacity'      => 4,
        'status'        => 'available',
    ]);
});

test('customer bisa buat reservasi', function () {
    $this->actingAs($this->customer)
        ->post('/reservasi', [
            'restaurant_id' => $this->restaurant->id,
            'table_id'      => $this->table->id,
            'date'          => now()->addDays(1)->toDateString(),
            'time'          => '19:00',
            'guest_count'   => 2,
        ])
        ->assertRedirect('/reservasi');

    $this->assertDatabaseHas('reservations', [
        'customer_id' => $this->customer->id,
        'table_id'    => $this->table->id,
        'status'      => 'pending',
    ]);
});

test('double booking dicegah', function () {
    Reservation::create([
        'customer_id'   => $this->customer->id,
        'restaurant_id' => $this->restaurant->id,
        'table_id'      => $this->table->id,
        'date'          => now()->addDays(1)->toDateString(),
        'time'          => '19:00:00',
        'guest_count'   => 2,
        'status'        => 'pending',
    ]);

    $this->actingAs($this->customer)
        ->post('/reservasi', [
            'restaurant_id' => $this->restaurant->id,
            'table_id'      => $this->table->id,
            'date'          => now()->addDays(1)->toDateString(),
            'time'          => '19:00',
            'guest_count'   => 2,
        ])
        ->assertSessionHasErrors('table_id');
});

test('customer hanya bisa batalkan reservasi miliknya sendiri', function () {
    $reservasi = Reservation::create([
        'customer_id'   => $this->customer->id,
        'restaurant_id' => $this->restaurant->id,
        'table_id'      => $this->table->id,
        'date'          => now()->addDays(1)->toDateString(),
        'time'          => '19:00:00',
        'guest_count'   => 2,
        'status'        => 'pending',
    ]);

    $otherCustomer = User::factory()->create(['role' => 'customer', 'is_active' => true]);

    $this->actingAs($otherCustomer)
        ->patch("/reservasi/{$reservasi->id}/cancel")
        ->assertStatus(404);
});

test('owner bisa konfirmasi reservasi', function () {
    $reservasi = Reservation::create([
        'customer_id'   => $this->customer->id,
        'restaurant_id' => $this->restaurant->id,
        'table_id'      => $this->table->id,
        'date'          => now()->addDays(1)->toDateString(),
        'time'          => '19:00:00',
        'guest_count'   => 2,
        'status'        => 'pending',
    ]);

    $this->actingAs($this->owner)
        ->patch("/konfirmasi_book/{$reservasi->id}/konfirmasi")
        ->assertRedirect('/konfirmasi_book');

    $this->assertDatabaseHas('reservations', [
        'id'     => $reservasi->id,
        'status' => 'confirmed',
    ]);

    $this->assertDatabaseHas('tables', [
        'id'     => $this->table->id,
        'status' => 'reserved',
    ]);
});