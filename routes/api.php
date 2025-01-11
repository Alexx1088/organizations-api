<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['validate.api_key'])->group(function () {

    Route::get('buildings/{id?}/organizations', [\App\Http\Controllers\BuildingController::class, 'getOrganizations']);

    Route::get('activities/{activity_id}/organizations', [ActivityController::class, 'organizationsByActivity']);

});


Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);



