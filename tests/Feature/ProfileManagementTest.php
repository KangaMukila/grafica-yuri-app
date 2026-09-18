<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileManagementTest extends TestCase
{
    public function test_user_can_update_profile_data_and_password(): void
    {
        $user = User::factory()->create([
            'name' => 'Nome antigo',
            'email' => 'antigo@teste.local',
            'telefone' => '999999999',
            'nif' => '123456789',
            'password' => Hash::make('old-password-123'),
        ]);

        $this->actingAs($user)
            ->patch(route('profile.update'), [
                'name' => 'Nome novo',
                'email' => 'novo@teste.local',
                'telefone' => '888888888',
                'nif' => '987654321',
            ])
            ->assertRedirect(route('profile.edit'));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nome novo',
            'telefone' => '888888888',
            'nif' => '987654321',
        ]);

        $this->actingAs($user)
            ->put(route('password.update'), [
                'current_password' => 'old-password-123',
                'password' => 'new-password-456',
                'password_confirmation' => 'new-password-456',
            ])
            ->assertRedirect();

        $this->assertTrue(Hash::check('new-password-456', $user->fresh()->password));
    }
}
