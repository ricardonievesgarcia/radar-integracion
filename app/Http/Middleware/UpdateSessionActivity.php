<?php

namespace App\Http\Middleware;

use App\Models\UserSession;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateSessionActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            $sessionId = $request->session()->getId();

            $userSession = UserSession::where('session_id', $sessionId)
                ->whereNull('logout_at')
                ->whereNull('revoked_at')
                ->first();

            if ($userSession) {

                $lastSeen = $userSession->last_seen_at;

                if (
                    is_null($lastSeen) ||
                    $lastSeen->lt(now()->subSeconds(60))
                ) {
                    $userSession->update([
                        'last_seen_at' => now(),
                    ]);
                }
            }
        }

        return $next($request);
    }
}
