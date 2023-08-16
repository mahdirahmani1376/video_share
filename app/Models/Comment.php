<?php

namespace App\Models;

use App\Traits\Likeable;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory;
	use Likeable;
    protected $fillable = [
        'text',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class,'likeable');
    }

    protected function createdAtForHuman(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => (new Verta($value))->formatDifference(),
        );
    }
}
