<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_user(): void
    {
        $userData = User::factory()->create();

        $response = $this->post(route('user.add'), $userData->toArray());

        $this->assertDatabaseHas('users', [
            'name' => $userData->name,
            'email' => $userData->email,
            'password' => $userData->password
        ]);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_update_password_route()
    {
        $userData = User::factory()->create();

        $new_password = fake()->password;

        $update_password = $this->actingAs($userData)->put(route('update.password'), [
            'new_password' => $new_password,
        ]);

        $update_password->assertStatus(200);
    }
}
