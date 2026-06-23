<?php

namespace App\Models;

use Database\Factories\DescriptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $label
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Description extends Model
{
    protected $table = 'descriptions';

    protected $fillable = ['label', 'description'];

    /** @use HasFactory<DescriptionFactory> */
    use HasFactory;
}
