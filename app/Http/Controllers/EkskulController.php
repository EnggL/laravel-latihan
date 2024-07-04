<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    public function index()
    {
        $ekskul = Ekskul::with('students')->get();

        return view("ekskul",
        [
            "active"=> 'ekskul',
            'css'=> 
            [
                'kelas.css'
            ],
            "ekskul"=> $ekskul
        ]);
    }
}
