<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\User;

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
    return view('login');
});

Route::get('register', function () {
    return view('register');
});


Route::post('/register', [AdminController::class, 'register'])->name('register');
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::get('dashboard', [AdminController::class, 'dashboard']); 
Route::get('logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/address', [AdminController::class, 'address'])->name('address');
Route::any('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
Route::any('/search', [AdminController::class, 'search']);