<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $expertise_id
 * @property string $name
 * @property string|null $icon
 * @property string|null $description
 * @property int $sort_order
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ExpertiseElement extends Model
{
    protected $table = 'expertise_elements';

    protected $fillable = [
        'expertise_id',
        'name',
        'icon',
        'description',
        'sort_order',
    ];

    use HasFactory;

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function expertise(): BelongsTo
    {
        return $this->belongsTo(Expertise::class);
    }
}
