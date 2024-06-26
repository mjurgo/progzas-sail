<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail(mixed $get)
 * @method static create(array $array)
 * @method static find(\Illuminate\Routing\Route|object|string|null $route)
 * @property int $user_id
 * @property string $identifier
 * @property bool $active
 */
class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'value', 'comment', 'user_id', 'teacher_id', 'subject_id', 'identifier',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
