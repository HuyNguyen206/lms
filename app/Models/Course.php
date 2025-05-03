<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

/**
 * @mixin Builder
 */
class Course extends Model
{
    public const BASIC_INFO = 'basic-info';
    public const COURSE_CONTENT = 'course-content';
    public const FINISH = 'finish';
    public const MORE_INFO = 'more-info';
    protected static function booted()
    {
        static::creating(function ($course) {
            $course->slug = Str::slug($course->name);
        });

        static::updating(function (Course $course){
            $changes = $course->getChanges();
            if (in_array('name', $changes)) {
                $course->slug = Str::slug($course->name);
            }
        });
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    public function discountPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}
