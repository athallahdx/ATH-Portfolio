<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

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

    protected static function booted(): void
    {
        static::updating(function (PortfolioImage $image) {
            if ($image->isDirty('image')) {
                $oldPath = $image->getOriginal('image');

                if ($oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        });

        static::deleted(function (PortfolioImage $image) {
            if ($image->image) {
                Storage::disk('public')->delete($image->image);
            }
        });
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
