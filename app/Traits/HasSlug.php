<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->slug = Str::slug($model->slugColumn ?? $model->name);
        });

        static::updating(function (Model $model) {
            $model->slug = Str::slug($model->slugColumn ?? $model->name);
        });
    }
}
