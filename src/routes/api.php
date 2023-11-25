<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::post('auth', \App\Http\Controllers\AuthController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user', \App\Http\Controllers\UserController::class);
    Route::post('tag', \App\Http\Controllers\TagController::class);
    Route::post('applicant', \App\Http\Controllers\ApplicantController::class);
    Route::post('demand', \App\Http\Controllers\DemandController::class);
    Route::post('role', \App\Http\Controllers\RoleController::class);
    Route::post('district', \App\Http\Controllers\DistrictController::class);
    Route::post('common', \App\Http\Controllers\CommonController::class);
    Route::post('permission', \App\Http\Controllers\PermissionController::class);
    Route::post('country', \App\Http\Controllers\CountryController::class);
    Route::post('state', \App\Http\Controllers\StateController::class);
    Route::post('city', \App\Http\Controllers\CityController::class);
    Route::post('color', \App\Http\Controllers\ColorController::class);
    Route::post('university', \App\Http\Controllers\UniversityController::class);
});
