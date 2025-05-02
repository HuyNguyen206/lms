<?php

namespace App\Enums;

Enum VideoStorageType: int
{
    case UPLOAD = 1;
    case YOUTUBE = 2;
    case VIMEO = 3;
    case EXTERNAL_LINK = 4;

    public function label(): string
    {
        return match ($this)  {
            self::UPLOAD => 'Upload',
            self::YOUTUBE => 'Youtube',
            self::VIMEO => 'Vimeo',
            self::EXTERNAL_LINK => 'External link',
        };
    }
}
