<?php

namespace App;

enum SessionStatus: string
{
    case SCHEDULED = 'scheduled';
    case COMPLETED = 'completed';
    case RESCHEDULED = 'rescheduled';
    case CANCELLED = 'cancelled';
}
