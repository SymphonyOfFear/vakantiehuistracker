<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can login with correct credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password')
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password'
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});

test('user cannot login with incorrect credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password')
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password'
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});
