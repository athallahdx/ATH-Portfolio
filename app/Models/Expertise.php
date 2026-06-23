<?php

namespace App\Models;

use Database\Factories\ExpertiseFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $sort_order
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class Expertise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sort_order',
        'is_active',
    ];

    use HasFactory;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function elements(): HasMany
    {
        return $this->hasMany(ExpertiseElement::class);
    }
}
