<?php

namespace App\Listeners;

use App\Services\Security\AuditService;
use Illuminate\Auth\Events\Failed;
use Illuminate\Http\Request;

class RegisterFailedLogin
{
    public function __construct(
        private AuditService $auditService,
        private Request $request
    ) {
    }

    public function handle(Failed $event): void
    {
        $email = $event->credentials['email'] ?? null;

        $this->auditService->log(
            event: 'LOGIN_FAILED',
            userId: $event->user?->id,
            metadata: [
                'identifier' => $email,
                'reason' => 'INVALID_CREDENTIALS',
            ],
            request: $this->request
        );
    }
}
