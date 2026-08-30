<?php

namespace App\Services\Security;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditService
{
    public function log(
        string $event,
        ?int $userId = null,
        ?string $auditableType = null,
        ?int $auditableId = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?array $metadata = null,
        ?Request $request = null
    ): AuditLog {
        $request ??= request();

        return AuditLog::create([
            'user_id' => $userId,
            'event' => $event,
            'auditable_type' => $auditableType,
            'auditable_id' => $auditableId,
            'route' => $request?->route()?->getName(),
            'http_method' => $request?->method(),
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'metadata' => $metadata,
        ]);
    }
}
