<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\VehicleRoute;
use App\Models\Counter;
use App\Models\FleetType;
use App\Models\Schedule;
use App\Models\Trip;
use Carbon\Carbon;


class ManageTripController extends Controller
{
    public function routeList(){

    	$pageTitle = 'All Routes';
        $emptyMessage = 'No route found';
         $routes = VehicleRoute::with(['startFrom','endTo'])->orderBy('id', 'desc')->paginate(10);
        $stoppages = Counter::where('status',1)->get();
        return view('backend.trip.route.list', compact('pageTitle', 'routes', 'emptyMessage', 'stoppages'));

    }
}
