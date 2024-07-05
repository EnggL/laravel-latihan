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

Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);
    Route::delete('/delete/{id}', [StudentController::class, 'delete']);
    Route::get('/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/edit_check/{id}', [StudentController::class, 'edit_check']);
    Route::post('/update/{id}', [StudentController::class, 'update']);
});

Route::get('/class', [ClassController::class, 'index']);
Route::prefix('ekskul')->group(function () {
    Route::get('/', [EkskulController::class, 'index']);
    Route::get('/cek', [EkskulController::class, 'check_ekskul']);
});
Route::get('/teachers', [TeacherController::class, 'index']);