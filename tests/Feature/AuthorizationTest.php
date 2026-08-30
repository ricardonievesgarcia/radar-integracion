<?php

namespace Tests\Feature;

use App\Enums\UserStatus;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_superadmin_puede_cualquier_permiso(): void
    {
        $user = User::factory()->create([
            'estado' => UserStatus::ACTIVO,
        ]);

        $user->assignRole('SUPERADMIN');

        $this->assertTrue(
            $user->can('permiso.que.no.existe')
        );
    }

    public function test_administrador_solo_puede_permisos_asignados(): void
    {
        $user = User::factory()->create([
            'estado' => UserStatus::ACTIVO,
        ]);

        $user->assignRole('ADMINISTRADOR');

        $this->assertTrue(
            $user->can('seguridad.usuarios.view')
        );

        $this->assertFalse(
            $user->can('territorial.centros_poblados.view')
        );
    }
}
