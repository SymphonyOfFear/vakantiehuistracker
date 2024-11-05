<?php

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('password reset link can be requested', function () {
    // Fake notifications to capture any reset password notifications
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->post('/forgot-password', ['email' => $user->email]);

    // Assert that the status is correct
    $response->assertStatus(200);

    // Assert that a password reset notification was sent to the given user
    Notification::assertSentTo($user, ResetPassword::class);
});