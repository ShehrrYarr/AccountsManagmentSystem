<?php

namespace App\Models\Concerns;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

/**
 * Records created / updated / deleted events with before & after values.
 *
 * Models may define `protected array $auditExclude = [...]` to skip noisy
 * columns such as cached running balances.
 */
trait Auditable
{
    public static function bootAuditable(): void
    {
        static::created(fn (Model $m) => $m->writeAudit('created', [], $m->auditableAttributes($m->getAttributes())));

        static::updated(function (Model $m) {
            $changes = $m->auditableAttributes($m->getChanges());
            if ($changes === []) {
                return;
            }
            $old = array_intersect_key($m->getOriginal(), $changes);
            $m->writeAudit('updated', $m->auditableAttributes($old), $changes);
        });

        static::deleted(fn (Model $m) => $m->writeAudit('deleted', $m->auditableAttributes($m->getAttributes()), []));

        if (method_exists(static::class, 'restored')) {
            static::restored(fn (Model $m) => $m->writeAudit('restored', [], $m->auditableAttributes($m->getAttributes())));
        }
    }

    protected function auditableAttributes(array $attributes): array
    {
        $exclude = array_merge(
            ['created_at', 'updated_at', 'password', 'remember_token'],
            property_exists($this, 'auditExclude') ? $this->auditExclude : []
        );

        $out = array_diff_key($attributes, array_flip($exclude));

        // Normalise enums / dates to scalars for JSON storage.
        return array_map(fn ($v) => $v instanceof \BackedEnum ? $v->value : ($v instanceof \DateTimeInterface ? $v->format('Y-m-d H:i:s') : $v), $out);
    }

    protected function writeAudit(string $event, array $old, array $new): void
    {
        $request = app()->runningInConsole() && ! app()->runningUnitTests() ? null : request();

        AuditLog::create([
            'user_id' => auth()->id(),
            'event' => $event,
            'auditable_type' => $this->getMorphClass(),
            'auditable_id' => $this->getKey(),
            'old_values' => $old ?: null,
            'new_values' => $new ?: null,
            'ip_address' => $request?->ip(),
            'user_agent' => $request ? substr((string) $request->userAgent(), 0, 255) : null,
            'created_at' => now(),
        ]);
    }

    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable')->latest('created_at');
    }
}
