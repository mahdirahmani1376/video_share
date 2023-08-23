<?php

namespace App\Models;

use App\Enums\LikeEnum;
use App\Filters\VideoFilter;
use App\Traits\Likeable;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    use HasFactory;
    use Likeable;

    protected $guarded = [];

    public function lengthInHuman(): Attribute
    {
        return Attribute::make(
            get: fn($value) => gmdate('i:s', $this->length),

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
            ->where('category_id', $this->category_id,)
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'video_id');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function scopeFilter(Builder $query, array $params)
    {
        return (new VideoFilter($query))->apply($params);
    }

    protected function videoUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => '/storage/' . $this->attributes['path'],
        );
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => '/storage/' . $this->attributes['thumbnail'],
            set: fn($value) => $value,
        );
    }

    protected function ownerName(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => $this->user?->name,
            set: fn($value) => $value,
        );
    }
}
