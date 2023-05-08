<?php

//use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

use App\Http\Controllers\HomeController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
// Route::get('/', [HomeController::class, 'index'])
//     ->name('index')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->push(__('Home'), route('frontend.index'));
//     });

// Route::get('terms', [TermsController::class, 'index'])
//     ->name('pages.terms')
//     ->breadcrumbs(function (Trail $trail) {
//         $trail->parent('frontend.index')
//             ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
//     });

 Route::get('/', [HomeController::class, 'index'])
     ->name('index')
    ->breadcrumbs(function (Trail $trail) {
         $trail->push(__('Home'), route('frontend.index'));
     });

 Route::get('/bus-ticket', [HomeController::class, 'busManage'])
     ->name('bus.ticket');

 Route::get('ticket/search',[HomeController::class,'search'])->name('search'); 

 Route::get('/ticket/{id}/{slug}', [HomeController::class,'showSeat'])->name('ticket.seats');   
 Route::post('/ticket/book/{id}', [HomeController::class,'bookTicket'])->name('ticket.book');

    
