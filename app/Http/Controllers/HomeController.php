<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FleetType;
use App\Models\Schedule;
use App\Models\Trip;
use Carbon\Carbon;




class HomeController extends Controller
{
     public function index(){

     	return view('home.index');
     }


     public function busManage(){
     	$fleet_type =FleetType::get();

     	return view('home.bus_ticket',compact('fleet_type'));
     }
}
