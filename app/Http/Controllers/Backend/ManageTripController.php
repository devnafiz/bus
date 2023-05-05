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
use App\Models\AssignedVehicle;



class ManageTripController extends Controller
{
    public function routeList(){

    	$pageTitle = 'All Routes';
        $emptyMessage = 'No route found';
        $routes = VehicleRoute::with(['startFrom','endTo'])->orderBy('id', 'desc')->paginate(10);
        $stoppages = Counter::where('status',1)->get();
        return view('backend.trip.route.list', compact('pageTitle', 'routes', 'emptyMessage', 'stoppages'));

    }

    public function routeCreate(){
         $pageTitle = ' Routes Create';
         $emptyMessage = 'No route found';
         $stoppages = Counter::where('status',1)->get();
         return view('backend.trip.route.create', compact('pageTitle', 'stoppages'));

    }

    public function routeStore(Request $request){
    	//dd($request->all());
         $request->validate([
            'name'=>'required',
            'start_from'=>'required|integer',
            'end_to'=>'required|integer',
            'stoppages'=>'nullable|array|min:1',
            'stoppages.*'=>'nullable|array',
            'distance'=>'required',
            'time'=>'required',


         ]);

         if($request->start_from == $request->end_to){

         	 $notify[] = ['error', 'Starting point and ending point can\'t be same'];
            return back()->withNotify($notify);
         }

          $stoppages = $request->stoppages ? array_filter($request->stoppages):[];


         if(!in_array($request->start_from, $stoppages)){
         	array_unshift($stoppages, $request->start_from);
         }
         //in_array(nedle ,haystack) is nedle searcha aarry in hystack

         if(!in_array($request->end_to, $stoppages)){
         	array_push($stoppages, $request->end_to);
         }

        $route = new VehicleRoute();
        $route->name = $request->name;
        $route->start_from = $request->start_from;
        $route->end_to = $request->end_to;
        $route->stoppages  = array_unique($stoppages);
        $route->distance = $request->distance;
        $route->time = $request->time;
        ///dd( $route);
        $route->save();

        $notify[] = ['success', 'Route save successfully'];
        return back()->withNotify($notify);






    }

    //sehdule

     public function schedules(){
        $pageTitle = 'All Schedules';
        $emptyMessage = 'No schedule found';
        $schedules = Schedule::orderBy('id', 'desc')->paginate(10);
        return view('backend.trip.schedule.index', compact('pageTitle','emptyMessage', 'schedules'));
    }


    public function schduleStore(Request $request){
            //dd($request->all());
    	$request->validate([
            'start_from'   => 'required|date_format:H:i',
            'end_at'       => 'required|date_format:H:i',
        ]);

        $check = Schedule::where('start_from', Carbon::parse($request->start_from)->format('H:i:s'))->where('end_at', Carbon::parse($request->end_at)->format('H:i:s'))->first();
        if($check){
            $notify[] = ['error', 'This schedule has already added'];
            return redirect()->back()->withNotify($notify);
        }

        Schedule::create([
            'start_from' => $request->start_from,
            'end_at'     => $request->end_at
        ]);

        $notify[] = ['success', 'Schedule save successfully'];
        return back()->withNotify($notify);
    }


    //trip 

     public function trips(){
             $pageTitle = 'All Schedules';
             $emptyMessage = 'No schedule found';
             $fleetTypes = FleetType::where('status', 1)->get();
             $routes = VehicleRoute::where('status', 1)->get();
             $schedules = Schedule::where('status', 1)->get();
             $stoppages = Counter::where('status', 1)->get();

             $trips =Trip::with('fleetType','route','schedule')->orderBy('id','desc')->paginate(10);


             return view('backend.trip.index', compact('pageTitle', 'stoppages','fleetTypes','routes','schedules','stoppages','trips','emptyMessage'));


     }


     public function tripStore(Request $request){
        //dd($request->all());

        $request->validate([
            'title'      => 'required',
            'fleet_type' => 'required|integer|gt:0',
            'route'      => 'required|integer|gt:0',
            'schedule'   => 'required|integer|gt:0',
            'start_from' => 'required|integer|gt:0',
            'end_to'     => 'required|integer|gt:0',
            'day_off'    => 'nullable|array|min:1'
        ]);

        $trip = new Trip();
        $trip->title = $request->title;

        $trip->fleet_type_id = $request->fleet_type;
        $trip->vehicle_route_id = $request->route;
        $trip->schedule_id = $request->schedule;
        $trip->start_from = $request->start_from;

        $trip->end_to = $request->end_to;
        $trip->day_off = $request->day_off ?? [];
         //dd( $trip->day_off);
        $trip->save();

        $notify[] = ['success', 'Trip save successfully'];
        return back()->withNotify($notify);
     }


     //assigned vehicle

     public function assignedVehicleLists(){

        $pageTitle = "All Assigned Vehicles";
        $emptyMessage = "No assigned vehicle found";
        $trips = Trip::with('fleetType.activeVehicles')->where('status', 1)->get();
        $assignedVehicles=AssignedVehicle::with('trip','vehicle')->orderBy('id','desc')->paginate(10);

        return  view('backend.trip.assigned.index',compact('pageTitle','emptyMessage','trips','assignedVehicles'));
     }

     public  function assignVehicle(Request $request){

        $request->validate([
            'trip'=>'required|integer',
            'vehicle'=>'required|integer'

        ]);

        $trip_check =AssignedVehicle::where('trip_id',$request->trip)->first();

         if($trip_check){
            $notify[]=['error','A vehicle had already been assinged to this trip'];
            return back()->withNotify($notify);
        }

        $trip =Trip::where('id',$request->trip)->with('schedule')->firstOrFail();
      
        $start_time =Carbon::parse($trip->schedule->start_from)->format('H:i:s');
        $end_time =Carbon::parse($trip->schedule->end_from)->format('H:i:s');
          //dd($end_time);

          //Check if the vehicle assgined to another vehicle on this time

          $vehicle_check=AssignedVehicle::where(function($q) use($request,$start_time,$end_time){
              $q->where('start_from','>=' ,$start_time)
                ->where('start_from','=>',$end_time)
                ->where('vehicle_id',$request->vehicle);


          })
          ->orWhere(function($q) use($start_time,$end_time,$request){
               $q->where('end_at','>=' ,$start_time)
                ->where('end_at','=>',$end_time)
                ->where('vehicle_id',$request->vehicle);

          })->first();

          if($vehicle_check){

               $notify[]=['error','A vehicle had already been assinged to this trip'];
            return back()->withNotify($notify);

          }

          $assignedVehicale =new AssignedVehicle();
          $assignedVehicale->trip_id = $request->trip;
          $assignedVehicale->vehicle_id = $request->vehicle;
          $assignedVehicale->start_from = $trip->schedule->start_from;
          $assignedVehicale->end_at = $trip->schedule->end_at;
          $assignedVehicale->save();
          
          $notify[] = ['success', 'Vehicle assigned successfully.'];
        return back()->withNotify($notify);




     }


    

}
