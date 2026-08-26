<?php

namespace Tests\Feature;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_activo_puede_iniciar_sesion(): void
    {
        $user = User::factory()->create([
            'email' => 'activo@radar.local',
            'password' => 'Password123*',
            'estado' => UserStatus::ACTIVO,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Password123*',
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_usuario_bloqueado_no_puede_iniciar_sesion(): void
    {
        $user = User::factory()->create([
            'email' => 'bloqueado@radar.local',
            'password' => 'Password123*',
            'estado' => UserStatus::BLOQUEADO,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Password123*',
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    public function test_usuario_inactivo_no_puede_iniciar_sesion(): void
    {
        $user = User::factory()->create([
            'email' => 'inactivo@radar.local',
            'password' => 'Password123*',
            'estado' => UserStatus::INACTIVO,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Password123*',
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    public function test_password_incorrecta_no_permite_login(): void
    {
        $user = User::factory()->create([
            'email' => 'activo@radar.local',
            'password' => 'Password123*',
            'estado' => UserStatus::ACTIVO,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'Incorrecta123*',
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }
}
