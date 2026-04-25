<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdoptionRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'post_id',
        'applicant_user_id',
        'status',
        'housing_type',
        'has_other_pets',
        'other_pets_description',
        'experience_with_pets',
        'reason_for_adoption',
        'responsible_adult_name',
        'contact_phone',
        'contact_email',
        'notes',
        'selected_at',
        'approved_at',
        'rejected_at',
        'cancelled_at',
        'completed_at',
        'reviewed_by',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'has_other_pets' => 'boolean',
            'selected_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'completed_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applicant_user_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(AdoptionStatusHistory::class);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeInReview(Builder $query): Builder
    {
        return $query->where('status', 'in_review');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled(Builder $query): Builder
    {
        return $query->where('status', 'cancelled');
    }

    public function recordStatusChange(string $newStatus, ?int $changedBy = null, ?string $notes = null): void
    {
        $this->statusHistories()->create([
            'changed_by' => $changedBy,
            'old_status' => $this->status,
            'new_status' => $newStatus,
            'notes' => $notes,
            'metadata' => null,
        ]);
    }

    public function markInReview(?int $reviewerId = null): void
    {
        $this->recordStatusChange('in_review', $reviewerId);

        $this->forceFill([
            'status' => 'in_review',
            'reviewed_by' => $reviewerId,
        ])->save();
    }

    public function markSelected(?int $reviewerId = null): void
    {
        $this->recordStatusChange('selected', $reviewerId);

        $this->forceFill([
            'status' => 'selected',
            'reviewed_by' => $reviewerId,
            'selected_at' => now(),
        ])->save();
    }

    public function approve(?int $reviewerId = null): void
    {
        $this->recordStatusChange('approved', $reviewerId);

        $this->forceFill([
            'status' => 'approved',
            'reviewed_by' => $reviewerId,
            'approved_at' => now(),
        ])->save();
    }

    public function reject(?int $reviewerId = null, ?string $notes = null): void
    {
        $this->recordStatusChange('rejected', $reviewerId, $notes);

        $this->forceFill([
            'status' => 'rejected',
            'reviewed_by' => $reviewerId,
            'rejected_at' => now(),
            'notes' => $notes,
        ])->save();
    }

    public function cancel(?string $notes = null): void
    {
        $this->recordStatusChange('cancelled', null, $notes);

        $this->forceFill([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'notes' => $notes,
        ])->save();
    }

    public function complete(?int $reviewerId = null): void
    {
        $this->recordStatusChange('completed', $reviewerId);

        $this->forceFill([
            'status' => 'completed',
            'reviewed_by' => $reviewerId,
            'completed_at' => now(),
        ])->save();
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
