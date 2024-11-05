<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('password can be confirmed', function () {
    $user = User::factory()->create(['password' => bcrypt('password')]);

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertStatus(200);
});

test('password cannot be confirmed with invalid password', function () {
    $user = User::factory()->create(['password' => bcrypt('password')]);

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(403);
});
