<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShareEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'channel',
        'platform',
        'shared_at',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'shared_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
