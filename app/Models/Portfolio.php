<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property string|null $url
 * @property array|null $contributions
 * @property bool $is_active
 * @property int $type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Portfolio extends Model
{
    protected $table = 'portfolios';

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'url',
        'contributions',
        'is_active',
        'type_id',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'contributions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PortfolioType::class, 'type_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class);
    }

    public function techstacks(): BelongsToMany
    {
        return $this->belongsToMany(
            Techstack::class,
            'portfolio_techstacks'
        )->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'portfolio_tags')
            ->withTimestamps();
    }
}
