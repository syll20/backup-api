<?php

use App\Enums\Location;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\ScorerController;
use App\Http\Controllers\StandingController;
use App\Models\Calendar;
use Illuminate\Support\Facades\Route;

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

Route::get('/lists', [FixtureController::class, 'index'])->name('lists');
Route::get('/lists/{fixture}', [FixtureController::class, 'show'])->name('show');
Route::get('/create',  [FixtureController::class, 'create'])->name('create');
Route::post('/generate',  [FixtureController::class, 'store'])->name('generate');

/**
 * TODO :: Ajouter middleware group -> admin
 */

Route::get('/admin/standings', [StandingController::class, 'index'])->name('standings');
Route::get('/admin/standings/{location}', [StandingController::class, 'show'])->name('show_standing');
Route::patch('/admin/standings', [StandingController::class, 'update'])->name('update_standing');  

Route::patch('/admin/scorer', [ScorerController::class, 'update'])->name('admin_update_scorers');

Route::get('/admin/calendars', [CalendarController::class, 'index'])->name('admin_calendars');
Route::patch('/admin/calendars', [CalendarController::class, 'update'])->name('admin_update_calendars');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
