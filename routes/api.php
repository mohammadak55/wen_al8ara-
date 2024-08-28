<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
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

Route::get('/ShowEventDetail', [EventController::class, 'ShowEventDetail']);
Route::get('/fillterEvent/{regions}', [EventController::class, 'fillterEvent']);
Route::get('/ShowEvents', [EventController::class, 'ShowEvents']);
Route::get('/getLocations', [EventController::class, 'showLocations']);
Route::post('/sendNotificationToTopic', [NotificationController::class, 'sendNotificationToTopic']);


Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::middleware('auth:sanctum', 'throttle:60,1')->group(function () {
    Route::post('/StoreEvents', [EventController::class, 'StoreEvents']);
    Route::post('/UpdateEventDetail/{id}', [EventController::class, 'UpdateEventDetail']);

    });


