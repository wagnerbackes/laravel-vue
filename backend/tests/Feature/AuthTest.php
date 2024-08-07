<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_authenticate()
    {
        $manager = User::factory()->create([
            'role' => 'manager',
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->postJson('/api/auth', [
            'email' => $manager->email,
            'password' => $password,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token']);
    }

    public function test_employee_can_authenticate()
    {
        $employee = User::factory()->create([
            'role' => 'employee',
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->postJson('/api/auth', [
            'email' => $employee->email,
            'password' => $password,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token']);
    }

    public function test_manager_can_logout()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $token = $manager->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->postJson('/api/logout');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $manager->id,
        ]);
    }

    public function test_employee_can_logout()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $token = $employee->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
                         ->postJson('/api/logout');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $employee->id,
        ]);
    }
}

