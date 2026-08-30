<?php

namespace App\Http\Responses;

use App\Models\UserSession;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Security\AuditService;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): Response
    {
        $user = $request->user();

        $userSession = UserSession::updateOrCreate(
            [
                'session_id' => $request->session()->getId(),
            ],
            [
                'user_id' => $user->id,
                'login_at' => now(),
                'last_seen_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'logout_at' => null,
                'revoked_at' => null,
                'revoked_by' => null,
                'logout_reason' => null,
            ]
        );

        app(AuditService::class)->log(
            event: 'LOGIN_SUCCESS',
            userId: $user->id,
            auditableType: UserSession::class,
            auditableId: $userSession->id,
            metadata: [
                'session_id' => $request->session()->getId(),
            ],
            request: $request
        );

        $user->forceFill([
            'ultimo_login_at' => now(),
            'ultimo_login_ip' => $request->ip(),
        ])->save();

        if ($request->wantsJson()) {
            return new JsonResponse([
                'authenticated' => true,
            ]);
        }

        return redirect()->intended(config('fortify.home'));
    }
}
