<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property int $sort_order
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Techstack extends Model
{
    protected $table = 'techstacks';

    protected $fillable = ['name', 'icon', 'sort_order', 'is_active'];

    use HasFactory;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function portfolioTechstacks(): HasMany
    {
        return $this->hasMany(PortfolioTechstack::class);
    }
}
