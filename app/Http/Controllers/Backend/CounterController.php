<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;

class CounterController extends Controller
{
    public function counters(){
       $pageTitle = 'All Counter';
       $emptyMessage = 'No counter found';
       $counters =Counter::paginate(10);
       return view('backend.counter.index',compact('pageTitle','emptyMessage','counters'));

    }

    public function counterStore(Request $request){
    	$request->validate([

         'name'=>'required|unique:counters',
         'city' =>'required',
         'mobile' => 'required|numeric|unique:counters'
    	]);

    	$counter = new Counter();
        $counter->name      =  $request->name;
        $counter->city      =  $request->city;
        $counter->location  =  $request->location;
        $counter->mobile    =  $request->mobile;
        $counter->save();

        return redirect()->back()->with('success','successfully add');

    }

    public function counterUpdate(Request $request,$id){

    }

    public function counterActiveDisabled(){


    }
}
