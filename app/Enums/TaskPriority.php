<?php

namespace App\Enums;

enum TaskPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';

    function getColor()
    {
        return match ($this) {
            self::High => 'text-error',
            self::Low => 'text-success',
            self::Medium => 'text-warning'
        };
    }

    function getIcon()
    {
        return match ($this) {
            self::High => 'flame',
            self::Low => 'smiley',
            self::Medium => 'megaphone'
        };
    }
}
