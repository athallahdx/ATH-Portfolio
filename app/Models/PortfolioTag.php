<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioTag extends Model
{
    use HasFactory;

    protected $table = 'portfolio_tags';

    protected $fillable = ['portfolio_id', 'tag_id'];

    protected function casts(): array
    {
        return [
            'portfolio_id' => 'integer',
            'tag_id' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
