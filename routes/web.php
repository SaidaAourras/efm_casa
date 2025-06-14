<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::controller(EventController::class)->group(function () {
        Route::prefix('/events')->group(function () {
            Route::name('events.')->group(function () {
                Route::get('/',  'userIndex')->name('index');
                Route::get('/create',  'create')->name('create');
                Route::post('/store',  'store')->name('store');
            });
        });
    });
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/events', [EventController::class, 'adminIndex'])->name('admin.index');
});

require __DIR__ . '/auth.php';
