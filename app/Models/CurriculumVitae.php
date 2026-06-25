<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string|null $version
 * @property string $file
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class CurriculumVitae extends Model
{
    protected $table = 'curriculum_vitaes';

    protected $fillable = ['name', 'version', 'file', 'is_active'];

    use HasFactory;

    protected static function booted(): void
    {
        static::updating(function (CurriculumVitae $cv) {
            if ($cv->isDirty('file')) {
                $oldPath = $cv->getOriginal('file');

                if ($oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        });

        static::deleted(function (CurriculumVitae $cv) {
            if ($cv->file) {
                Storage::disk('public')->delete($cv->file);
            }
        });
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
