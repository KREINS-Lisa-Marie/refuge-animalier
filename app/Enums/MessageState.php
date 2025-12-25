<?php

namespace App\Enums;

enum MessageState:string
{
    case Read = 'read';
    case NotReadYet = 'not_read_yet';
}
