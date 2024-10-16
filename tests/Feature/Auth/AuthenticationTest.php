<?php

use App\Models\Role;
use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route(''));
});

test('verhuurder role redirects to verhuurder dashboard after login', function () {
    $role = Role::factory()->create(['name' => 'verhuurder']);
    $user = User::factory()->create(['role_id' => $role->id]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('verhuurder.dashboard'));
});

test('users cannot authenticate with invalid password', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id]);

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('');
});
