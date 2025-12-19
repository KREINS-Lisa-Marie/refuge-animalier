<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'animal_name',
        'species',
        'race',
        'sex',
        'fur',
        'age',
        'vaccinations',
        'character',
        'state',
        'description',
        'show_image',
        'gallery_images',
    ];


    public function users() : BelongsToMany
    {
        return $this->belongsToMany( User::class);
    }

    public function requests() : HasMany
    {
        return $this->hasMany( Request::class);
    }

}
