<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\GeneralSettingController;
use App\Http\Controllers\Backend\CounterController;
use App\Http\Controllers\Backend\ManageFleetController;
use App\Http\Controllers\Backend\ManageTripController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

 
 // General Setting
 Route::get('general-setting', [GeneralSettingController::class,'index'])->name('setting.index');
 Route::post('general-setting', [GeneralSettingController::class,'update'])->name('setting.update');

 //manage trip

 Route::name('trip.')->prefix('manage')->group(function(){
 	        Route::get('route', 'ManageTripController@routeList')->name('route');



            //trip
            Route::get('trip', [ManageTripController::class,'trips'])->name('list');
            Route::post('trip', [ManageTripController::class,'tripStore'])->name('store');
            Route::post('trip/update/{id}', [ManageTripController::class,'tripUpdate'])->name('update');
            Route::post('trip/active-disable', [ManageTripController::class,'tripActiveDisable'])->name('active.disable');


 });

 //manage counter
        Route::name('manage.')->prefix('manage')->group(function(){
            Route::get('counter', [CounterController::class,'counters'])->name('counter');
            Route::post('counter', [CounterController::class,'counterStore'])->name('counter.store');
            Route::post('counter/update/{id}', [CounterController::class,'counterUpdate'])->name('counter.update');
            Route::post('counter/active-disable', [CounterController::class,'counterActiveDisabled'])->name('counter.active.disable');
        });

         // Fleet & Trip manage
       Route::name('fleet.')->prefix('manage')->group(function(){
            //seat layouts
            Route::get('seat_layouts', [ManageFleetController::class,'seatLayouts'])->name('seat.layouts');
            Route::post('seat_layouts', [ManageFleetController::class,'seatLayoutStore'])->name('seat.layouts.store');
            Route::post('seat_layouts/remove', [ManageFleetController::class,'seatLayoutDelete'])->name('seat.layouts.delete');
            Route::post('seat_layouts/{id}', [ManageFleetController::class,'seatLayoutUpdate'])->name('seat.layouts.update');

            //fleet type
            Route::get('fleet-type', [ManageFleetController::class,'fleetLists'])->name('type');
            Route::post('fleet-type', [ManageFleetController::class,'fleetTypeStore'])->name('type.store');
            Route::post('fleet-type/update/{id}', [ManageFleetController::class,'fleetTypeUpdate'])->name('type.update');
            Route::post('fleet-type/active-disable', [ManageFleetController::class,'fleetEnableDisabled'])->name('type.active.disable');

            //vechiles
            Route::get('vehicles', [ManageFleetController::class,'vehicles'])->name('vehicles');
            Route::post('vehicles', [ManageFleetController::class,'vehiclesStore'])->name('vehicles.store');
            Route::post('vehicles/update/{id}', [ManageFleetController::class,'vehiclesUpdate'])->name('vehicles.update');
            Route::post('vehicles/active-disable', [ManageFleetController::class,'vehiclesActiveDisabled'])->name('vehicles.active.disable');
            Route::get('vehicles/search', [ManageFleetController::class,'vehicleSearch'])->name('vehicles.search');
        });




        Route::name('trip.')->prefix('manage')->group(function(){
            //route
            Route::get('route', [ManageTripController::class,'routeList'])->name('route');
            Route::get('route/create', [ManageTripController::class,'routeCreate'])->name('route.create');
            Route::get('route/edit/{id}', [ManageTripController::class,'routeEdit'])->name('route.edit');
            Route::post('route', [ManageTripController::class,'routeStore'])->name('route.store');
            Route::post('route/update/{id}', [ManageTripController::class,'routeUpdate'])->name('route.update');
            Route::post('route/active-disable',[ManageTripController::class,'routeActiveDisabled'])->name('route.active.disable');

            //schedule
            Route::get('schedule', [ManageTripController::class,'schedules'])->name('schedule');
            Route::post('schedule', [ManageTripController::class,'schduleStore'])->name('schedule.store');
            Route::post('schedule/update/{id}', [ManageTripController::class,'schduleUpdate'])->name('schedule.update');
            Route::post('schedule/active-disable', [ManageTripController::class,'schduleActiveDisabled'])->name('schedule.active.disable');

            //ticket price
            Route::get('ticket-price', 'VehicleTicketController@ticketPriceList')->name('ticket.price');
            Route::get('ticket-price/create', 'VehicleTicketController@ticketPriceCreate')->name('ticket.price.create');
            Route::post('ticket-price', 'VehicleTicketController@ticketPriceStore')->name('ticket.price.store');
            Route::get('route-data', 'VehicleTicketController@getRouteData')->name('ticket.get_route_data');
            Route::get('ticket-price/check_price', 'VehicleTicketController@checkTicketPrice')->name('ticket.check_price');
            Route::get('ticket-price/edit/{id}', 'VehicleTicketController@ticketPriceEdit')->name('ticket.price.edit');
            Route::post('ticket-price/update/{id}', 'VehicleTicketController@ticketPriceUpdate')->name('ticket.price.update');
            Route::post('ticket-price/delete', 'VehicleTicketController@ticketPriceDelete')->name('ticket.price.delete');

            //trip
            Route::get('trip', 'ManageTripController@trips')->name('list');
            Route::post('trip', 'ManageTripController@tripStore')->name('store');
            Route::post('trip/update/{id}', 'ManageTripController@tripUpdate')->name('update');
            Route::post('trip/active-disable', 'ManageTripController@tripActiveDisable')->name('active.disable');

            //assigned vehicle
            Route::get('assigned-vehicle', 'ManageTripController@assignedVehicleLists')->name('vehicle.assign');
            Route::post('assigned-vehicle', 'ManageTripController@assignVehicle')->name('vehicle.assign');
            Route::post('assigned-vehicle/update/{id}', 'ManageTripController@assignedVehicleUpdate')->name('assigned.vehicle.update');
            Route::post('assigned-vehicle/active-disable', 'ManageTripController@assignedVehicleActiveDisabled')->name('assigned.vehicle.active.disable');
        });

