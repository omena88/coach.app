<?php

namespace App;

enum UserRole: string
{
    case ADMIN = 'admin';
    case COACH = 'coach';
    case COACHEE = 'coachee';
}
