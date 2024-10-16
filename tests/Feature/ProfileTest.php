<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Set up database migrations before each test
        $this->artisan('migrate');
    }

    /** @test */
    public function profile_page_is_displayed()
    {
        $role = Role::factory()->create(['name' => 'huurder']);
        $user = User::factory()->create(['role_id' => $role->id]);

        // Simulate the user accessing the profile page
        $response = $this->actingAs($user)->get('/profile');

        // Assert that the profile page loads successfully
        $response->assertStatus(200);
    }

    /** @test */
    public function profile_information_can_be_updated()
    {
        $role = Role::factory()->create(['name' => 'huurder']);
        $user = User::factory()->create(['role_id' => $role->id]);

        // Simulate the user updating their profile information
        $response = $this->actingAs($user)->put('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Assert that the request was successful and redirected to the profile page
        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        // Assert that the user's information was updated in the database
        $user->refresh();
        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
    }

    /** @test */
    public function email_verification_status_is_unchanged_when_the_email_address_is_unchanged()
    {
        $role = Role::factory()->create(['name' => 'huurder']);
        $user = User::factory()->create(['role_id' => $role->id, 'email_verified_at' => now()]);

        // Simulate the user updating their profile with the same email
        $response = $this->actingAs($user)->put('/profile', [
            'name' => 'Test User',
            'email' => $user->email, // Use the same email
        ]);

        // Assert that the request was successful and redirected to the profile page
        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        // Assert that the email verification status remains unchanged
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    /** @test */
    public function user_can_delete_their_account()
    {
        $role = Role::factory()->create(['name' => 'huurder']);
        $user = User::factory()->create(['role_id' => $role->id]);

        // Simulate the user deleting their account with the correct password
        $response = $this->actingAs($user)->delete('/profile', [
            'password' => 'password',
        ]);

        // Assert that the account deletion was successful and redirected to the home page
        $response->assertSessionHasNoErrors()->assertRedirect('/');

        // Assert that the user has been deleted from the database
        $this->assertNull(User::find($user->id));
    }

    /** @test */
    public function correct_password_must_be_provided_to_delete_account()
    {
        $role = Role::factory()->create(['name' => 'huurder']);
        $user = User::factory()->create(['role_id' => $role->id]);

        // Simulate the user attempting to delete their account with an incorrect password
        $response = $this->actingAs($user)->delete('/profile', [
            'password' => 'wrong-password',
        ]);

        // Assert that the request failed due to incorrect password
        $response->assertSessionHasErrors();

        // Assert that the user has not been deleted from the database
        $this->assertNotNull(User::find($user->id));
    }
}
