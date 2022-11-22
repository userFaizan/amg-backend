<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TaskController;

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
    return view('auth.login');
});
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('/custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('/driverlist',[AuthController::class,'index_driver'])->name('driver.driverlist');
Route::get('/edit/{id}',[AuthController::class,'edit'])->name('driver.edit');
Route::post('/update',[AuthController::class,'update'])->name('driver.update');
Route::get('/delete/{id}',[AuthController::class,'destroy'])->name('driver.destroy');
Route::get('/tasklist',[TaskController::class,'tasklist'])->name('tasklist');