<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Department\Department;
use App\Http\Livewire\Ticket\TicketResource;
use App\Http\Livewire\Category\CategoryResource;
use App\Http\Livewire\Department\DepartmentResource;
use App\Http\Livewire\Plan\PlanResource;
use App\Http\Livewire\Ticket\TicketView;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    /*********** ticket *****************************/
    Route::get('/tickets', TicketResource::class)->name('tickets');
    Route::get('/ticket-view/{ticketId}', TicketView::class)->name('tickets.show');

    /*********** department *****************************/
    Route::get('/departments', DepartmentResource::class)->name('departments');

    /*********** category *****************************/
    Route::get('/categories', CategoryResource::class)->name('categories');

    /********************* Plan ****************************************/
    Route::get('/plans', PlanResource::class)->name('plans');
});
