<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
});


Route::controller(UserController::class)->group(function () {

    Route::get('/', 'index')
        ->name('user.index');

    Route::get('/booking/create', 'create')
        ->name('user.booking.name');

    Route::post('/booking/store', 'store')
        ->name('user.store.booking');
});


Route::controller(AdminController::class)->group(function () {

    Route::get('/admin/rooms', 'index')
        ->name('admin.index');

    Route::post('/admin/rooms/create', 'create')
        ->name('admin.room.create');

    Route::post('/admin/rooms/store', 'storeRoom')
        ->name('admin.room.store');

    Route::get('/admin/rooms/show', 'showRooms')
        ->name('admin.room.show');

    Route::get('/admin/rooms/edit', 'editRooms')
        ->name('admin.room.edit');

    Route::get('/admin/rooms/update/{id}', 'updateRooms')
        ->name('admin.rooms.update');

    Route::delete('/admin/rooms/delete/{id}', 'deleteRooms')
        ->name('admin.room.delete');

    Route::get('/admin/booking/show', 'showBooking')
        ->name('admin.booking.show');

    Route::post('/admin/booking/accept/{booking}', 'acceptBooking')
        ->name('admin.booking.accept');

    Route::post('/admin/booking/deny/{booking}', 'denyBooking')
        ->name('admin.booking.deny');
});





// require __DIR__.'/auth.php';
