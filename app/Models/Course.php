<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;
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
    public const DONE = 'done';

    public const STAGE_WITH_TRANSITIONS = [
      self::BASIC_INFO => self::STAGE_TRANSITION_1,
      self::MORE_INFO => self::STAGE_TRANSITION_2,
      self::COURSE_CONTENT => self::STAGE_TRANSITION_3,
      self::FINISH => null,
    ];

    public const STAGE_TRANSITION_1 = [self::BASIC_INFO => self::MORE_INFO];
    public const STAGE_TRANSITION_2 = [self::MORE_INFO => self::COURSE_CONTENT];
    public const STAGE_TRANSITION_3 = [self::COURSE_CONTENT => self::FINISH];
    public const STAGE_TRANSITION_4 = [self::FINISH => self::DONE];

    protected $casts = [
        'status' => Status::class
    ];

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

    public function getThumbnail()
    {
        return Storage::disk('public')->url($this->thumbnail);
    }
}
