<?php

namespace App;

enum CommitmentStatus: string
{
    case PENDING = 'pending';
    case FULFILLED = 'fulfilled';
    case UNFULFILLED = 'unfulfilled';
}
