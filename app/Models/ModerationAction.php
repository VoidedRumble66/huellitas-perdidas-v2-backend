<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ModerationAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'moderator_user_id',
        'target_type',
        'target_id',
        'action',
        'reason',
        'previous_status',
        'new_status',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_user_id');
    }

    public function target(): MorphTo
    {
        return $this->morphTo();
    }
}
