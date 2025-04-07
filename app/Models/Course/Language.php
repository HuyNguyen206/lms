<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Language extends Model
{
    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function (Model $model) {
            $model->slug = Str::slug($model->name);
        });
    }
}
