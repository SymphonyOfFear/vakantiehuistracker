<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('profile page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/profile');

    $response->assertStatus(200);
});

test('user can update profile information', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->put('/profile', [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'current_password' => 'password', // Assuming password is set to 'password' in UserFactory
    ]);

    $response->assertRedirect('/profile');
    $this->assertEquals('Updated Name', $user->fresh()->name);
    $this->assertEquals('updated@example.com', $user->fresh()->email);
});
