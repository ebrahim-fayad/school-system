<?php

use App\Http\Controllers\Admin\Classrooms\ClassroomController;
use App\Http\Controllers\Admin\Grade\GradeController;
use App\Http\Controllers\Admin\Parents\ParentController;
use App\Http\Controllers\Admin\Sections\SectionController;
use App\Http\Controllers\Admin\Teachers\TeacherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('dashboard');
})->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    // Route::get('/', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::resource('grades', GradeController::class);
    #=======================   Classrooms Routes   =========================================
    Route::resource('classrooms', ClassroomController::class);
    Route::post('classrooms/deleteAll', [ClassroomController::class, 'deleteAll'])->name('classrooms.deleteAll');
    Route::post('classrooms/FilterClass', [ClassroomController::class, 'FilterClass'])->name('classrooms.FilterClass');
    #=======================   Sections Routes   =========================================
    Route::resource('sections', SectionController::class);
    Route::get('/classes/{id}', [SectionController::class, 'getClasses'])->name('getClasses');
    #=======================   Parents Routes   =========================================
    Route::get('AllParents', ParentController::class)->name('allParents');
    Route::view('MyParents', 'Admin.MyParents.add-parents')->name('MyParents');
    Route::view('Edit-Parents', 'Admin.MyParents.edit-parents')->name('edit-parents');
    #=======================   Teachers Routes   =========================================
    Route::resource('teachers', TeacherController::class);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/livewire/update', $handle);
});
require __DIR__.'/auth.php';
