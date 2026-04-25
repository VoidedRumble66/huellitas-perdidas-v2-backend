<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reporter_user_id',
        'reportable_type',
        'reportable_id',
        'report_reason_id',
        'description',
        'status',
        'priority',
        'reviewed_by',
        'reviewed_at',
        'resolution_notes',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_user_id');
    }

    public function reportReason(): BelongsTo
    {
        return $this->belongsTo(ReportReason::class, 'report_reason_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function reportable(): MorphTo
    {
        return $this->morphTo();
    }

    public function moderationActions(): MorphMany
    {
        return $this->morphMany(ModerationAction::class, 'target');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeInReview(Builder $query): Builder
    {
        return $query->where('status', 'in_review');
    }

    public function scopeResolved(Builder $query): Builder
    {
        return $query->where('status', 'resolved');
    }

    public function scopeCritical(Builder $query): Builder
    {
        return $query->where('priority', 'critical');
    }

    public function markInReview(?int $reviewerId = null): void
    {
        $this->forceFill([
            'status' => 'in_review',
            'reviewed_by' => $reviewerId,
            'reviewed_at' => now(),
        ])->save();
    }

    public function resolve(?int $reviewerId = null, ?string $notes = null): void
    {
        $this->forceFill([
            'status' => 'resolved',
            'reviewed_by' => $reviewerId,
            'reviewed_at' => now(),
            'resolution_notes' => $notes,
        ])->save();
    }

    public function reject(?int $reviewerId = null, ?string $notes = null): void
    {
        $this->forceFill([
            'status' => 'rejected',
            'reviewed_by' => $reviewerId,
            'reviewed_at' => now(),
            'resolution_notes' => $notes,
        ])->save();
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCritical(): bool
    {
        return $this->priority === 'critical';
    }
}
