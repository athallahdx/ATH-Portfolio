<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $portfolio_id
 * @property int $techstack_id
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class PortfolioTechstack extends Model
{
    protected $table = 'portfolio_techstacks';

    protected $fillable = ['portfolio_id', 'techstack_id', 'sort_order'];

    use HasFactory;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function techstack(): BelongsTo
    {
        return $this->belongsTo(Techstack::class);
    }
}
