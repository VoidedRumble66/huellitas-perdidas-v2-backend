<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostPhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'post_id',
        'path',
        'thumbnail_path',
        'original_filename',
        'mime_type',
        'size_kb',
        'width',
        'height',
        'sort_order',
        'is_main',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'is_main' => 'boolean',
            'metadata' => 'array',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
