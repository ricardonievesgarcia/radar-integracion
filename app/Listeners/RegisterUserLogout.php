<?php

namespace App\Listeners;

use App\Models\UserSession;
use Illuminate\Auth\Events\Logout;
use App\Services\Security\AuditService;

class RegisterUserLogout
{
    public function handle(Logout $event): void
    {
        UserSession::where('session_id', session()->getId())
            ->whereNull('logout_at')
            ->update([
                'logout_at' => now(),
                'last_seen_at' => now(),
                'logout_reason' => 'LOGOUT',
            ]);

        app(AuditService::class)->log(
            event: 'LOGOUT',
            userId: $event->user?->id,
            metadata: [
                'session_id' => session()->getId(),
            ]
        );
    }
}
