<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $whatsapp
 * @property string|null $linkedin
 * @property string|null $github
 * @property string|null $instagram
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['name', 'email', 'whatsapp', 'linkedin', 'github', 'instagram'];

    use HasFactory;
}
