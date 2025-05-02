<?php

namespace App\Enums;

enum Status: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
    case DRAFT = 3;

    public function label(): string
    {
       return match ($this)  {
             self::ACTIVE => 'Active',
             self::INACTIVE => 'Inactive',
             self::DRAFT => 'Draft'
        };
    }

}
