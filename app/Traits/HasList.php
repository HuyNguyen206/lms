<?php

namespace App\Traits;

trait HasList
{
    public static function labels(): array
    {
        $data = [];
        foreach (self::cases() as $case) {
            $data[$case->value] = $case->label();
        }

        return $data;
    }
}
