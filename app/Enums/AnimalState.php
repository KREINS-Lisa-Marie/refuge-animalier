<?php

namespace App\Enums;

enum AnimalState:string
{
    case Adopted = 'adopted';
    case Adoptable = 'adoptable';
    case InTreatment = 'in_treatment';
    case ProcessingAdoption = 'processing_adoption';
}
