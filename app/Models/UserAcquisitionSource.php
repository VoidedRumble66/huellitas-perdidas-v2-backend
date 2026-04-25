<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAcquisitionSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'marketing_campaign_id',
        'source',
        'medium',
        'campaign',
        'referrer_url',
        'landing_path',
        'acquired_at',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'acquired_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function marketingCampaign(): BelongsTo
    {
        return $this->belongsTo(MarketingCampaign::class);
    }
}
