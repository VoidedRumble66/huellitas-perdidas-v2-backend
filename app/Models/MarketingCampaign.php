<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'channel',
        'source',
        'medium',
        'status',
        'starts_at',
        'ends_at',
        'budget',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'budget' => 'decimal:2',
            'metadata' => 'array',
        ];
    }
}
