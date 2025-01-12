<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['validate.api_key'])->group(function () {

    Route::get('buildings/{id?}/organizations', [\App\Http\Controllers\BuildingController::class, 'getOrganizations']);

    Route::get('activities/{activity_id}/organizations', [ActivityController::class, 'organizationsByActivity']);

    Route::get('organizations/rectangle', [OrganizationController::class, 'organizationsByRectangle']);

    Route::get('organization/{organization_id}', [OrganizationController::class, 'organizationById']);

});


Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);



