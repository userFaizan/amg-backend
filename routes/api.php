<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ShipmentController;
use App\Http\Controllers\Api\TasController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\NoteController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']);


//user authentication
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('forgot_password', [RegisterController::class, 'forgot_password']);
Route::post('match_otp',[RegisterController::class,'match_otp']);

Route::middleware(['auth:api'])->group(function(){
  

    Route::post('reset_password',[RegisterController::class,'reset_password']);
    Route::post('update_password',[RegisterController::class,'update_password']);
    Route::post('logout',[RegisterController::class,'logout']);


  //get users
  Route::get('/get_user',[UserController::class,'get_user'])->name('get_user');


  //Tasks
  Route::post('/add_task',[TasController::class,'store'])->name('store');
  Route::get('/get_alltask',[TasController::class,'get_alltask'])->name('get_alltask');
  Route::get('/get_authtask',[TasController::class,'get_authtask'])->name('get_authtask');
  Route::post('/allupdate',[TasController::class,'allupdate'])->name('allupdate');
  Route::post('/statusupdate',[TasController::class,'statusupdate'])->name('statusupdate');
  Route::get('/get_task_by_shipment',[TasController::class,'get_status'])->name('get_status');
  Route::post('/change_task_status',[TasController::class,'change_task_status'])->name('change_task_status');

  //shipments
  Route::get('/get_shipment_status',[ShipmentController::class,'get_shipment'])->name('get_shipment');

//Expense api's
  Route::post('/add_expense',[ExpenseController::class,'store_expense'])->name('store_expense');
  Route::get('/get_expense',[ExpenseController::class,'get_expense'])->name('get_expense');


  //Delivery api's
  Route::post('/add_delivery',[DeliveryController::class,'store_delivery'])->name('store_delivery');
  Route::get('/get_delivery',[DeliveryController::class,'get_delivery'])->name('get_delivery');


//Notes api's
  Route::post('/add_notes',[NoteController::class,'store_notes'])->name('store_notes');
  Route::get('/get_notes',[NoteController::class,'get_notes'])->name('get_notes');

});
