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
}
