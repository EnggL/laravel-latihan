<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        // $teachers = Teacher::with(['kelas', 'ekskuls'])->get();
        $teachers = Teacher::all();
        // dd($teachers);

        return view("teacher",
        [
            "active"=> 'teachers',
            "teachers"=> $teachers
        ]);
    }
}
