<?php

namespace App\Enums;

use App\Traits\HasList;

enum FileType: int
{
    use HasList;

    case VIDEO = 1;
    case AUDIO = 2;
    case DOC = 3;
    case FILE = 4;
    case PDF = 5;

    public function label(): string
    {
        return match ($this) {
            self::VIDEO => 'Video',
            self::AUDIO => 'Audio',
            self::DOC => 'Doc',
            self::FILE => 'File',
            self::PDF => 'PDF',
        };
    }
}
