<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeatLayout;
use App\Models\FleetType;
use App\Models\Vehicle;

class ManageFleetController extends Controller
{
    public function seatLayouts(){

       $pageTitle = 'All Seat Layout';
       $emptyMessage = 'No counter found';
       $layouts =SeatLayout::paginate(10);
       return view('backend.seat.seat_layout',compact('pageTitle','emptyMessage','layouts'));

    }

    public function seatLayoutStore (Request $request){
    	$request->validate([
          'layout'=>'required|unique:seat_layouts'
    	]);

    	$seatLayout = new SeatLayout();
        $seatLayout->layout = $request->layout;
        $seatLayout->save();
        $notify[] = ['success', 'Seat layout saved successfully.'];
        return back()->withNotify($notify);

    }

    public function fleetLists(){

    	$pageTitle = 'Fleet Type';
        $emptyMessage = 'No fleet type found';
        $seatLayouts = SeatLayout::all();
        $fleetType = FleetType::orderBy('id','desc')->paginate(10);
        $facilities = getContent('amenities.element');
        //todo amenities

         return view('backend.seat.fleet',compact('pageTitle','emptyMessage','fleetType','facilities','seatLayouts'));


    }
     public function fleetTypeStore(Request $request){
     	//dd($request->all());
        $request->validate([
            'name'        => 'required|unique:fleet_types',
            'seat_layout' => 'required',
            'deck'        => 'required|numeric|gt:0',
            'deck_seats'  => 'required|array|min:1',
            'deck_seats.*'=> 'required|numeric|gt:0',
            'facilities.*'=> 'string'
        ],[
            'deck_seats.*.required'  => 'Seat number for all deck is required',
            'deck_seats.*.numeric'   => 'Seat number for all deck is must be a number',
            'deck_seats.*.gt:0'      => 'Seat number for all deck is must be greater than 0',
        ]);
        
        $fleetType = new FleetType();
        $fleetType->name = $request->name;
        $fleetType->seat_layout = $request->seat_layout;
        $fleetType->deck = $request->deck;
        $fleetType->deck_seats = $request->deck_seats;
        $fleetType->has_ac = $request->has_ac ? 1 : 0;
        $fleetType->facilities = $request->facilities ?? null;
        $fleetType->status = 1;
        $fleetType->save();

        $notify[] = ['success','Fleet type saved successfully'];
        return back()->withNotify($notify);
    }

    //vehicle

    public function vehicles(){

        $pageTitle = 'All Seat Layout';
        $emptyMessage = 'No counter found';
        $seatLayouts = SeatLayout::all();
        $fleetType = FleetType::orderBy('id','desc')->get();
        $vehicles = Vehicle::with('fleetType')->orderBy('id','desc')->paginate(10);

       return view('backend.seat.vehicles', compact('pageTitle', 'emptyMessage', 'vehicles', 'fleetType'));
    }

    public function vehiclesStore(Request $request){
         $this->validate($request,[
            'nick_name'         => 'required|string',
            'fleet_type'        => 'required|numeric',
            'register_no'       => 'required|string|unique:vehicles',
            'engine_no'         => 'required|string|unique:vehicles',
            'model_no'          => 'required|string',
            'chasis_no'         => 'required|string|unique:vehicles',
        ]);

        $vehicle = new Vehicle();
        $vehicle->nick_name = $request->nick_name;
        $vehicle->fleet_type_id = $request->fleet_type;
        $vehicle->register_no = $request->register_no;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->chasis_no = $request->chasis_no;
        $vehicle->model_no = $request->model_no;
        $vehicle->save();

        $notify[] = ['success', 'Vehicle save successfully.'];
        return back()->withNotify($notify);

    }

    //search

    public function vehicleSearch(Request $request){

          $search = $request->search;
          //dd($search);
          $pageTitle = 'Vehicles - '. $search;
          $emptyMessage = 'No vehicles found';
          $fleetType = FleetType::orderBy('id','desc')->get();

          $vehicles = Vehicle::with('fleetType')->where('register_no',$search)->orderBy('id','desc')->paginate(10);

          return view('backend.seat.vehicles', compact('pageTitle', 'emptyMessage', 'vehicles', 'fleetType'));


    }
}
