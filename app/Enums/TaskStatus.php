<?php

namespace App\Enums;

enum TaskStatus: string
{
    case ToDo = 'to-do';
    case InProgress = 'in-progress';
    case Done = 'done';

    function getColor()
    {
        return match ($this) {
            self::ToDo => 'text-warning',
            self::InProgress => 'text-info',
            self::Done => 'text-success'
        };
    }

    function getIcon()
    {
        return match ($this) {
            self::ToDo => 'clock',
            self::InProgress => 'container',
            self::Done => 'check-circle'
        };
    }
}
