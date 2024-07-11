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
    Route::get('/add', [StudentController::class, 'add']);
    Route::post('/add_check', [StudentController::class, 'add_check']);
    Route::post('/save', [StudentController::class, 'save']);
    Route::delete('/delete/{id}', [StudentController::class, 'delete']);
    Route::get('/edit/{id}', [StudentController::class, 'edit']);
    Route::post('/edit_check/{id}', [StudentController::class, 'edit_check']);
    Route::post('/update/{id}', [StudentController::class, 'update']);
});

Route::prefix('class')->group(function () {
    Route::get('/', [ClassController::class, 'index']);
    Route::get('/show_students/{id}', [ClassController::class, 'show_students']);
    Route::get('/delete/{id}', [ClassController::class, 'delete']);
    Route::get('/add', [ClassController::class, 'add']);
    Route::post('/save', [ClassController::class, 'save']);
    Route::get('/edit/{id}', [ClassController::class, 'edit']);
    Route::post('/update/{id}', [ClassController::class, 'update']);
});

Route::prefix('ekskul')->group(function () {
    Route::get('/', [EkskulController::class, 'index']);
    Route::get('/cek', [EkskulController::class, 'check_ekskul']);
    Route::get('/add', [EkskulController::class, 'add']);
    Route::get('/edit/{id}', [EkskulController::class, 'edit']);
    Route::post('/save', [EkskulController::class, 'save']);
    Route::post('/delete', [EkskulController::class, 'delete']);
    Route::post('/update/{id}', [EkskulController::class, 'update']);
});
Route::prefix('teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index']);
    Route::post('/save', [TeacherController::class, 'save']);
    Route::post('/delete', [TeacherController::class, 'delete']);
    Route::post('/update/{id}', [TeacherController::class, 'update']);
});