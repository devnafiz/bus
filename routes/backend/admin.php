<?php

use App\Http\Controllers\Backend\DashboardController;
use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\GeneralSettingController;

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