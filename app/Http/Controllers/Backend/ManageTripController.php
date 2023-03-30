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
         $routes = VehicleRoute::with(['startFrom','endTo'])->orderBy('id', 'desc')->paginate(getPaginate());
        $stoppages = Counter::active()->get();
        return view('backend.trip.route.list', compact('pageTitle', 'routes', 'emptyMessage', 'stoppages'));

    }
}
