<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
     protected $casts = [
        'day_off' => 'array'
    ];

    public function fleetType(){
        return $this->belongsTo(FleetType::class);
    }

    public function route(){
        return $this->belongsTo(VehicleRoute::class ,'vehicle_route_id' );
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }
}
