<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventSPPDController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerjalananController as ControllersPerjalananController;
use App\Models\PerjalananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/access_denied', function () {
    return view('access_denied');
});


Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
    Route::resource('events', EventController::class);

    Route::get('/create/{date}', [EventController::class, 'create1']);
    Route::post('/create/{date}', [EventController::class, 'store1'])->name('events.store1');;
    Route::get('/edit/{id}', [EventController::class, 'edit1']);
    Route::post('/edit/{id}', [EventController::class, 'update']);
    Route::get('perjalanan/{id}', [EventController::class, 'show']);
    Route::delete('perjalanan/{id}', [EventController::class, 'destroy']);
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('events/list', [EventController::class, 'listEvent'])->name('events.list');
// Route::resource('events', EventController::class);

// Route::get('/login',[LoginController::class,'index']);
// Route::post('/login',[LoginController::class,'authenticate']);

// Route::get('/create/{date}', [EventController::class, 'create1']);
// Route::post('/create/{date}', [EventController::class, 'store1'])->name('events.store1');;


// Route::get('/edit/{id}', [EventController::class, 'edit1']);

// // Route::get('perjalanan/{id}/edit', [EventController::class, 'edit']);

// Route::get('perjalanan/{id}', [EventController::class, 'show']);

// Route::delete('perjalanan/{id}', [EventController::class, 'destroy']);

// Route::delete('perjalanan/{id}', 'EventController@destroy');



////////////////////////////////////////////////////////////////////////////

// Route::resource('/perjalanan', EventSPPDController::class);
// Route::get('perjalanan/list', [EventSPPDController::class, 'listEvent'])->name('perjalanan.list');
