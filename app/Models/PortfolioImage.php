<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $portfolio_id
 * @property string|null $image
 * @property string|null $label
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class PortfolioImage extends Model
{
    protected $table = 'portfolio_images';

    protected $fillable = ['portfolio_id', 'image', 'label', 'sort_order'];

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
}
