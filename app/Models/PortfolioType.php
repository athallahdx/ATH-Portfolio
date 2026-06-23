<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class PortfolioType extends Model
{
    protected $table = 'portfolio_types';

    protected $fillable = ['name', 'description', 'is_active'];

    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class, 'type_id');
    }
}
