<?php

use App\Models\User;

test('user bisa login dengan username', function () {
    $user = User::factory()->create([
        'role'      => 'customer',
        'is_active' => true,
        'password'  => bcrypt('password123'),
    ]);

    $this->post('/login', [
        'username' => $user->name,
        'password' => 'password123',
    ])->assertRedirect('/beranda');
});

test('user bisa login dengan email', function () {
    $user = User::factory()->create([
        'role'      => 'customer',
        'is_active' => true,
        'password'  => bcrypt('password123'),
    ]);

    $this->post('/login', [
        'username' => $user->email,
        'password' => 'password123',
    ])->assertRedirect('/beranda');
});

test('user yang di-ban tidak bisa login', function () {
    $user = User::factory()->create([
        'role'      => 'customer',
        'is_active' => false,
        'password'  => bcrypt('password123'),
    ]);

    $this->post('/login', [
        'username' => $user->email,
        'password' => 'password123',
    ])->assertSessionHasErrors('username');
});