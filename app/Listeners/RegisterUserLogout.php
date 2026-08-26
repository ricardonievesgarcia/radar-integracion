<?php

namespace App\Listeners;

use App\Models\UserSession;
use Illuminate\Auth\Events\Logout;

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
    }
}
