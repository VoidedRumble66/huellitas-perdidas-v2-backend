<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_user_id',
        'name',
        'species_id',
        'breed_id',
        'sex',
        'size',
        'main_color_id',
        'secondary_color_id',
        'birth_date',
        'approximate_age',
        'distinctive_signs',
        'sterilized',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'sterilized' => 'boolean',
            'metadata' => 'array',
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function mainColor(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'main_color_id');
    }

    public function secondaryColor(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'secondary_color_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
