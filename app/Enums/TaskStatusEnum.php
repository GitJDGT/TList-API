<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    // This Enum will let us validate de satus of a task while still
    // having a STRING type column in the database.

    // * The name of the cases are considerede to be CONSTANTS, so it's
    // * they're all capitalized for conventions reasons.

    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}
