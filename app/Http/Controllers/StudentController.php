<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\StudentEditRequest;
use App\Models\ClassRoom;
use App\Models\Ekskul;
use App\Models\StudentEkskul;
use DB;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $column = in_array($request->column, $this->column_order_available()) ? $request->column:'name';
        $order = in_array($request->order, $this->order_available()) ? $request->order:'asc';

        $student = Student::with(['kelas.wali', 'ekskuls'])
        ->where('name', 'LIKE', '%'.$keyword.'%')
        ->orWhere('nis','LIKE', '%'.$keyword.'%')
        ->orWhereHas('ekskuls', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%')->orderBy('name', 'asc');
        })
        ->orWhereHas('kelas', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orWhereHas('kelas.wali', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy($column, $order)
        ->paginate(10);
        // dd($student);

        return view(
            "student",
            [
                "keyword" => $keyword,
                "active" => 'students',
                "studentList" => $student,
                "column" => $column,
                "order" => $order,
                'js' => ['student/student.js'],
                'plugin' => ['sweet-alert']
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
                "student_ekskul" => $student_ekskul,
                'js' => ['student/student-edit.js','global.js'],
                'plugin' => ['sweet-alert', 'select2']
            ]
        );
    }

    // @return array [];
    function student_ekskul($student_ekskul)
    {
        $data = array();
        foreach ($student_ekskul as $row) {
            $data[] = $row->id;
        }

        return $data;
    }

    public function edit_check(StudentEditRequest $request)
    {
        $ekskul = isset($request->ekskul) ? $this->validasi_ekskul($request->ekskul): array();
        
        $class = ClassRoom::with('wali')->where('id', '=', $request->class)->get();
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
    }

    function add_check(StudentEditRequest $request)
    {
        //prosedur checknya masih sama kyk edit_check(), jadi ya panggil ajah
        //kedepannya bisa buat return viewnya sendiri
        return $this->edit_check($request);
    }

    // @param $list_ekskul array(numeric); contoh: array(1,2,3);
    // @reeturn Illuminate\Validation\ValidationException or App\Models\Ekskul;
    function validasi_ekskul($list_ekskul = array())
    {
        $ekskul = Ekskul::whereIn('id', $list_ekskul)->get();
        if (count($ekskul) != count($list_ekskul)) {
            //kalau tidak sama berarti ada id yang nggak masuk daftar ekskul
            throw ValidationException::withMessages(['message' => 'Ekskul tidak terdaftar']);
        }

        return $ekskul;
    }

    function update(StudentEditRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->nis = $request->nis;
        $student->gender = $request->gender;
        $student->class_id = $request->class;
        $student->update();

        //sync di tabel student_ekskul
        $this->async_student_ekskul($request->ekskul, $id);


        $request->session()->flash('status', 'success');
        $request->session()->flash('message', 'Berhasil mengupdate data siswa '.$request->name.'!');

        return redirect('/students');
    }

    /*
    @param $list_id_ekskul array()
    @para $id integer
    @return null
    */
    function async_student_ekskul($list_id_ekskul, $id)
    {
        $list_ekskul = Ekskul::all();

        $ekskul_tersedia = array();
        foreach ($list_ekskul as $ekskul) {
            $ekskul_tersedia[] = $ekskul->id;
        }
        //buang id ekskul yang nggak ada di daftar, masukan ke $ekskul_match
        $ekskul_match = array_intersect($ekskul_tersedia, $list_id_ekskul);

        $user = Student::find($id);
        $user->ekskuls()->sync($ekskul_match);
    }

    function add()
    {
        $class = ClassRoom::all();
        $ekskul = Ekskul::all();
        // dd($student_ekskul);

        return view(
            "student-add",
            [
                "active" => 'students',
                "class_list" => $class,
                "ekskul_list" => $ekskul,
            ]
        );
    }

    function save(StudentEditRequest $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->nis = $request->nis;
        $student->gender = $request->gender;
        $student->class_id = $request->class;
        $student->save();

        //sync di tabel student_ekskul
        $this->async_student_ekskul($request->ekskul, $student->id);


        $request->session()->flash('status', 'success');
        $request->session()->flash('message', 'Berhasil Menambahkan data siswa!');

        return redirect('/students');
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

    function column_order_available()
    {
        return ['name', 'nis', 'gender', 'class', 'ekskul'];
    }

    function order_available()
    {
        return ['asc', 'desc'];
    }
}
