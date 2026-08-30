<?php

namespace Tests\Feature;

use App\Enums\UserStatus;
use App\Models\User;
use App\Models\UserSession;
use App\Services\Security\SessionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SessionRevocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_revocar_una_sesion(): void
    {
        $user = User::factory()->create([
            'estado' => UserStatus::ACTIVO,
        ]);

        $sessionId = 'session-test-123';

        DB::table('sessions')->insert([
            'id' => $sessionId,
            'user_id' => $user->id,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit',
            'payload' => '',
            'last_activity' => now()->timestamp,
        ]);

        UserSession::create([
            'user_id' => $user->id,
            'session_id' => $sessionId,
            'login_at' => now(),
            'last_seen_at' => now(),
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit',
        ]);

        $service = app(SessionService::class);

        $result = $service->revokeSession(
            $sessionId,
            $user->id,
            'ADMIN_REVOKED'
        );

        $this->assertTrue($result);

        $this->assertDatabaseMissing('sessions', [
            'id' => $sessionId,
        ]);

        $this->assertDatabaseHas('user_sessions', [
            'session_id' => $sessionId,
            'logout_reason' => 'ADMIN_REVOKED',
            'revoked_by' => $user->id,
        ]);
    }
}
