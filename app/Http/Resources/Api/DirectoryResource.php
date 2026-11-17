<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;

/**
 * Companies, departments, suppliers and expense categories: their own columns as stored
 * (no money in them; balances come from the balances endpoints).
 */
class DirectoryResource extends ApiResource
{
    public function toArray(Request $request): array
    {
        return array_merge(
            ['id' => $this->id],
            collect($this->resource->getFillable())->mapWithKeys(fn ($f) => [$f => $this->resource->{$f}])->all(),
            ['is_active' => (bool) $this->is_active, 'created_at' => $this->created_at?->toIso8601String()],
        );
    }
}
