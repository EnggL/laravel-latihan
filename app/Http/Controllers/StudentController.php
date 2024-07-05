<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\StudentEditRequest;
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

        return view(
            "student",
            [
                "active" => 'students',
                "studentList" => $student
            ]
        );
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
        $student_ekskul = $this->student_ekskul($student->ekskuls);
        // dd($student_ekskul);

        return view(
            "student-edit",
            [
                "active" => 'students',
                "student" => $student,
                "class_list" => $class,
                "ekskul_list" => $ekskul,
                "student_ekskul" => $student_ekskul
            ]
        );
    }

    // @return array [];
    function student_ekskul($student_ekskul)
    {
        foreach ($student_ekskul as $row) {
            $data[] = $row->id;
        }

        return $data;
    }

    public function edit_check(StudentEditRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->name = $request->name;
        $student->nis = $request->nis;
        $student->gender = $request->gender;
        $student->class_id = $request->class;

        $class = ClassRoom::with('wali')->where('id', '=', $request->class)->get();
        $ekskul = Ekskul::whereIn('id', $request->ekskul)->get();

        return json_encode([
            'success' => 1,
            'message' => 'berhasil update data!',
            'html' => view(
                "student-edit-review",
                [
                    "name" => $request->name,
                    "nis" => $request->nis,
                    "gender" => $this->get_gender_name($request->gender),
                    "class" => $class[0]->name,
                    "ekskul" => $ekskul
                ]
            )->render()
        ]);
        // if(!$saved){
        //     App::abort(500, 'Error');
        // }else{

        // }
    }

    function update(StudentEditRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->name = $request->name;
        $student->nis = $request->nis;
        $student->gender = $request->gender;
        $student->class_id = $request->class;
        $student->update();

        $this->update_ekskul($request->ekskul, $id);

        $request->session()->flash('status', 'success');
        $request->session()->flash('message', 'Berhasil mengupdate data siswa!');

        return redirect('/students');
    }

    /*
    $data array;
    $id integer
    @return null
    */
    function update_ekskul($data, $id)
    {

    }

    function get_gender_name($id = null)
    {
        switch ($id) {
            case '0':
                $gender = "Laki-laki";
                break;
            case '1':
                $gender = "Perempuan";
                break;

            default:
                $gender = "Tidak di temukan!";
                break;
        }

        return $gender;
    }
}
