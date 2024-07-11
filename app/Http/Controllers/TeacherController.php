<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    public function index()
    {
        // $teachers = Teacher::with(['kelas', 'ekskuls'])->get();
        $teachers = Teacher::orderBy('name')->get();
        // dd($teachers);

        return view("teacher",
        [
            "title"=> "Guru",
            "active"=> 'teachers',
            "teachers"=> $teachers,
            "js"=> ['teacher/teacher.js'],
            'plugin'=> ['sweet-alert', 'datatables'],
        ]);
    }

    function save(Request $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->save();

        return $teacher->id;
    }

    function delete(Request $request)
    {
        $class = ClassRoom::where('teacher_id', $request->id)->get();
        $teacher = Teacher::find($request->id);

        if(count($class)){
            throw ValidationException::withMessages(['message' => 'Tidak bisa menghapus Guru '.$teacher->name." karena masih menjadi Wali Kelas ".$class[0]->name]);
        }

        $teacher->delete();

        return $teacher->id;
    }

    function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->name = $request->name;
        $teacher->update();

        return $teacher->id;
    }
}
