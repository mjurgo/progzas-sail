<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProfileController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('grades', GradeController::class);

Route::prefix('students')->name('students.')->group(function () {
    Route::get('', [StudentController::class, 'index'])->name('index');
    Route::get('/{id}', [StudentController::class, 'show'])->name('show');
    Route::post('/{id}', [StudentController::class, 'addGrade'])->name('addGrade');
    Route::put('/{id}', [StudentController::class, 'changeGrade'])->name('changeGrade');
    Route::delete('/{id}', [StudentController::class, 'deleteGrade'])->name('deleteGrade');
});

require __DIR__.'/auth.php';
