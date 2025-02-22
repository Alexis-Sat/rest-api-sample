<?php

use Illuminate\Support\Facades\Route;



Route::middleware(\App\Http\Middleware\ApiKeyValidationMiddleware::class)->group(function () {
    Route::prefix('organization')->group(function () {
        Route::get('business/', [\App\Http\Controllers\OrganizationController::class, 'findByBusiness']);
        Route::get('address/', [\App\Http\Controllers\OrganizationController::class, 'findByAddress']);
        Route::get('coordinates/', [\App\Http\Controllers\OrganizationController::class, 'findByCoordinates']);
        Route::get('building/', [\App\Http\Controllers\OrganizationController::class, 'findByBuildingId']);
        Route::get('id/', [\App\Http\Controllers\OrganizationController::class, 'findByOrganizationId']);
        Route::get('name/', [\App\Http\Controllers\OrganizationController::class, 'findByOrganizationName']);
    });
});
