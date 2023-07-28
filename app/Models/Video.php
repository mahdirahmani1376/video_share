<?php

namespace App\Models;

use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lenght(): Attribute
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
}
