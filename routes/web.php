<?php

use App\Http\Controllers\DoctorController;
use App\Models\Doctor;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::resource('/doctor', DoctorController::class);


