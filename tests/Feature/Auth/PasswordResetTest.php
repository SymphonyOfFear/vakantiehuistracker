<?php

use App\Models\Role;
use App\Models\User;
use Database\Factories\RoleFactory;

test('reset password link screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

test('reset password link can be requested', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id]);

    $response = $this->post('/forgot-password', [
        'email' => $user->email,
    ]);

    $response->assertStatus(302); // Change 200 to 302 since redirects are typical for form submission
});

test('reset password screen can be rendered', function () {
    $response = $this->get('/reset-password/token');

    $response->assertStatus(200);
});

test('password can be reset with valid token', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id]);

    $response = $this->post('/reset-password', [
        'token' => 'valid-token',
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertRedirect(route('dashboard'));
});
