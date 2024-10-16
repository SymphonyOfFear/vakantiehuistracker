<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function confirm_password_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs(Auth::user())->get('/user/confirm-password');

        $response->assertStatus(200);
    }

    /** @test */
    public function password_can_be_confirmed()
    {
        $user = User::factory()->create();

        // Act as the user before confirming the password
        $response = $this->actingAs(Auth::user())->post('/user/confirm-password', [
            'password' => 'password',
        ]);

        // Ensure no errors
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function password_is_not_confirmed_with_invalid_password()
    {
        $user = User::factory()->create();

        // Act as the user and attempt to confirm the wrong password
        $response = $this->actingAs(Auth::user())->post('/user/confirm-password', [
            'password' => 'wrong-password',
        ]);

        // Ensure errors exist in the session
        $response->assertSessionHasErrors();
    }
}
