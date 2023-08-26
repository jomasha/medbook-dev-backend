<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PatientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



//Patient Api
Route::prefix("patient")->group(function (){
   Route::get('/', [PatientController::class, "fetchAll"]);
   Route::post('/', [PatientController::class, "store"]);
   Route::get('/getGender', [PatientController::class, "getGender"]);
   Route::get('/getService', [PatientController::class, "getService"]);
});

