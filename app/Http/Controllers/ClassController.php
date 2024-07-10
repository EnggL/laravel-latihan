<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassStoreRequest;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
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

    function delete(Request $request, $id)
    {
        if(!is_numeric($id)) {
            $request->session()->flash('status', 'error');
            $request->session()->flash('type', 'alert-danger');
            $request->session()->flash('message', 'Invalid ID!');
        }

        $student = Student::where('class_id', $id)->get();
        $class = ClassRoom::findOrFail($id);
        if(count($student) > 0) {
            $request->session()->flash('status', 'error');
            $request->session()->flash('type', 'alert-danger');
            $request->session()->flash('message', 'Tidak bisa menghapus kelas '.$class->name.' karena mempunyai data siswa');

        }

        $request->session()->flash('status', 'success');
        $request->session()->flash('type', 'alert-success');
        $request->session()->flash('message', 'Berhasil Menghapus Kelas '.$class->name);
        $deletedClass = $class->delete();

        return redirect('/class');
    }

    function add()
    {
        $teacher = Teacher::all();

        return view("class-add",
        [
            "title" => "Tambah Kelas",
            "active" => 'class',
            'css' => ['kelas.css'],
            'js' => ['class/class.js'],
            'plugin' => ['sweet-alert', 'datatables', 'select2'],
            "teacher"=> $teacher
        ]);
    }

    function save(ClassStoreRequest $request)
    {
        $class = new ClassRoom();
        $class->name = $request->class;
        $class->teacher_id = $request->wali;
        $class->save();

        $request->session()->flash('status', 'success');
        $request->session()->flash('type', 'alert-success');
        $request->session()->flash('message', 'Berhasil Menambah Kelas '.$request->class);

        return redirect("/class");
    }

    function edit($id)
    {
        $class = ClassRoom::findOrFail($id);
        $teacher = Teacher::all();
        
        return view("class-edit",
        [
            "title" => "Edit Kelas",
            "active" => 'class',
            'css' => ['kelas.css'],
            'js' => ['class/class-edit.js'],
            'plugin' => ['sweet-alert', 'datatables', 'select2'],
            "teacher"=> $teacher,
            'class' => $class
        ]);
    }

    function update(ClassStoreRequest $request, $id)
    {
        $class = ClassRoom::findOrFail($id);
        $class->name = $request->class;
        $class->teacher_id = $request->wali;
        $class->update();

        $request->session()->flash('status', 'success');
        $request->session()->flash('type', 'alert-success');
        $request->session()->flash('message', 'Berhasil Data Kelas ');

        return redirect('class');
    }

    function check_ekskul(Request $request)
    {
        $list_ekskul = $request->collect();

        return $list_ekskul;
    }
}
