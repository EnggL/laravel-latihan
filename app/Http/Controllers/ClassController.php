<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\Student;

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
            "kelas"=> $kelas
        ]);
    }

    function check_ekskul(Request $request)
    {
        $list_ekskul = $request->collect();

        return $list_ekskul;
    }
}
