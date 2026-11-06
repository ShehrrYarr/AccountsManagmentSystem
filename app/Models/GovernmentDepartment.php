<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GovernmentDepartment extends Model
{
    use Auditable, HasFactory;

    protected $fillable = ['name', 'code', 'city', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function cheques(): HasMany
    {
        return $this->hasMany(Cheque::class);
    }
}
