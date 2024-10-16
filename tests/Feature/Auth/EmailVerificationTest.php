<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;

uses(RefreshDatabase::class);

test('email verification screen can be rendered', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id, 'email_verified_at' => null]);

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertStatus(200);
});

test('email can be verified', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id, 'email_verified_at' => null]);

    $verificationUrl = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), ['id' => $user->id, 'hash' => sha1($user->email)]);

    $response = $this->actingAs($user)->get($verificationUrl);

    $response->assertRedirect('');
    $this->assertTrue($user->fresh()->hasVerifiedEmail());
});

test('email is not verified with invalid hash', function () {
    $role = Role::factory()->create(['name' => 'huurder']);
    $user = User::factory()->create(['role_id' => $role->id, 'email_verified_at' => null]);

    $verificationUrl = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), ['id' => $user->id, 'hash' => 'wrong-hash']);

    $this->actingAs($user)->get($verificationUrl);

    $this->assertFalse($user->fresh()->hasVerifiedEmail());
});
