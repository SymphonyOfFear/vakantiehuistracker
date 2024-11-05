<?php

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('password can be updated', function () {
    $user = User::factory()->create(['password' => bcrypt('old-password')]);

    $response = $this->actingAs($user)->post('/user/password', [
        'current_password' => 'old-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasNoErrors();
    $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
});

test('password cannot be updated with invalid current password', function () {
    $user = User::factory()->create(['password' => bcrypt('old-password')]);

    $response = $this->actingAs($user)->post('/user/password', [
        'current_password' => 'wrong-password',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]);

    $response->assertSessionHasErrors('current_password');
    $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
});
