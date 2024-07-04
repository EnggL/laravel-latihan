<?php

use App\Http\Controllers\EkskulController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/cek', function () {
    return view('cek');
});

Route::get('/cek/{id}', function ($id) {
    return view('cek-kodam', ['id' => $id]);
});

Route::get('/students', [StudentController::class, 'index']);
Route::prefix('students')->group(function () {
    Route::delete('/delete/{id}', [StudentController::class, 'delete']);
    Route::get('/edit/{id}', [StudentController::class, 'edit']);
    Route::get('/edit_check', [StudentController::class, 'edit']);
});

Route::get('/class', [ClassController::class, 'index']);
Route::get('/ekskul', [EkskulController::class, 'index']);
Route::get('/teachers', [TeacherController::class, 'index']);