<?php

namespace App;

enum SessionMode: string
{
    case IN_PERSON = 'in_person';
    case VIRTUAL = 'virtual';
    case PHONE = 'phone';
}
