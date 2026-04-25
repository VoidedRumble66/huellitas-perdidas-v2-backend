<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationMedia extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id',
        'media_type',
        'path',
        'original_filename',
        'mime_type',
        'size_kb',
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

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
