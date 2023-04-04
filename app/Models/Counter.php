<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    public function scopeRouteStoppages($query, $array)
    {
        return $query->whereIn('id', $array)
        ->orderByRaw("field(id,".implode(',',$array).")")->get();
    }
}
