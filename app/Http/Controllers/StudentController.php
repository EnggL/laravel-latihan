<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Ekskul;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::with(['kelas.wali', 'ekskuls'])->limit(15)->get();
        // dd($student);

        return view("student",
        [
            "active"=> 'students',
            "studentList"=> $student
        ]);
    }

    public function delete($id)
    {
        $deletedStudent = Student::findOrFail($id);
        $deletedStudent->delete();

        return $deletedStudent;
    }

    public function edit($id)
    {
        $student = Student::with(['kelas.wali', 'ekskuls'])->findOrFail($id);
        $class = ClassRoom::all();
        $ekskul = Ekskul::all();
        // dd($class);
        return view("student-edit",
        [
            "active"        => 'students',
            "student"       => $student,
            "class_list"    => $class,
            "ekskul_list"   => $ekskul
        ]);
    }

    public function edit_check(Request $request)
    {

    }
}
