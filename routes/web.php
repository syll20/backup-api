<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\clubController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\Head2headController;
use App\Http\Controllers\ScorerController;
use App\Http\Controllers\StandingController;
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
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/create',  [FixtureController::class, 'create'])->name('template_create');
        Route::post('/generate',  [FixtureController::class, 'store'])->name('template_generate');
        Route::get('/lists', [FixtureController::class, 'index'])->name('template_lists');
        Route::get('/lists/{fixture}', [FixtureController::class, 'show'])->name('show');

        Route::get('/standings', [StandingController::class, 'index'])->name('standings');
        Route::get('/standings/{location}', [StandingController::class, 'show'])->name('show_standing');
        Route::patch('/standings', [StandingController::class, 'update'])->name('update_standing');  

        Route::patch('/scorer', [ScorerController::class, 'update'])->name('admin_update_scorers');

        Route::get('/calendars', [CalendarController::class, 'index'])->name('admin_calendars');
        Route::patch('/calendars', [CalendarController::class, 'update'])->name('admin_update_calendars');

        Route::get('/h2h', [Head2headController::class, 'index'])->name('admin_h2h');
        Route::post('/h2h/import', [Head2headController::class, 'store'])->name('admin_h2h_import');
        Route::get('/h2h/show', [Head2headController::class, 'show'])->name('admin_h2h_show');

        Route::get('/clubs', [clubController::class, 'index'])->name('admin_clubs');
        Route::get('/clubs/import', [clubController::class, 'import'])->name('admin_clubs_import');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
