<?php

namespace App\Services\Security;

use App\Models\UserSession;
use Illuminate\Support\Facades\DB;
use App\Services\Security\AuditService;

class SessionService
{
    public function revokeSession(
        string $sessionId,
        ?int $revokedBy = null,
        string $reason = 'REVOKED'
    ): bool {
        return DB::transaction(function () use ($sessionId, $revokedBy, $reason) {

            $userSession = UserSession::where('session_id', $sessionId)
                ->whereNull('logout_at')
                ->whereNull('revoked_at')
                ->first();

            if (! $userSession) {
                return false;
            }

            $userSession->update([
                'revoked_at' => now(),
                'revoked_by' => $revokedBy,
                'logout_reason' => $reason,
                'last_seen_at' => now(),
            ]);

            app(AuditService::class)->log(
                event: 'SESSION_REVOKED',
                userId: $revokedBy,
                auditableType: UserSession::class,
                auditableId: $userSession->id,
                metadata: [
                    'session_id' => $sessionId,
                    'target_user_id' => $userSession->user_id,
                    'reason' => $reason,
                ]
            );

            DB::table('sessions')
                ->where('id', $sessionId)
                ->delete();

            return true;
        });
    }

    public function revokeAllForUser(
        int $userId,
        ?string $exceptSessionId = null,
        ?int $revokedBy = null,
        string $reason = 'REVOKED_ALL'
    ): int {
        $sessions = UserSession::where('user_id', $userId)
            ->whereNull('logout_at')
            ->whereNull('revoked_at')
            ->when(
                $exceptSessionId,
                fn ($query) => $query->where('session_id', '!=', $exceptSessionId)
            )
            ->get();

        $count = 0;

        foreach ($sessions as $session) {
            if (
                $this->revokeSession(
                    $session->session_id,
                    $revokedBy,
                    $reason
                )
            ) {
                $count++;
            }
        }

        return $count;
    }
}
