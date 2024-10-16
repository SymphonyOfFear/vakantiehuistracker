<?php

use App\Models\Role;
use App\Models\User;

test('confirm password screen can be rendered', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id]);

    $response = $this->actingAs($user)->get('/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['password' => bcrypt('password'), 'role_id' => $role->id]);

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'));
});

test('password is not confirmed with invalid password', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['password' => bcrypt('password'), 'role_id' => $role->id]);

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
