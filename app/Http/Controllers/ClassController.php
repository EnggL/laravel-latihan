<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\ValidationException;

class ClassController extends Controller
{
    public function index()
    {
        $kelas = ClassRoom::with([
            'siswa' => function($query){
                $query->limit(5);
            },
            'wali'
            ])->get();

        return view("class",
        [
            "active"=> 'class',
            'css' => ['kelas.css'],
            'js' => ['class/class.js'],
            'plugin' => ['sweet-alert', 'datatables'],
            "kelas"=> $kelas
        ]);
    }

    function show_students(Request $request)
    {
        if (!isset($request->id)) {
            throw ValidationException::withMessages(['message' => 'ID tidak boleh kosong']);
        }

        if (!is_numeric($request->id)) {
            throw ValidationException::withMessages(['message' => 'Invalid ID ('.$request->id.')']);
        }

        $students = Student::where('class_id', $request->id)->get();
        return view("class-student",
        [
            "students"=> $students
        ]);
    }

    function check_ekskul(Request $request)
    {
        $list_ekskul = $request->collect();

        return $list_ekskul;
    }
}
