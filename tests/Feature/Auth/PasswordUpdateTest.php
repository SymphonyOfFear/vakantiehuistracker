<?php

use App\Models\Role;
use App\Models\User;



test('password can be updated', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['password' => bcrypt('password'), 'role_id' => $role->id]);

    $response = $this->actingAs($user)->put('/user/password', [
        'current_password' => 'password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect(route('dashboard'));
});

test('correct password must be provided to update password', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['password' => bcrypt('password'), 'role_id' => $role->id]);

    $response = $this->actingAs($user)->put('/user/password', [
        'current_password' => 'wrong-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors();
});
