<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function password_can_be_updated()
    {
        $user = User::factory()->create();

        // Act as the user and update their password
        $response = $this->actingAs(Auth::user())->put('/user/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        // Ensure no errors
        $response->assertSessionHasNoErrors();

        // Test if the password has been updated by attempting to log in with the new credentials
        Auth::logout();
        $this->assertTrue(Auth::attempt(['email' => $user->email, 'password' => 'new-password']));
    }
}
