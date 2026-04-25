<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostLostDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'lost_at',
        'last_seen_description',
        'reward_offered',
        'reward_amount',
        'safe_contact_instructions',
    ];

    protected function casts(): array
    {
        return [
            'lost_at' => 'datetime',
            'reward_offered' => 'boolean',
            'reward_amount' => 'decimal:2',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
