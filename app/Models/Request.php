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
        'animal_id',
        'first_name',
        'last_name',
        'state',
        'email',
        'phone',
        'address',
        'message',
        'comment',
    ];

    public function animal() : BelongsTo
    {
        return $this->belongsTo( Animal::class);
    }

}
