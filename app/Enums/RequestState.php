<?php

namespace App\Enums;

enum RequestState : string
{
    case Refused = 'refused';
    case Adopted = 'adopted';
    case InTreatment = 'in_treatment';
    case NotTreatedYet = 'not_treated_yet';
}
