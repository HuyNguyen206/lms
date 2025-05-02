<?php

namespace App\Enums;

Enum CourseType: int
{
    case COURSE = 1;

    public function label(): string
    {
        return match ($this)  {
            self::COURSE => 'Course',
        };
    }
}
