<?php

namespace App\Models;

use \App\Models\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'gallery_images' => 'array', //fait la conversion de json en array php sinon ça bug et inversément
    ];

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
        'internal_notes',
        'modification_request',
        'published_animal',

    ];

/*
    public function users() : BelongsToMany
    {
        return $this->belongsToMany( User::class);
    }*/

    public function adoptionRequests() : HasMany
    {
        return $this->hasMany( \App\Models\Request::class);
    }

}
