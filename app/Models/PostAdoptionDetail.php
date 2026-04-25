<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostAdoptionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'vaccinated',
        'vaccines_description',
        'health_status',
        'sterilized',
        'adoption_requirements',
        'adoption_fee',
        'adoption_process_notes',
        'good_with_children',
        'good_with_dogs',
        'good_with_cats',
        'energy_level',
        'requires_yard',
    ];

    protected function casts(): array
    {
        return [
            'vaccinated' => 'boolean',
            'sterilized' => 'boolean',
            'adoption_fee' => 'decimal:2',
            'good_with_children' => 'boolean',
            'good_with_dogs' => 'boolean',
            'good_with_cats' => 'boolean',
            'requires_yard' => 'boolean',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
