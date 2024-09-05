<?php

use App\Http\Controllers\Teachers\OnlineClasses\OnlineClassController;
use Illuminate\Support\Facades\Route;






/*
|--------------------------------------------------------------------------
| Teachers Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('onlineClasses', OnlineClassController::class);
});
