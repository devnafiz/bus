<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FleetType;
use App\Models\Schedule;
use App\Models\Trip;
use Carbon\Carbon;
use App\Models\VehicleRoute;




class HomeController extends Controller
{
     public function index(){

     	return view('home.index');
     }


     public function busManage(){
     	$fleet_type =FleetType::get();
     	$routes = VehicleRoute::get();
     	$schedules = Schedule::all();
     	$trips =Trip::with(['fleetType','route','schedule','startFrom','endTo'])->where('status','1')->paginate(10);
     	//dd($trips);

     	return view('home.bus_ticket',compact('fleet_type','routes','schedules','trips'));
     }
}
