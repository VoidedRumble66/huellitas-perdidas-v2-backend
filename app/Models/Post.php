<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'author_user_id',
        'pet_id',
        'post_type',
        'status',
        'visibility',
        'title',
        'description',
        'location_id',
        'contact_method',
        'contact_phone',
        'contact_whatsapp',
        'expires_at',
        'published_at',
        'resolved_at',
        'rejection_reason',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'published_at' => 'datetime',
            'resolved_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function lostDetail(): HasOne
    {
        return $this->hasOne(PostLostDetail::class);
    }

    public function foundDetail(): HasOne
    {
        return $this->hasOne(PostFoundDetail::class);
    }

    public function adoptionDetail(): HasOne
    {
        return $this->hasOne(PostAdoptionDetail::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PostPhoto::class);
    }

    public function mainPhoto(): HasOne
    {
        return $this->hasOne(PostPhoto::class)->where('is_main', true);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function sightings(): HasMany
    {
        return $this->hasMany(PostSighting::class);
    }

    public function reports(): MorphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function moderationActions(): MorphMany
    {
        return $this->morphMany(ModerationAction::class, 'target');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopePendingReview(Builder $query): Builder
    {
        return $query->where('status', 'pending_review');
    }

    public function scopeLost(Builder $query): Builder
    {
        return $query->where('post_type', 'lost');
    }

    public function scopeFound(Builder $query): Builder
    {
        return $query->where('post_type', 'found');
    }

    public function scopeAdoption(Builder $query): Builder
    {
        return $query->where('post_type', 'adoption');
    }

    public function scopeVisiblePublic(Builder $query): Builder
    {
        return $query->where('visibility', 'public');
    }

    public function isLost(): bool
    {
        return $this->post_type === 'lost';
    }

    public function isFound(): bool
    {
        return $this->post_type === 'found';
    }

    public function isAdoption(): bool
    {
        return $this->post_type === 'adoption';
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function markAsPublished(): void
    {
        $this->forceFill([
            'status' => 'published',
            'published_at' => now(),
        ])->save();
    }

    public function markAsResolved(): void
    {
        $this->forceFill([
            'status' => 'resolved',
            'resolved_at' => now(),
        ])->save();
    }
}
