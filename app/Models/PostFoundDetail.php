<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostFoundDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'found_at',
        'current_pet_condition',
        'is_pet_sheltered',
        'temporary_shelter_description',
        'handover_instructions',
    ];

    protected function casts(): array
    {
        return [
            'found_at' => 'datetime',
            'is_pet_sheltered' => 'boolean',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
