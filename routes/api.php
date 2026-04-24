<?php

use App\Http\Controllers\Api\EventController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('events', EventController::class);
    Route::get('events/by-room/{room}', [EventController::class, 'byRoom']);
    Route::get('events/current', [EventController::class, 'current']);
});
