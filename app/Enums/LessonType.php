<?php

namespace App\Enums;

use App\Traits\HasList;

enum LessonType: int
{
    use HasList;
    case LESSON = 1;
    case LIVE = 2;

    public function label(): string
    {
        return match ($this) {
            self::LESSON => 'Lesson',
            self::LIVE => 'Live',
        };
    }
}
