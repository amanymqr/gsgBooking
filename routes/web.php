<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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


Route::get('/', [UserController::class, 'index']);

Route::get('/booking/create', [UserController::class, 'create']);
Route::post('/booking', [UserController::class, 'store']);


Route::controller(AdminController::class)->group(function () {

    Route::get('/admin/rooms', 'index')
        ->name('admin.index');
    Route::post('/admin/rooms/create', 'create')
        ->name('admin.rooms.create');
    Route::post('/admin/rooms/store', 'storeRoom')
        ->name('admin.rooms.store');

});




// require __DIR__.'/auth.php';
