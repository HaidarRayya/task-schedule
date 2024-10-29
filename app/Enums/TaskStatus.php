<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PINDING = 'pinding';
    case IN_PROGRESS  = "in progress";
    case COMPLETED = "completed";
}