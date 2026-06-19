<?php

use App\Http\Controllers\HospitalController;
use Illuminate\Support\Facades\Route;

Route::get('/hospitals', [HospitalController::class, 'getHospitals']);
Route::get('/hospitals/{id}', [HospitalController::class, 'getHospitalItem']);
Route::post('/hospitals', [HospitalController::class, 'createHospital']);
Route::patch('/hospitals/{id}', [HospitalController::class, 'patchHospital']);
Route::delete('/hospitals/{id}', [HospitalController::class, 'deleteHospital']);