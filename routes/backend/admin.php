<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\GeneralSettingController;
use App\Http\Controllers\Backend\CounterController;

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