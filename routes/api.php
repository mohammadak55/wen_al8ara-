<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\GetterEventController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SetterEventController;
use Illuminate\Support\Facades\Route;

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
//getter
Route::get('/ShowEventDetail/{id}', [GetterEventController::class, 'ShowEventDetail']);
Route::get('/fillterEvent/{regions?}/{eventType?}', [GetterEventController::class, 'fillterEvent']);
Route::get('/ShowEvents', [GetterEventController::class, 'ShowEvents']);


Route::get('/getLocations', [LocationController::class, 'showLocations']);
Route::post('/sendNotificationToTopic', [NotificationController::class, 'sendNotificationToTopic']);


Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::middleware('auth:sanctum', 'throttle:60,1')->group(function () {

    //setter
    Route::post('/StoreEvents', [SetterEventController::class, 'StoreEvents']);
    Route::post('/UpdateEventDetail/{id}', [SetterEventController::class, 'UpdateEventDetail']);
});
