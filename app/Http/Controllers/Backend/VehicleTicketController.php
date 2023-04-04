<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketPrice;

use App\Models\VehicleRoute;
use App\Models\Counter;
use App\Models\FleetType;
use App\Models\Schedule;
use App\Models\Trip;
use Carbon\Carbon;

class VehicleTicketController extends Controller
{
    //ticket price

    public function ticketPriceList(){

    	 $pageTitle = 'All Ticket price';
         $emptyMessage = 'No schedule found';
         $routes = VehicleRoute::where('status',1)->get();
          $fleettype=FleetType::where('status',1)->get();
         $prices=TicketPrice::orderBy('id','desc')->paginate(10);
         return view('backend.trip.ticket.index',compact('routes','emptyMessage','pageTitle','fleettype','prices'));
    }


    public function ticketPriceCreate(){

    	 $pageTitle = ' Ticket Create';
         $emptyMessage = 'No schedule found';
         $routes =VehicleRoute::where('status',1)->get();
         $fleettypes = FleetType::where('status',1)->get();

         return view('backend.trip.ticket.create',compact('routes','emptyMessage','pageTitle','fleettypes'));
    }


    public function ticketPriceStore(Request $request){

      dd($request->all());

    }

    public function getRouteData(Request $request){

        $route      = VehicleRoute::where('id', $request->vehicle_route_id)->where('status', 1)->first();

         $check      = TicketPrice::where('vehicle_route_id', $request->vehicle_route_id)->where('fleet_type_id', $request->fleet_type_id)->first();

         if($check){

         	return response()->json(['error'=> trans('You have added prices for this fleet type on this route')]);
         }
         $stoppages  = array_values($route->stoppages);
         $stoppages  = stoppageCombination($stoppages, 2);
         //dd( $stoppages);
        return view('backend.trip.ticket.route_data', compact('stoppages', 'route'));
    	
    }


}
