<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return view('index');
});
Route::get('{page}', [DashboardController::class, 'index'])->where('page', '[A-Za-z0-9\-]+');