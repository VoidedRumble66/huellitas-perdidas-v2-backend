<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_user_id',
        'organization_type',
        'name',
        'slug',
        'email',
        'phone',
        'whatsapp',
        'description',
        'logo_path',
        'status',
        'location_id',
        'website_url',
        'facebook_url',
        'instagram_url',
        'verified_at',
        'approved_by',
        'approved_at',
        'rejected_at',
        'rejection_reason',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(OrganizationService::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(OrganizationSchedule::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(OrganizationMedia::class);
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function scopePendingReview(Builder $query): Builder
    {
        return $query->where('status', 'pending_review');
    }

    public function scopeShelters(Builder $query): Builder
    {
        return $query->where('organization_type', 'shelter');
    }

    public function scopeVeterinaries(Builder $query): Builder
    {
        return $query->where('organization_type', 'veterinary');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function approve(?int $adminId = null): void
    {
        $this->forceFill([
            'status' => 'approved',
            'approved_by' => $adminId,
            'approved_at' => now(),
            'rejected_at' => null,
            'rejection_reason' => null,
        ])->save();
    }

    public function reject(?int $adminId = null, ?string $reason = null): void
    {
        $this->forceFill([
            'status' => 'rejected',
            'approved_by' => $adminId,
            'rejected_at' => now(),
            'rejection_reason' => $reason,
        ])->save();
    }

    public function suspend(): void
    {
        $this->forceFill(['status' => 'suspended'])->save();
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isShelter(): bool
    {
        return $this->organization_type === 'shelter';
    }

    public function isVeterinary(): bool
    {
        return $this->organization_type === 'veterinary';
    }
}
