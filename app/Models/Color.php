<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'hex',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function mainColorPets(): HasMany
    {
        return $this->hasMany(Pet::class, 'main_color_id');
    }

    public function secondaryColorPets(): HasMany
    {
        return $this->hasMany(Pet::class, 'secondary_color_id');
    }
}
