<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected function createdAtForHuman(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => (new Verta($value))->formatDifference(),
//            set: fn($value) => $value,
        );
    }
}