<?php

namespace App\Filters;

use App\Enums\LikeEnum;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class VideoFilter
{
    public function __construct(
        public Builder $builder
    )
    {
    }

    public function apply(array $params)
    {
        foreach ($params as $methodName => $value) {
            if (is_null($value)) continue;
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
    }

    public function sortBy($value)
    {
        return $this->builder
            ->when($value == 'created_at', function ($q) {
                $q->orderBy('created_at', 'desc');
            })
            ->when($value == 'like', function (Builder $q) {
                $q
                    ->leftJoin('likes', function (JoinClause $join) {
                        $join
                            ->on('videos.id','=', 'likes.likeable_id')
                            ->where('likes.likeable_type', Video::class)
                            ->where('likes.vote', LikeEnum::LIKE->value)
                            ->groupBy('videos.id')
                            ->select(['videos.*', DB::raw('COUNT(likes.id) AS count')])
                            ->orderBy('count','desc');
                    });
            })
            ->when($value == 'length', function ($q) {
                $q->orderBy('length', 'desc');
            });
    }

    public function length($value)
    {
        return
            $this->builder
            	->when($value == 1, function ($q) {
                	$q->where('length', '<', 60);
            	})
            	->when($value == 2, function ($q) {
                	$q->whereBetween('length', [60, 300]);
            	})
            	->when($value == 3, function ($q) {
                	$q->where('length', '>', 300);
            	});
    }

    public function q($value)
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }
}
