<?php

namespace App\Enums;

enum TaskStatus: string
{
    case ToDo = 'to-do';
    case InProgress = 'in-progress';
    case Done = 'done';
}

