<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'deck_seats' => 'object',
        'facilities' => 'array'
    ];

}
