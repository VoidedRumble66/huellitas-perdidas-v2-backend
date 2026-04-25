<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'day_of_week',
        'opens_at',
        'closes_at',
        'is_closed',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'opens_at' => 'string',
            'closes_at' => 'string',
            'is_closed' => 'boolean',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
