<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lengthInHuman(): Attribute
    {
        return Attribute::make(
            get: fn($value) => gmdate('i:s', $value),

        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (new Verta($value))->formatDifference(),
        );
    }

    public function relatedVideos(int $count = 6)
    {
        return $this
            ->where('category_id' , $this->category_id,)
            ->whereNot('id', $this->id)
            ->inRandomOrder()->get()->take($count);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected function ownerName(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->user?->name,
            set: fn($value) => $value,
        );
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class,'video_id');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class,'likeable');
    }
}
