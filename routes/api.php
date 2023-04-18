<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataDisabilityAndWorkshopController;
use App\Http\Controllers\DetailProfileController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProvinceCityController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserVerificationController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/verification/disability', [UserVerificationController::class, 'disability']);
    Route::post('/verification/workshop', [UserVerificationController::class, 'workshop']);
    Route::get('/province', [ProvinceCityController::class, 'getProvince']);
    Route::get('/city', [ProvinceCityController::class, 'getCity']);
    Route::get('/profile/detail', [DetailProfileController::class, 'getDetailProfile']);
    Route::post('/profile/update', [DetailProfileController::class, 'editProfile']);
    Route::get('/workshop', [DataDisabilityAndWorkshopController::class, 'getDataWorkshop']);
    Route::get('/disability', [DataDisabilityAndWorkshopController::class, 'getDataDisability']);
    Route::post('/information/create', [InformationController::class, 'createInformation']);
    Route::post('/information/update/{id}', [InformationController::class, 'updateInformation']);
    Route::delete('/information/delete/{id}', [InformationController::class, 'deleteInformation']);
    Route::get('/information/get', [InformationController::class, 'getInformation']);
    Route::get('/notification', [NotificationController::class, 'getNotification']);
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);