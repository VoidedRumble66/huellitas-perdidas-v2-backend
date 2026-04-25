<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserReputationSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score',
        'level',
        'posts_created_count',
        'helpful_reports_count',
        'resolved_cases_count',
        'last_calculated_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'posts_created_count' => 'integer',
            'helpful_reports_count' => 'integer',
            'resolved_cases_count' => 'integer',
            'last_calculated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
