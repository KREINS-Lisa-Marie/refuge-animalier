<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'state',
        'email',
        'phone',
        'date',
    ];

    public function animal() : HasOne
    {
        return $this->hasOne( Animal::class);
    }

    public function users() : BelongsTo
    {
        return $this->belongsTo( User::class);
    }
}
