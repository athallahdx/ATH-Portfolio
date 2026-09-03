<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hero extends Model
{
    protected $table = 'hero';

    protected $fillable = [
        'position',
        'image',
        'description',
    ];

    protected static function booted(): void
    {
        static::updating(function (Hero $hero) {
            if ($hero->isDirty('image')) {
                $oldPath = $hero->getOriginal('image');

                if ($oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        });

        static::deleted(function (Hero $hero) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
        });
    }
}
